<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Interfaces\Exportable;

use App\User;

class Skill extends Model implements Exportable
{
    protected $fillable = ['skill','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public static function export()
    {
    	$models = static::all();
    	$modelName = __CLASS__;

    	foreach($models as $model) {
    		$model->skill = \App\Data\Interessen::keyToValue($model->skill);
    	}

    	$data = $models->toArray();

        if($models->count() > 0) {
            array_unshift($data,array_keys($models->get(0)->toArray()));
        }


    	return $data;
    }
}
