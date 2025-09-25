<?php

namespace App\Interfaces;

interface Exportable
{
	/**
	 * return array date for excel export
	 * @return array $data
	 */
	public static function export();
}