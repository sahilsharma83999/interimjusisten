<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Generators\FilenameGenerator;

use Auth;

use App\Models\AuslandsProjekte;
use App\Models\Mandat;
use App\Models\Karriere;
use App\Models\Dokumente;
use App\Models\Skill;
use App\Models\Verantwortung;
use App\Models\Schwerpunkte;
use App\Models\KernKompetenz;


use App\Data\Branche;
use App\Data\Fachrichtung;
use App\Data\Interessen;
use App\Data\Verantwortung as DVerantwortung;

use Carbon\Carbon;

class AccountController extends Controller
{
	public function getMandate()
	{
		return view('account.mandate');
	}
	public function postMandate(Request $request)
	{
		$auslandProjekte = [];
		$data = $request->all();
		// dd($data);

		//Validate date ranges
		if(isset($data["mandate"])) {
			foreach($data["mandate"] as $mandat) {
				$start = Carbon::createFromDate($mandat["fyear"],$mandat["fmonth"]);
				$end = Carbon::createFromDate($mandat["tyear"],$mandat["tmonth"]);

				if(!isValidTimeSpan($start,$end)) {
					return redirect()->back()->with('infoMsg','Sie müssen mindestens eine Zeitspanne von einem Monat angeben');
				}
			}
		}

		//Remove all Projects
		Auth::user()->mandate->each(function ($model) {
			$model->delete();
		});

		if(isset($data["mandate"])) {
			foreach($data["mandate"] as $mandat) {
				$mandat["from"] = Carbon::createFromDate($mandat["fyear"],$mandat["fmonth"]);
				$mandat["to"] = Carbon::createFromDate($mandat["tyear"],$mandat["tmonth"]);

				//clean
				unset($mandat["fyear"],$mandat["fmonth"],$mandat["tyear"],$mandat["tmonth"]);

				$m = Mandat::firstOrCreate([
					'from' => $mandat['from'],
					'to' => $mandat['to'],
					'umsatz' => $mandat['umsatz'],
					'ma' => $mandat['ma'],
					'worker' => $mandat['worker'],
					'budget' => $mandat['budget'],
					'description' => $mandat['description'],
					'user_id' => Auth::user()->id,
					'branche' => Branche::containsKey($mandat["branche"]),
					]);

				$m->user_id = Auth::user()->id;
				$m->save();
			}
		}
		return redirect('account/karriere')->with('infoMsg','Änderungen wurden erfolgreich eingetragen');
	}

	public function getKarriere()
	{
		return view('account.karriere');
	}
	public function postKarriere(Request $request)
	{
		$auslandProjekte = [];
		$data = $request->all();
		// dd($data);

		//Validate date ranges
		if(isset($data["ausbildung"])) {
			foreach($data["ausbildung"] as $ausbildung) {
				$start = Carbon::createFromDate($ausbildung["fyear"],$ausbildung["fmonth"]);
				$end = Carbon::createFromDate($ausbildung["tyear"],$ausbildung["tmonth"]);

				if(!isValidTimeSpan($start,$end)) {
					return redirect()->back()->with('infoMsg','Sie müssen mindestens eine Zeitspanne von einem Monat angeben');
				}
			}
		}

		if(isset($data["karriere"])) {
			foreach($data["karriere"] as $karriere) {
				$start = Carbon::createFromDate($karriere["fyear"],$karriere["fmonth"]);
				$end = Carbon::createFromDate($karriere["tyear"],$karriere["tmonth"]);

				if(!isValidTimeSpan($start,$end)) {
					return redirect()->back()->with('infoMsg','Sie müssen mindestens eine Zeitspanne von einem Monat angeben');
				}
			}
		}

		//Remove all Projects
		Auth::user()->karriere->each(function ($model) {
			$model->delete();
		});

		if(isset($data["ausbildung"])) {
			foreach($data["ausbildung"] as $ausbildung) {
				$ausbildung["from"] = Carbon::createFromDate($ausbildung["fyear"],$ausbildung["fmonth"]);
				$ausbildung["to"] = Carbon::createFromDate($ausbildung["tyear"],$ausbildung["tmonth"]);

				//clean
				unset($ausbildung["fyear"],$ausbildung["fmonth"],$ausbildung["tyear"],$ausbildung["tmonth"]);

				//override hidden field type value
				$ausbildung["type"] = "ausbildung";

				$a = Karriere::firstOrCreate([
					'from' => $ausbildung['from'],
					'to' => $ausbildung['to'],
					'type' => $ausbildung['type'],
					'user_id' => Auth::user()->id,
					'description' => $ausbildung['description'],
					'fachrichtung' => Fachrichtung::containsKeyForAusbildung($ausbildung['fachrichtung']),
					'spezialisierung' => Fachrichtung::containsKeyForSpezialisierung($ausbildung['spezialisierung']),
					]);
				$a->user_id = Auth::user()->id;
				$a->save();
			}
		}

		if(isset($data["karriere"])) {
			foreach($data["karriere"] as $karriere) {
				$karriere["from"] = Carbon::createFromDate($karriere["fyear"],$karriere["fmonth"]);
				$karriere["to"] = Carbon::createFromDate($karriere["tyear"],$karriere["tmonth"]);

				//clean
				unset($karriere["fyear"],$karriere["fmonth"],$karriere["tyear"],$karriere["tmonth"]);

				//override hidden field type value
				$karriere["type"] = "karriere";

				$a = Karriere::firstOrCreate([
					'from' => $karriere['from'],
					'to' => $karriere['to'],
					'type' => $karriere['type'],
					'user_id' => Auth::user()->id,
					'description' => $karriere['description'],
					'fachrichtung' => Fachrichtung::containsKeyForKarriere($karriere['fachrichtung']),
					]);

				$a->user_id = Auth::user()->id;
				$a->save();
			}
		}
		return redirect('account/faehigkeiten')->with('infoMsg','Änderungen wurden erfolgreich eingetragen');
	}

	public function getFaehigkeiten()
	{
		return view('account.skills');
	}
	public function postFaehigkeiten(Request $request)
	{
		$data = $request->all();
		// dd($data);

		//Remove all Projects
		Auth::user()->skills->each(function ($model) {
			$model->delete();
		});

		foreach($data["skills"] as $skill) {;
			$s = Skill::firstOrCreate([
				'skill' => Interessen::containsKey($skill),
				'user_id' => Auth::user()->id,
				]);
			$s->save();
		}

		//set self evaluation
		Auth::user()->self_evaluation = $data["self_evaluation"];
		Auth::user()->save();

		return redirect('account/verantwortung')->with('infoMsg','Änderungen wurden erfolgreich eingetragen');
	}

	public function getVerantwortung()
	{
		return view('account.verantwortung');
	}
	public function postVerantwortung(Request $request)
	{
		$data = $request->all();
		//dd($data);

		//Remove all Projects
		Auth::user()->verantwortung->each(function ($model) {
			$model->delete();
		});

		//Personal
		if(isset($data["personal"])){
			foreach($data["personal"] as $personal){
				$p = Verantwortung::create([
					'user_id' => Auth::user()->id,
					'amount' => DVerantwortung::containsKeyForPersonalAmount($personal["amount"]),
					'period' => DVerantwortung::containsKeyForPersonalPeriod($personal["period"]),
					'type' => 'personal',
				]);
			}
		}

		//Umsatz
		if(isset($data["umsatz"])){
			foreach($data["umsatz"] as $umsatz){
				$p = Verantwortung::create([
					'user_id' => Auth::user()->id,
					'amount' => DVerantwortung::containsKeyForUmsatzAmount($umsatz["amount"]),
					'period' => DVerantwortung::containsKeyForUmsatzPeriod($umsatz["period"]),
					'type' => 'umsatz',
				]);
			}
		}

		//Budget
		if(isset($data["budget"])){
			foreach($data["budget"] as $budget){
				$p = Verantwortung::create([
					'user_id' => Auth::user()->id,
					'amount' => DVerantwortung::containsKeyForBudgetAmount($budget["amount"]),
					'period' => DVerantwortung::containsKeyForBudgetPeriod($budget["period"]),
					'type' => 'budget',
				]);
			}
		}

		//Einkauf
		if(isset($data["einkauf"])){
			foreach($data["einkauf"] as $einkauf){
				$p = Verantwortung::create([
					'user_id' => Auth::user()->id,
					'amount' => DVerantwortung::containsKeyForEinkaufAmount($einkauf["amount"]),
					'period' => DVerantwortung::containsKeyForEinkaufPeriod($einkauf["period"]),
					'type' => 'einkauf',
				]);
			}
		}
		return redirect('account/schwerpunkte')->with('infoMsg','Änderungen wurden erfolgreich eingetragen');
	}

	public function getSchwerpunkte()
	{
		return view('account.schwerpunkte');
	}
	public function postSchwerpunkte(Request $request)
	{
		$data = $request->all();

		//delete all kernKompetenzen
		Auth::user()->kompetenz->each(function ($model) {
			$model->delete();
		});
		//add kernKompetenzen
		if(isset($data["kompetenz"])) {
			foreach($data["kompetenz"] as $row => $kompetenz) {
				//check for lowest level first
				//level1
				if(isset($kompetenz["level1"]))
					$key = $kompetenz["level1"];
				//level2
				if(isset($kompetenz["level2"]))
					$key = $kompetenz["level2"];
				//level3
				if(isset($kompetenz["level3"]))
					$key = $kompetenz["level3"];

				$k = KernKompetenz::create([
					'key' => $key,
					'row' => $row,
					'user_id' => Auth::user()->id,
				]);

			}
		}

		//delete all Schwerpunkte
		Auth::user()->schwerpunkte->each(function ($model) {
			$model->delete();
		});

		//add Schwerpunkte
		if(isset($data["schwerpunkt"])) {
			foreach($data["schwerpunkt"] as $schwerpunkt) {
				$s = Schwerpunkte::create([
					'user_id' => Auth::user()->id,
					'schwerpunkt' => $schwerpunkt,
				]);
			}
		}

		//gewünschtes berufsverhältnis
		if(isset($data["festanstellung"])){
			Auth::user()->festanstellung = true;
		} else {
			Auth::user()->festanstellung = false;
		}
		if(isset($data["interimManger"])){
			Auth::user()->interimManger = true;
		} else {
			Auth::user()->interimManger = false;
		}
		if(isset($data["managementBuyIn"])){
			Auth::user()->managementBuyIn = true;
		} else {
			Auth::user()->managementBuyIn = false;
		}
		Auth::user()->save();
		// dd($data);
		return redirect('account/dokumente')->with('infoMsg','Änderungen wurden erfolgreich eingetragen');
	}

	public function getDokumente()
	{
		$viewData["lebenslauf"] = Dokumente::where('user_id',Auth::user()->id)->where('type','lebenslauf')->first();
		$viewData["qualifikationen"] = Dokumente::where('user_id',Auth::user()->id)->where('type','qualifikation')->get();
		$viewData["auszeichnungen"] = Dokumente::where('user_id',Auth::user()->id)->where('type','auszeichnung')->get();
		$viewData["sonstiges"] = Dokumente::where('user_id',Auth::user()->id)->where('type','sonstiges')->get();
		// dd($viewData);
		return view('account.dokumente',$viewData);
	}
	public function postDokumente(Request $request,FilenameGenerator $fg)
	{
		$data = $request->all();
		// dd($data);

		//Lebenslauf
		if($request->hasFile('lebenslauf') AND $request->file('lebenslauf')->isValid()) { //neuer lebenslauf
			//delete old if found
			Dokumente::where('user_id',Auth::user()->id)->where('type','lebenslauf')->delete();
			//add new
			$lebenslauf = new Dokumente;
			$newFilename = $fg->generate($request->file('lebenslauf'));
			$request->file('lebenslauf')->move($lebenslauf->basePath,$newFilename);
			$lebenslauf->original_file_name = $request->file('lebenslauf')->getClientOriginalName();
			$lebenslauf->filename = $newFilename;
			$lebenslauf->type = "lebenslauf";
			$lebenslauf->user_id = Auth::user()->id;
			$lebenslauf->save();
		}

		//Add Qualifikationen
		if(!empty($data["qualifikation"])){
			foreach($data["qualifikation"] as $qualifikation) {
				if(!is_null($qualifikation)) {
					$quali = new Dokumente;
					$newFilename = $fg->generate($qualifikation);
					$qualifikation->move($quali->basePath,$newFilename);
					$quali->original_file_name = $qualifikation->getClientOriginalName();
					$quali->filename = $newFilename;
					$quali->type = "qualifikation";
					$quali->user_id = Auth::user()->id;
					$quali->save();
				}
			}
		}
		//Add Auszeichnungen
		if(!empty($data["auszeichnung"])){
			foreach($data["auszeichnung"] as $auszeichnung) {
				if(!is_null($auszeichnung)) {
					$ausz = new Dokumente;
					$newFilename = $fg->generate($auszeichnung);
					$auszeichnung->move($ausz->basePath,$newFilename);
					$ausz->original_file_name = $auszeichnung->getClientOriginalName();
					$ausz->filename = $newFilename;
					$ausz->type = "auszeichnung";
					$ausz->user_id = Auth::user()->id;
					$ausz->save();
				}
			}
		}
		//Add Sonstiges
		if(!empty($data["sonstiges"])){
			foreach($data["sonstiges"] as $sonstiges) {
				if(!is_null($sonstiges)) {
					$sonst = new Dokumente;
					$newFilename = $fg->generate($sonstiges);
					$sonstiges->move($sonst->basePath,$newFilename);
					$sonst->original_file_name = $sonstiges->getClientOriginalName();
					$sonst->filename = $newFilename;
					$sonst->type = "sonstiges";
					$sonst->user_id = Auth::user()->id;
					$sonst->save();
				}
			}
		}
		return redirect('account/dokumente')->with('infoMsg','Änderungen wurden erfolgreich eingetragen');
	}

	public function deleteDokumente($id)
	{
		//Verify ownership
		if(Dokumente::where('id',$id)->where('user_id',Auth::user()->id)->count() === 1) {
			Dokumente::where('id',$id)->where('user_id',Auth::user()->id)->delete();
		}
		return redirect('account/dokumente')->with('infoMsg','Dokument gelöscht');
	}

	public function getAuslandsProjekte()
	{
		$viewData["user"] = Auth::user();
		return view('account.auslands-projekte',$viewData);
	}
	public function postAuslandsProjekte(Request $request)
	{
		$auslandProjekte = [];
		$data = $request->all();
		// dd($data);

		if(isset($data["ausland"]) AND $data["ausland"] === "1") {
			foreach($data["projects"] as $projects) {
				$start = Carbon::createFromDate($projects["fyear"],$projects["fmonth"]);
				$end = Carbon::createFromDate($projects["tyear"],$projects["tmonth"]);

				if(!isValidTimeSpan($start,$end)) {
					return redirect()->back()->with('infoMsg','Sie müssen mindestens eine Zeitspanne von einem Monat angeben');
				}
			}
		}

		//Remove all Projects
		Auth::user()->auslandsProjekte->each(function ($model) {
			$model->delete();
		});

		if($data["ausland"]) {
			foreach($data["projects"] as $project) {
				$p = AuslandsProjekte::firstOrCreate([
					'from' => Carbon::createFromDate($project["fyear"],$project["fmonth"]),
					'to' => Carbon::createFromDate($project["tyear"],$project["tmonth"]),
					'description' => $project["description"],
					'user_id' => Auth::user()->id,
					'branche' => Branche::containsKey($project["branche"]),
					]);
				$p->user_id = Auth::user()->id;
				$p->save();
			}
		}
		return redirect('account/mandate')->with('infoMsg','Änderungen wurden erfolgreich eingetragen');
	}

	public function getDetails()
	{

		if(Auth::user()->admin){
			return redirect('admin/stellenangebote');
		}
		if(is_null(Auth::user()->birthdate))
			Auth::user()->birthdate = Carbon::now();

		// dd(Auth::user());
		$viewData["day"] = Auth::user()->birthdate->day;
		$viewData["month"] = Auth::user()->birthdate->month;
		$viewData["year"] = Auth::user()->birthdate->year;

		return view('account.details',$viewData);
	}
	public function postDetails(Request $request)
	{
		$data = $request->all();
		if(isset($data["email"]))
			unset($data["email"]);

		$data["birthdate"] = Carbon::createFromDate($data["byear"],$data["bmonth"],$data["bday"]);
		$user = Auth::user();
		$user->update($data);

		return redirect('account/auslands-projekte')->with('infoMsg','Änderungen wurden erfolgreich eingetragen');
	}
}
