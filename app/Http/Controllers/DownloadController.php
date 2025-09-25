<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\Models\Dokumente;

class DownloadController extends Controller
{
	public function download($id)
	{
		$dokument = Dokumente::find($id);
		return response()->download($dokument->basePath.$dokument->filename);
	}
}
