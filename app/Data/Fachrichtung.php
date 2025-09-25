<?php

namespace App\Data;

use Exception;

class Fachrichtung {

	protected static $forAusbildung = [
		0  => 'Agrarrecht',
		1  => 'Arbeitsrecht',
		2  => 'Bank- und Kapitalmarktrecht',
		3  => 'Bau- und Architektenrecht',
		4  => 'Erbrecht',
		5  => 'Familienrecht',
		6  => 'gewerblicher Rechtsschutz',
		7  => 'Handels- und GesellschaIsrecht',
		8  => 'Informationstechnologierecht',
		9  => 'Insolvenzrecht',
		10 => 'Medizinrecht',
		11 => 'Sozialrecht',
		12 => 'Steuerrecht',
		13 => 'Strafrecht',
		14 => 'Transport- und Speditionsrecht',
		15 => 'Urheber- und Medienrecht',
		16 => 'Verkehrsrecht',
		17 => 'Versicherungsrecht',
		18 => 'Verwaltungsrecht',
	];

	protected static $forKarriere = [
		0 => 'Analyst',
		1 => 'Abteilungsleiter',
		2 => 'Consultant',
		3 => 'Direktor',
		4 => 'Partner',
		5 => 'Referent',
		6 => 'Senior Consultant',
		7 => 'Teamleiter',
		8 => 'Geschäftsführer',
		9 => 'Vorstand',
		10 => 'Rechtsanwalt',
	];

	protected static $forSpezialisierung = [
		0  => 'Allgemein',
		1  => 'Arbeitsrecht',
		2  => 'Bank- und Kapitalmarktrecht',
		23 => 'Compliance',
		3  => 'Europa- und Völkerrecht',
		4  => 'Gesellschafts- und Wirtschaftsrecht',
		5  => 'Grundlagen des Rechts',
		6  => 'Immaterialgüterrecht',
		7  => 'Integration ausländischer Rechtsordnungen',
		8  => 'Integriertes Auslandsstudium',
		9  => 'Internationales Privatrecht',
		10 => 'Internationales Strafrecht',
		11 => 'Kultur- und Kirchenrecht',
		12 => 'Medien- und Informationsrecht',
		13 => 'Sonstige Schwerpunkte',
		14 => 'Sozialrecht',
		15 => 'Staats- und Verwaltungsrecht',
		16 => 'Steuerrecht',
		17 => 'Strafrecht und Strafrechtspflege',
		23 => 'Pharmarecht',
		18 => 'Umweltrecht',
		19 => 'Wettbewerbsrecht',
		20 => 'Wirtschaftsstrafrecht',
		21 => 'Zivilrechtspflege Rechtsgestaltung',
		22 => 'Sonstiges',
	];

	public static function getAusbildung()
	{
		return static::$forAusbildung;
	}

	public static function getKarriere()
	{
		return static::$forKarriere;
	}

	public static function getSpezialisierung()
	{
		return static::$forSpezialisierung;
	}

	public static function keyToValueAusbildung($key)
	{
		if(array_key_exists($key,static::$forAusbildung)) {
			return static::$forAusbildung[$key];
		} else {
			throw new Exception('Unknown forAusbildung Data Key');
		}
	}

	public static function keyToValueKarriere($key)
	{
		if(array_key_exists($key,static::$forKarriere)) {
			return static::$forKarriere[$key];
		} else {
			throw new Exception('Unknown forKarriere Data Key');
		}
	}

	public static function keyToValueSpezialisierung($key)
	{
		if(array_key_exists($key,static::$forSpezialisierung)) {
			return static::$forSpezialisierung[$key];
		} else {
			throw new Exception('Unknown forSpezialisierung Data Key');
		}
	}

	public static function containsKeyForKarriere($key)
	{
		if(array_key_exists($key,static::$forKarriere)) {
			return $key;
		} else {
			throw new Exception('Unknown Karriere Fachrichtung Data Key');
		}
	}

	public static function containsKeyForAusbildung($key)
	{
		if(array_key_exists($key,static::$forAusbildung)) {
			return $key;
		} else {
			throw new Exception('Unknown Ausbildung Fachrichtung Data Key');
		}
	}

	public static function containsKeyForSpezialisierung($key)
	{
		if(array_key_exists($key,static::$forSpezialisierung)) {
			return $key;
		} else {
			throw new Exception('Unknown Ausbildung Spezialisierung Data Key');
		}
	}
}