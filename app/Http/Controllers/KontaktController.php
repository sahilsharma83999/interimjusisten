<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class KontaktController extends Controller
{
    protected $recievingEmail = 'info@interim-jurist.de';
    // protected $recievingEmail = 'useless@tecbeast.de';

    public function getContact()
    {
        return view('pages.contact');
    }

    public function postContact(ContactRequest $request)
    {
        $data = $request->validated();

        Mail::to($this->recievingEmail)
            ->send(new \App\Mail\ContactMail($data));

        return redirect()->back()->with('infoMsg', 'Nachricht gesendet');
    }
}
