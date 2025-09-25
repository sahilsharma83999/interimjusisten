<?php

namespace App\Data;

use Exception;

class Interessen {

	protected static $Interessen = [
		0  => 'Moderator',
		1  => 'Kommunikator',
		2  => 'Teambuilder',
		3  => 'Organisator',
		4  => 'Planer',
		5  => 'Macher',
		6  => 'Unmögliches machbar machen',
		7  => 'Schaut nicht in die Vergangenheit',
		8  => 'Passt sich jeder Situation / Umgebung an',
		9  => 'Zusammen werden wir es schaffen',
		10 => 'bewegt viel',
		11 => 'Zwischenmenschlich',
		12 => 'Er vertraut darauf',
		13 => 'Realisert Dinge',
		14 => 'kontrolliert',
		15 => 'trifft Vorkehrungen',
		16 => 'Kritisch',
		17 => 'realistisch',
		18 => 'technisch orientiert',
		19 => 'Spekuliert',
		20 => 'ist risikofreudig',
		21 => 'übertritt Regeln',
		22 => 'Bewegt viel',
		23 => 'vermittelt gern und gut',
	];

	public static function get()
	{
		return static::$Interessen;
	}

	public static function keyToValue($key)
	{
		if(array_key_exists($key,static::$Interessen)) {
			return static::$Interessen[$key];
		} else {
			throw new Exception('Unknown Interessen Data Key');
		}
	}

	public static function containsKey($key)
	{
		if(array_key_exists($key,static::$Interessen)) {
			return $key;
		} else {
			throw new Exception('Unknown Interessen Data Key');
		}
	}

	// public static function ValueToKey($value)
	// {
	// 	if($return = array_search($value,static::$branches,true)) {
	// 		return $return;
	// 	} else {
	// 		throw new Exception('Unknown Branche Data Value');
	// 	}
	// }
}