<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminSearch extends Controller
{
    public function __construct()
    {
        view()->share('scretchContainerFullWidth', true);
    }

    public function index()
    {
        return view('admin.pages.adminsearch');
        // return view('adminSearch.index');
    }
    public function search(Request $request)
    {
        try {
            // Start query with relations
            $users = User::with([
                'auslandsProjekte',
                'mandate',
                'karriere',
                'skills',
                'verantwortung',
                'schwerpunkte',
                'kompetenz',
                'dokumente',
            ]);

            // Filter by boolean checkboxes
            if ($request->boolean('festanstellung')) {
                $users = $users->where('festanstellung', 1);
            }
            if ($request->boolean('interim')) {
                $users = $users->where('interimManger', 1);
            }
            if ($request->boolean('buyIn')) {
                $users = $users->where('managementBuyIn', 1);
            }

            // Get users as collection
            $users = $users->get();

            // Dynamic filtering helper
            $filterCollection = function ($collection, $conditions, $fieldMap) {
                return $collection->filter(function ($user) use ($conditions, $fieldMap) {
                    $matches = [];
                    foreach ($conditions as $cond) {
                        foreach ($fieldMap($user) as $target) {
                            $match = true;
                            foreach ($cond as $key => $val) {
                                if ($key === 'experience') {
                                    $experienceMonths = isset($target['from'], $target['to']) ?
                                    deltaMonths($target['from'], $target['to']) : 0;
                                    if ((int) $val > $experienceMonths) {
                                        $match = false;
                                    }

                                } else {
                                    // cast both sides to string for safe comparison
                                    if ((string) $val !== (string) ($target[$key] ?? null)) {
                                        $match = false;
                                    }

                                }
                            }
                            if ($match) {
                                $matches[] = true;
                                break;
                            }
                        }
                    }
                    return count($matches) >= count($conditions);
                });
            };

            // AuslandsProjekte filter
            if ($request->has('auslandsProjekte')) {
                $users = $filterCollection($users, $request->get('auslandsProjekte'), function ($user) {
                    return $user->auslandsProjekte->map(function ($p) {
                        return [
                            'branche' => $p->branche,
                            'from'    => $p->from,
                            'to'      => $p->to,
                        ];
                    })->toArray();
                });
            }

            // Mandate filter
            if ($request->has('mandate')) {
                $users = $filterCollection($users, $request->get('mandate'), function ($user) {
                    return $user->mandate->map(function ($m) {
                        return [
                            'branche'   => $m->branche,
                            'minUmsatz' => $m->umsatz,
                            'minMA'     => $m->ma,
                            'minMit'    => $m->worker,
                            'minBud'    => $m->budget,
                            'from'      => $m->from,
                            'to'        => $m->to,
                        ];
                    })->toArray();
                });
            }

            // Ausbildung filter
            if ($request->has('ausbildung')) {
                $users = $filterCollection($users, $request->get('ausbildung'), function ($user) {
                    return $user->karriere()->where('type', 'ausbildung')->get()->map(function ($k) {
                        return [
                            'ausbildung'      => $k->fachrichtung,
                            'spezialisierung' => $k->spezialisierung,
                            'from'            => $k->from,
                            'to'              => $k->to,
                        ];
                    })->toArray();
                });
            }

            // Karriere filter
            if ($request->has('karriere')) {
                $users = $filterCollection($users, $request->get('karriere'), function ($user) {
                    return $user->karriere()->where('type', 'karriere')->get()->map(function ($k) {
                        return [
                            'fachrichtung' => $k->fachrichtung,
                            'from'         => $k->from,
                            'to'           => $k->to,
                        ];
                    })->toArray();
                });
            }

            // Interessen / Skills filter
            if ($request->has('interessen')) {
                $users = $filterCollection($users, $request->get('interessen'), function ($user) {
                    return $user->skills->map(function ($s) {
                        return ['interesse' => $s->skill];
                    })->toArray();
                });
            }

            // Prepare results for JSON
            $users->transform(function ($user) {
                $userData = $user->toArray();

                // Format dates
                foreach (['auslandsProjekte', 'mandate', 'karriere'] as $rel) {
                    if (isset($userData[$rel]) && is_array($userData[$rel])) {
                        foreach ($userData[$rel] as &$item) {
                            $item['fromString'] = isset($item['from']) ? optional($item['from'])->format('d.m.Y') : '';
                            $item['toString']   = isset($item['to']) ? optional($item['to'])->format('d.m.Y') : '';
                        }
                    }
                }

                return $userData;
            });

            return response()->json(['results' => $users]);
        } catch (\Exception $e) {
            \Log::error('Admin search error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function display($id)
    {
        $user = User::with(
            'auslandsProjekte',
            'mandate',
            'karriere',
            'skills',
            'verantwortung',
            'schwerpunkte',
            'kompetenz'
        )->find($id);

        return view('admin.pages.user', compact('user'));
    }

    public function kompetenz()
    {
        return \App\Data\KernKompetenz::flattenKompetenz();
    }

    public function UsersList()
    {
        $users = User::all();
        return view('admin.pages.userslist', compact('users'));
    }

    public function exportData(Request $req)
    {
        $users = User::whereIn('id', $req->select)->get();

        if ($users->isEmpty()) {
            return back()->with('error', 'Keine Auswahl getroffen.');
        }

        $vcf = '';

        foreach ($users as $user) {
            $uid = md5(strtolower(trim($user->email))) . '@yourdomain.com';

            $vcf .= "BEGIN:VCARD\r\n";
            $vcf .= "VERSION:3.0\r\n";
            $vcf .= "N:{$user->surname};{$user->forename};;{$user->title_gender};\r\n";
            $vcf .= "FN:{$user->title_gender} {$user->forename} {$user->surname}\r\n";
            $vcf .= "EMAIL:{$user->email}\r\n";
            $vcf .= "TEL;TYPE=WORK:{$user->phone_comercial}\r\n";
            $vcf .= "TEL;TYPE=CELL:{$user->mobil}\r\n";
            $vcf .= "ADR;TYPE=HOME:;;{$user->street};{$user->city};;{$user->zipcode};\r\n";
            $vcf .= "UID:$uid\r\n";
            $vcf .= "END:VCARD\r\n";
        }

        // Stream as download (no temp file needed)
        return response($vcf)
            ->header('Content-Type', 'text/vcard')
            ->header('Content-Disposition', 'attachment; filename="usersdetail.vcf"');
    }

}
