<?php

namespace App\Data;

class Schwerpunkte {

	protected static $schwerpunkte = [
		0  => ' ',
		1  => 'Angloamerikanische',
		2  => 'Chinesische Unternehmen',
		3  => 'Familien-Unternehmen',
		4  => 'Französische Unternehmen',
		5  => 'Indische Unternehmen',
		6  => 'Japanische Unternehmen ',
		7  => 'Konzern-Unternehmen ',
		8  => 'Handwerk',
		9  => 'Dienstleistung',
		10 => 'Produzierendes UN',
		11 => 'B2B',
		12 => 'B2C',
		13 => 'Sonstiges',
	];

	public static function get()
	{
		return static::$schwerpunkte;
	}

	public static function containsKey($key)
	{
		if(array_key_exists($key,static::$schwerpunkte)) {
			return $key;
		} else {
			throw new Exception('Unknown Schwerpunkt Data Key');
		}
	}

	public static function keyToValue($key)
	{
		if(array_key_exists($key,static::$schwerpunkte)) {
			return static::$schwerpunkte[$key];
		} else {
			throw new Exception('Unknown schwerpunkte Data Key');
		}
	}

}