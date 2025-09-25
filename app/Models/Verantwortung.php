<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Interfaces\Exportable;

class Verantwortung extends Model implements Exportable
{
    protected $fillable = ['type','amount','period','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public static function export()
    {
    	$models = static::all();
    	$modelName = __CLASS__;

    	foreach($models as $model) {
    		switch($model->type) {
    			case "personal":
    				$model->amount = \App\Data\Verantwortung::keyToValuePersonalAmount($model->amount);
    				$model->period = \App\Data\Verantwortung::keyToValuePersonalPeriod($model->period);
    			break;

    			case "umsatz":
    				$model->amount = \App\Data\Verantwortung::keyToValueUmsatzAmount($model->amount);
    				$model->period = \App\Data\Verantwortung::keyToValueUmsatzPeriod($model->period);
    			break;

    			case "budget":
    				$model->amount = \App\Data\Verantwortung::keyToValueBudgetAmount($model->amount);
    				$model->period = \App\Data\Verantwortung::keyToValueBudgetPeriod($model->period);
    			break;

    			case "einkauf":
    				$model->amount = \App\Data\Verantwortung::keyToValueEinkaufAmount($model->amount);
    				$model->period = \App\Data\Verantwortung::keyToValueEinkaufPeriod($model->period);
    			break;
    		}
    	}

    	$data = $models->toArray();

        if($models->count() > 0) {
            array_unshift($data,array_keys($models->get(0)->toArray()));
        }

    	return $data;
    }

}
