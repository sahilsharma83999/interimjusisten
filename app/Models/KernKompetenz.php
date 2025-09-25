<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\Exportable;
class KernKompetenz extends Model implements Exportable
{
    protected $fillable = ['key','user_id','row'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public static function export()
    {
    	$models = static::all();
    	$modelName = __CLASS__;

    	foreach($models as $model) {
    		$loopData = \App\Data\KernKompetenz::keyToNames($model->key);
    		$model->key = "";
    		foreach($loopData as $key => $value) {
    			if($key !== 'level1')
    				$model->key .= ' -> ';

    			$model->key .= $value;
    		}
    	}

    	$data = $models->toArray();

        if($models->count() > 0) {
            array_unshift($data,array_keys($models->get(0)->toArray()));
        }

    	return $data;
    }
}
