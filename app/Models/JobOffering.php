<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOffering extends Model
{
    protected $fillable = ['name','location','type','immersion','organisation','minimal_requirement','description'];

}
