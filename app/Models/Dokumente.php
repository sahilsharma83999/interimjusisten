<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Interfaces\Exportable;

class Dokumente extends Model implements Exportable
{
    public $basePath;

    public function __construct()
    {
    	parent::__construct();
    	$this->basePath = public_path().'/uploads/';
    }

	public function user()
	{
		return $this->belongsTo(User::class);
	}

    public static function export()
    {
        $models = static::all();
        $modelName = __CLASS__;

        foreach($models as $model) {
            $model->download = url('download').'/'.$model->id;
        }

        $data = $models->toArray();

        if($models->count() > 0) {
            array_unshift($data,array_keys($models->get(0)->toArray()));
        }

        return $data;
    }
}
