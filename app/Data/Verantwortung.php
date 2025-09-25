<?php

namespace App\Data;

use Exception;

class Verantwortung {

	protected static $amountForPersonal = [
		0 => 'bis 10 Personen',
		1 => 'bis 100 Personen',
		2 => 'bis 600 Personen',
		3 => 'bis 1.000 Personen',
		4 => 'über 1.000 Personen',
	];

	protected static $amountForUmsatz = [
		5 => 'bis 500.000 €',
		6 => 'bis 1 Millionen €',
		7 => 'bis 5 Millionen €',
		8 => 'bis 10 Millionen €',
		9 => 'über 10 Millionen €',
	];

	protected static $amountForBudget = [
		10 => 'bis 500.000 €',
		11 => 'bis 1 Millionen €',
		12 => 'bis 5 Millionen €',
		13 => 'bis 10 Millionen €',
		14 => 'über 10 Millionen €',
	];

	protected static $amountForEinkauf = [
		15 => 'bis 500.000 €',
		16 => 'bis 1 Millionen €',
		17 => 'bis 5 Millionen €',
		18 => 'bis 10 Millionen €',
		19 => 'über 10 Millionen €',
	];

	protected static $periodForPersonal = [
		0 => '1-3 Jahre',
		1 => '2-4 Jahre',
		2 => '3-5 Jahre',
		3 => 'Über 5 Jahre',
		4 => '1 Jahre',
		5 => '2 Jahre',
		6 => '3 Jahre',
		7 => '4 Jahre',
		8 => '5 Jahre',
		9 => '6 Jahre',
		10 => '7 Jahre',
		11 => '8 Jahre',
		12 => '9 Jahre',
		13 => '10 Jahre',
		14 => '11 Jahre',
		15 => '12 Jahre',
	];

	protected static $periodForUmsatz = [
		100 => '1-3 Jahre',
		101 => '2-4 Jahre',
		102 => '3-5 Jahre',
		103 => 'Über 5 Jahre',
		104 => '1 Jahre',
		105 => '2 Jahre',
		106 => '3 Jahre',
		107 => '4 Jahre',
		108 => '5 Jahre',
		109 => '6 Jahre',
		1010 => '7 Jahre',
		1011 => '8 Jahre',
		1012 => '9 Jahre',
		1013 => '10 Jahre',
		1014 => '11 Jahre',
		1015 => '12 Jahre',
	];

	protected static $periodForBudget = [
		200 => '1-3 Jahre',
		201 => '2-4 Jahre',
		202 => '3-5 Jahre',
		203 => 'Über 5 Jahre',
		204 => '1 Jahre',
		205 => '2 Jahre',
		206 => '3 Jahre',
		207 => '4 Jahre',
		208 => '5 Jahre',
		209 => '6 Jahre',
		2010 => '7 Jahre',
		2011 => '8 Jahre',
		2012 => '9 Jahre',
		2013 => '10 Jahre',
		2014 => '11 Jahre',
		2015 => '12 Jahre',
	];

	protected static $periodForEinkauf = [
		300 => '1-3 Jahre',
		301 => '2-4 Jahre',
		302 => '3-5 Jahre',
		303 => 'Über 5 Jahre',
		304 => '1 Jahre',
		305 => '2 Jahre',
		306 => '3 Jahre',
		307 => '4 Jahre',
		308 => '5 Jahre',
		309 => '6 Jahre',
		3010 => '7 Jahre',
		3011 => '8 Jahre',
		3012 => '9 Jahre',
		3013 => '10 Jahre',
		3014 => '11 Jahre',
		3015 => '12 Jahre',
	];

	protected static $typs = [
		'personal' => 'Personalverantwortung',
		'umsatz' => 'Umsatzverantwortung',
		'budget' => 'Budgetverantwortung',
		'einkauf' => 'Einkaufsverantwortung'
	];

	public static function getTyp()
	{
		return static::$typs;
	}

	public static function getAmountForPersonal()
	{
		return static::$amountForPersonal;
	}

	public static function getPeriodForPersonal()
	{
		return static::$periodForPersonal;
	}

	public static function getAmountForUmsatz()
	{
		return static::$amountForUmsatz;
	}

	public static function getPeriodForUmsatz()
	{
		return static::$periodForUmsatz;
	}

	public static function getAmountForBudget()
	{
		return static::$amountForBudget;
	}

	public static function getPeriodForBudget()
	{
		return static::$periodForBudget;
	}

	public static function getAmountForEinkauf()
	{
		return static::$amountForEinkauf;
	}

	public static function getPeriodForEinkauf()
	{
		return static::$periodForEinkauf;
	}

	public static function containsKeyForPersonalPeriod($key)
	{
		return static::containsKey('periodForPersonal',$key);
	}

	public static function containsKeyForPersonalAmount($key)
	{
		return static::containsKey('amountForPersonal',$key);
	}

	public static function containsKeyForUmsatzPeriod($key)
	{
		return static::containsKey('periodForUmsatz',$key);
	}

	public static function containsKeyForUmsatzAmount($key)
	{
		return static::containsKey('amountForUmsatz',$key);
	}

	public static function containsKeyForBudgetPeriod($key)
	{
		return static::containsKey('periodForBudget',$key);
	}

	public static function containsKeyForBudgetAmount($key)
	{
		return static::containsKey('amountForBudget',$key);
	}

	public static function containsKeyForEinkaufPeriod($key)
	{
		return static::containsKey('periodForEinkauf',$key);
	}

	public static function containsKeyForEinkaufAmount($key)
	{
		return static::containsKey('amountForEinkauf',$key);
	}

	protected static function containsKey($arrayString,$key)
	{
		if(array_key_exists($key,static::$$arrayString)) {
			return $key;
		} else {
			throw new Exception('Unknown Branche Data Key');
		}
	}

	public static function keyToValueEinkaufPeriod($key)
	{
		if(array_key_exists($key,static::$periodForEinkauf)) {
			return static::$periodForEinkauf[$key];
		} else {
			throw new Exception('Unknown EinkaufPeriod Data Key');
		}
	}
	public static function keyToValueEinkaufAmount($key)
	{
		if(array_key_exists($key,static::$amountForEinkauf)) {
			return static::$amountForEinkauf[$key];
		} else {
			throw new Exception('Unknown EinkaufAmount Data Key');
		}
	}

	public static function keyToValueBudgetPeriod($key)
	{
		if(array_key_exists($key,static::$periodForBudget)) {
			return static::$periodForBudget[$key];
		} else {
			throw new Exception('Unknown BudgetPeriod Data Key');
		}
	}
	public static function keyToValueBudgetAmount($key)
	{
		if(array_key_exists($key,static::$amountForBudget)) {
			return static::$amountForBudget[$key];
		} else {
			throw new Exception('Unknown BudgetAmount Data Key');
		}
	}

	public static function keyToValueUmsatzPeriod($key)
	{
		if(array_key_exists($key,static::$periodForUmsatz)) {
			return static::$periodForUmsatz[$key];
		} else {
			throw new Exception('Unknown UmsatzPeriod Data Key');
		}
	}
	public static function keyToValueUmsatzAmount($key)
	{
		if(array_key_exists($key,static::$amountForUmsatz)) {
			return static::$amountForUmsatz[$key];
		} else {
			throw new Exception('Unknown UmsatzAmount Data Key');
		}
	}

	public static function keyToValuePersonalPeriod($key)
	{
		if(array_key_exists($key,static::$periodForPersonal)) {
			return static::$periodForPersonal[$key];
		} else {
			throw new Exception('Unknown Personal Period Data Key');
		}
	}
	public static function keyToValuePersonalAmount($key)
	{
		if(array_key_exists($key,static::$amountForPersonal)) {
			return static::$amountForPersonal[$key];
		} else {
			throw new Exception('Unknown PersonalAmount Data Key');
		}
	}
}