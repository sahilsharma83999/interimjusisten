<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\Exportable;

class AuslandsProjekte extends Model implements Exportable
{
    protected $dates = ['from','to','created_at','updated_at'];
    protected $fillable = ['from','to','description','branche'];

    public function users()
    {
    	return $this->belongsTo(App\User::class);
    }

    public static function export()
    {
    	$models = static::all();
    	$modelName = __CLASS__;

    	foreach($models as $model) {
    		$model->branche = \App\Data\Branche::keyToValue($model->branche);
    	}

    	$data = $models->toArray();

        if($models->count() > 0) {
            array_unshift($data,array_keys($models->get(0)->toArray()));
        }

    	return $data;
    }
}
