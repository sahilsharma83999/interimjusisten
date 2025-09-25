<?php

namespace App\Data;

use App\KernKompetenz as ModelKompetenz;

class KernKompetenz {

	/**
	 * All Kompetenzen with sublevels
	 * @var array
	 */
	protected static $kompetenzen = [
		'aaa' => ['name' => ' '],
		'a' => ['name' => 'Controlling'],
		'b'  => ['name' => 'Consulting'],
		'c'  => ['name' => 'Due Diligence'],
		'd'  => ['name' => 'Einkauf'],
		'e'  => ['name' => 'Finanzen – Rechnungswesen'],
		'f'  => ['name' => 'Facility Management'],
		'g'  => ['name' => 'Geschäftsführung'],
		'h'  => ['name' => 'HR', [
			'h_a' => ['name' => 'Arbeitsrecht'],
			'h_b' => ['name' => 'Assessment Center'],
			'h_c' => ['name' => 'Online-Recruiting'],
			'h_d' => ['name' => 'Personalabbau bei Restrukturierungen und Betriebsschließungen'],
			'h_e' => ['name' => 'Personalaufbau bei Neugründungen'],
			'h_f' => ['name' => 'Personalentwicklung'],
			'h_g' => ['name' => 'Vergütungssysteme'],
			'h_h' => ['name' => 'Verhandlungen mit BR/Gewerkschaft'],
			'h_i' => ['name' => 'sonstiges'],
		]],
		'i'  => ['name' => 'IT', [
			'i_a' => ['name' => 'Arbeitsrecht'],
			'i_b' => ['name' => 'Assessment Center'],
			'i_c' => ['name' => 'Online-Recruiting'],
			'i_d' => ['name' => 'Personalabbau bei Restrukturierungen und Betriebsschließungen'],
			'i_e' => ['name' => 'Personalaufbau bei Neugründungen'],
			'i_f' => ['name' => 'Personalentwicklung'],
			'i_g' => ['name' => 'Vergütungssysteme'],
			'i_h' => ['name' => 'Verhandlungen mit BR/Gewerkschaft'],
			'i_i' => ['name' => 'sonstiges'],
		]],
		'j'  => ['name' => 'Immobilien'],
		'k' => ['name' => 'Insolvensverfahren'],
		'l' => ['name' => 'Logistik'],
		'm' => ['name' => 'SCM/Procurement'],
		'n' => ['name' => 'Marketing'],
		'o' => ['name' => 'Management', [
			'o_a' => ['name' => 'CEO – Chief Executive Officer'],
			'o_b' => ['name' => 'CIO - Chief Information Officer'],
			'o_c' => ['name' => 'COO - Chief Operating Officer'],
			'o_d' => ['name' => 'CAO - Chief Administrative Officer'],
			'o_e' => ['name' => 'CAO - Chief Analyst Officer'],
			'o_f' => ['name' => 'CIO - Chief Information Officer'],
			'o_g' => ['name' => 'CBO - Chief Branding Officer'],
			'o_h' => ['name' => 'CBDO - Chief Business Development Officer'],
			'o_i' => ['name' => 'CCO - Chief Channel Officer'],
			'o_j' => ['name' => 'CCO - Chief Communication Officer'],
			'o_k' => ['name' => 'CCO - Chief Compliance Officer'],
			'o_l' => ['name' => 'CCO - Chief Content Officer'],
			'o_m' => ['name' => 'CCO - Chief Credit Officer'],
			'o_n' => ['name' => 'CCO – Chief Customer Officer'],
			'o_o' => ['name' => 'CDO - Chief Data Officer'],
			'o_p' => ['name' => 'CFO – Chief Financial Officer'],
			'o_q' => ['name' => 'CHRO - Chief Human Resources Officer'],
			'o_r' => ['name' => 'CISO - Chief Information Security Officer'],
			'o_s' => ['name' => 'CINO - Chief Innovation Officer'],
			'o_t' => ['name' => 'CLO – Chief Legal Officer'],
			'o_u' => ['name' => 'CPO – Chief Process Officer'],
			'o_v' => ['name' => 'CQO - Chief Quality Officer'],
			'o_w' => ['name' => 'CSO – Chief Sales Officer'],
			'o_x' => ['name' => 'CSCO – Chief Supply Chain Officer'],
			'o_y' => ['name' => 'sonstiges'],
		]],
		'p' => ['name' => 'Projektmanagement', [
			'p_a' => ['name' => 'Automotive'],
			'p_b' => ['name' => 'Großanlagenbau'],
			'p_c' => ['name' => 'Hochbau'],
			'p_d' => ['name' => 'IT Hardware'],
			'p_e' => ['name' => 'IT Software'],
			'p_f' => ['name' => 'Maschinenbau'],
			'p_g' => ['name' => 'Solaranlagen'],
			'p_h' => ['name' => 'Systemanlagen'],
			'p_i' => ['name' => 'Tiefbau'],
			'p_j' => ['name' => 'Windkraft'],
			'p_k' => ['name' => 'sonstiges'],
		]],
		'q' => ['name' => 'Projektleiter'],
		'r' => ['name' => 'Produktmanagement'],
		's' => ['name' => 'Property Management'],
		't' => ['name' => 'Sanierung – Restrukturierung – Turnaround-Management'],
		'u' => ['name' => 'Vertrieb'],
		'v' => ['name' => 'Vorstand'],
		'w' => ['name' => 'Werksverlagerung'],
		'x' => ['name' => 'Werkaufbau'],
		'y' => ['name' => 'Werksschließung'],
		'z' => ['name' => 'sonstiges'],
	];

	public static function getKompetenz()
	{
		return static::$kompetenzen;
	}

	public static function keyToName($searchKey)
	{
		foreach(static::$kompetenzen as $key => $value) {
			if($key === $searchKey) {
				return $value["name"];
			}
			if(count($value) > 1) {
				foreach($value[0] as $key2 => $value2) {
					if($key2 === $searchKey) {
						return $value2["name"];
					}
					if(count($value2) > 1) {
						foreach($value2[0] as $key3 => $value3) {
							if($key3 === $searchKey) {
								return $value3["name"];
							}
						}
					}
				}
			}
		}
	}

	public static function keyToNames($key)
	{
		$names = [];
		$keys = explode("_", $key);
		$data = static::$kompetenzen;

		//Per Key
		for($i = 0; $i < count($keys);$i++)
		{
			$currentKey = $keys[0];
			$name = "";
			$data = static::$kompetenzen;

			for($j = 1;$j < $i;$j++)
			{
				$data = $data[$currentKey][0];
				$currentKey = $currentKey."_".$keys[$j];
				echo $currentKey;
			}
			// dd($data[$currentKey]);
			$names["level".($i+1)] = $data[$currentKey]["name"];
		}
		return $names;
	}

	public static function flattenKompetenz()
	{
		$results = [];
		foreach(static::$kompetenzen as $key => $k) {
			$results[$key] = $k["name"];
			if(count($k) > 1) {
				foreach($k[0] as $key2 => $k2) {
					$results[$key2] = $k2["name"];
					if(count($k2) > 1) {
						foreach($k2[0] as $key3 => $k3) {
							$results[$key3] = $k3["name"];
						}
					}
				}
			}
		}
		return $results;
	}
}