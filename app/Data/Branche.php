<?php

namespace App\Data;

use Exception;

class Branche {

	protected static $branches = [
		0 => 'Automotive',
		1 => 'Bank',
		2 => 'Facility Management',
		3 => 'Großanlagenbau',
		4 => 'Hoch- und Tiefbau',
		5 => 'Klinik / Krankenhaus',
		6 => 'Maschinenbau Logistik',
		7 => 'Marketing',
		8 => 'Öffentlicher Dienst',
		9 => 'PPP Public-Private Partnership',
		10 => 'Service Instandhaltung/Industrial Service',
		11 => 'Versicherung',
	];

	public static function get()
	{
		return static::$branches;
	}
 
	public static function keyToValue($key)
	{
		if(array_key_exists($key,static::$branches)) {
			return static::$branches[$key];
		} else {
			throw new Exception('Unknown Branche Data Key');
		}
	}

	public static function containsKey($key)
	{
		if(array_key_exists($key,static::$branches)) {
			return $key;
		} else {
			throw new Exception('Unknown Branche Data Key');
		}
	}

	public static function ValueToKey($value)
	{
		if($return = array_search($value,static::$branches,true)) {
			return $return;
		} else {
			throw new Exception('Unknown Branche Data Value');
		}
	}
}