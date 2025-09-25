<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\Exportable;
use Auth;

class Schwerpunkte extends Model implements Exportable
{
    protected $fillable = ['user_id','schwerpunkt'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public static function stripSelected($key,$level)
    {
    	$selected = Schwerpunkte::where('user_id',Auth::user()->id)->get();
    	if($selected->count() > $level AND $selected[$level]->schwerpunkt === $key ){
    		return true;
    	} else {
    		return false;
    	}
    }

    public static function export()
    {
        $models = static::all();
        $modelName = __CLASS__;

        foreach($models as $model) {
            $model->schwerpunkt = \App\Data\Schwerpunkte::keyToValue($model->schwerpunkt);
        }

        $data = $models->toArray();

        if($models->count() > 0) {
            array_unshift($data,array_keys($models->get(0)->toArray()));
        }


        return $data;
    }
}
