<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function juristen()
    {
    	return view('pages.juristen');
    }

    public function outsourcing()
    {
    	return view('pages.outsourcing');
    }

    public function permJuristen()
    {
    	return view('pages.permJuristen');
    }

    public function legalInterim()
    {
        return view('pages.legalInterim');
    }

    public function impressum()
    {
        return view('pages.impressum');
    }

    public function datenschutz()
    {
        return view('pages.datenschutz');
    }
}
