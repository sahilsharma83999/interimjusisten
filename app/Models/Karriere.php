<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\Exportable;

class Karriere extends Model implements Exportable
{
    protected $dates = ['from','to','created_at','updated_at'];
    protected $fillable = ['from','to','description', 'user_id', 'type','fachrichtung','spezialisierung'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public static function export()
    {
    	$models = static::all();
    	$modelName = __CLASS__;

    	foreach($models as $model) {
    		if($model->type === 'ausbildung') {
    			$model->fachrichtung = \App\Data\Fachrichtung::keyToValueAusbildung($model->fachrichtung);
    			$model->spezialisierung = \App\Data\Fachrichtung::keyToValueSpezialisierung($model->spezialisierung);
    		} else if($model->type === 'karriere') {
    			$model->fachrichtung = \App\Data\Fachrichtung::keyToValueKarriere($model->fachrichtung);
    		}
    	}

    	$data = $models->toArray();

        if($models->count() > 0) {
            array_unshift($data,array_keys($models->get(0)->toArray()));
        }

    	return $data;
    }
}
