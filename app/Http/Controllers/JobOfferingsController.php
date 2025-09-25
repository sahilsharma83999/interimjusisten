<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\JobOffering;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class JobOfferingsController extends Controller
{
    public function admin()
    {
        $offerings = JobOffering::all();

        return view('admin.pages.stellenangebote',['offerings' => $offerings]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $offerings = JobOffering::all();

        return view('admin.pages.stellenangebote',['offerings' => $offerings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id = null)
    {
        $offering = null;
        if(!is_null($id))
            $offering = JobOffering::find($id);

        return view('admin.pages.create',compact('offering'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request,$id = null)
    {
        if($id !== null) {
            try {
                $offering = JobOffering::findOrFail($id);
                $offering->update($request->all());
            } catch (ModelNotFoundException $e) {
                $offering = JobOffering::create($request->all());
            }
        } else {
           $offering = JobOffering::create($request->all());
        }

        //Set image if one was uploaded
        if($request->hasFile('logo_path') AND $request->file('logo_path')->isValid()) {
            //Move File
            $request->file('logo_path')->move(public_path().'/uploads/company_logos/',$request->file('logo_path')->getClientOriginalName());
            //Save path
            $offering->logo_path = '/uploads/company_logos/'.$request->file('logo_path')->getClientOriginalName();
            $offering->save();
        }

        return redirect()->route('edit-job-offerings')->with('infoMsg','Stellenangbot wurde gespeichert');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $offering = JobOffering::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect('/')->with('infoMsg','Stellenangebot Nr.'.$id.' wurde nicht gefunden');
        }

        return view('admin.pages.show',compact('offering'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        JobOffering::find($id)->delete();
        return redirect()->back()->with('infoMsg','Stellenangbot Nr. '.$id.' gelöscht');
    }
}
