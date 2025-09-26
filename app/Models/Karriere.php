<?php
namespace App\Models;

use App\Interfaces\Exportable;
use Illuminate\Database\Eloquent\Model;

class Karriere extends Model implements Exportable
{
    protected $dates    = ['from', 'to', 'created_at', 'updated_at'];
    protected $fillable = ['from', 'to', 'description', 'user_id', 'type', 'fachrichtung', 'spezialisierung'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function export()
    {
        $models    = static::all();
        $modelName = __CLASS__;

        if ($model->type === 'ausbildung') {
            $model->fachrichtung    = Fachrichtung::keyToValueAusbildung($model->fachrichtung);
            $model->spezialisierung = Fachrichtung::keyToValueSpezialisierung($model->spezialisierung);
        } else if ($model->type === 'karriere') {
            $model->fachrichtung = Fachrichtung::keyToValueKarriere($model->fachrichtung);
        }

        $data = $models->toArray();

        if ($models->count() > 0) {
            array_unshift($data, array_keys($models->get(0)->toArray()));
        }

        return $data;
    }
}
