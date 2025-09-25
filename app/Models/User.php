<?php
namespace App\Models;

use App\Interfaces\Exportable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, Exportable
{
    use Authenticatable, CanResetPassword;

    protected $table = 'users';

    protected $fillable = [                                             
        // 'name',
        'email',
        'password',
        'title_gender',
        'title_graduation',
        'forename',
        'surname',
        'street',
        'house_number',
        'zipcode',
        'city',
        'country',
        'email2',
        'mobil',
        'phone_private',
        'phone_comercial',
        'fax',
        'email_signature',
        'homepage',
        'birthdate',
        'admin',
        'role',
        'auslands_projekte',
        'aktivkey',
    ];

    protected $casts = [
        'birthdate' => 'datetime',
    ];

    const TITLE_GENDER = ['Herr', 'Frau'];

    const TITLE_GRADUATION = ['Prof. Dr.', 'Prof.', 'Dr. jur.', 'LL.M.', 'Dipl.-Ing.', 'MBA', 'M. Sc.'];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['birthdate', 'created_at', 'updated_at'];

    public function setAktivkeyAttribute($key)
    {
        $this->attributes["aktivkey"] = Str::random(32);
    }

    public function auslandsProjekte()
    {
        return $this->hasMany(AuslandsProjekte::class);
    }

    public function mandate()
    {
        return $this->hasMany(Mandat::class);
    }

    public function karriere()
    {
        return $this->hasMany(Karriere::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function verantwortung()
    {
        return $this->hasMany(Verantwortung::class);
    }

    public function schwerpunkte()
    {
        return $this->hasMany(Schwerpunkte::class);
    }

    public function kompetenz()
    {
        return $this->hasMany(KernKompetenz::class);
    }

    public function dokumente()
    {
        return $this->hasMany(Dokumente::class);
    }

    public function anonymousName()
    {
        $return = "";
        if (! is_null($this->forename)) {
            $return .= substr($this->forename, 0, 1) . '... ';
        }
        if (! is_null($this->surname)) {
            $return .= substr($this->surname, 0, 1) . '... ';
        }
        if (empty($return)) {
            $return = 'Anonymous';
        }
        return $return;
    }

    public function yearsOfKarriere($fachrichtung)
    {
        $groups = \App\Data\Fachrichtung::getKarriere();
        //find selected id
        foreach ($groups as $key => $value) {
            if (strtolower($value) === $fachrichtung) {
                $groupId = $key;
            }
        }

        $karrieren = \App\Karriere::where('type', 'karriere')->where('fachrichtung', $groupId)->where('user_id', $this->id)->get();
        $result    = 0;
        if (! empty($karrieren)) {
            foreach ($karrieren as $karriere) {
                $result += deltaYears($karriere->from, $karriere->to);
            }

        }

        return $result;
    }

    public static function export()
    {
        $models    = static::all();
        $modelName = __CLASS__;
        $data      = $models->toArray();

        if ($models->count() > 0) {
            array_unshift($data, array_keys($models->get(0)->toArray()));
        }

        return $data;
    }
}
