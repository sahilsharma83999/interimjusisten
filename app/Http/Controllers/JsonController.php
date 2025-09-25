<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\Data\Branche;
use App\Data\KernKompetenz;

class JsonController extends Controller
{
    public function ausland()
    {
    	$projects = Auth::user()->auslandsProjekte()->get();
    	foreach($projects as $project) {
    		$project->fmonth = $project->from->month;
    		$project->fyear = $project->from->year;
    		$project->tmonth = $project->to->month;
    		$project->tyear = $project->to->year;
    	}
    	return $projects;
    }

    public function mandat()
    {
    	$mandate = Auth::user()->mandate()->get();
    	foreach($mandate as $mandat) {
    		$mandat->fmonth = $mandat->from->month;
    		$mandat->fyear = $mandat->from->year;
    		$mandat->tmonth = $mandat->to->month;
    		$mandat->tyear = $mandat->to->year;
    	}
    	return $mandate;
    }

    public function karriere()
    {
        $karriere = Auth::user()->karriere()->get();
        foreach($karriere as $kar) {
            $kar->fmonth = $kar->from->month;
            $kar->fyear = $kar->from->year;
            $kar->tmonth = $kar->to->month;
            $kar->tyear = $kar->to->year;
        }
        return $karriere;
    }

    public function skills()
    {
        return Auth::user()->skills;
    }

    public function verantwortung()
    {
        return Auth::user()->verantwortung;
    }

    public function kompetenz()
    {
        return KernKompetenz::getKompetenz();
    }

    public function userKompetenz()
    {
        return Auth::user()->kompetenz;
    }
}
