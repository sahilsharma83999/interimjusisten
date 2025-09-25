<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index()
    {

        return view('search.index',['results' => []]);
    }
    public function search($search)
    {
        $groups = \App\Data\Fachrichtung::getKarriere();
        //find selected id
        foreach($groups as $key => $value) {
            if(strtolower($value) === $search) {
                $groupId = $key;
            }
        }

        $viewData["results"] = \App\User::whereHas('karriere', function ($q) use ($groupId) {
            $q->where('type','karriere')->where('fachrichtung',$groupId);
        })->with('kompetenz')->get();

        $viewData["selected"] = $search;

        return view('search.index',$viewData);
    }
}
