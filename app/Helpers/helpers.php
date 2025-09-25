<?php

use Carbon\Carbon;
	
function getEnumValues($model,$colum)
{
	return explode("','",
		substr(
			DB::select("SHOW COLUMNS FROM ".(new $model)->getTable()." LIKE '".$colum."'")[0]->Type
			, 6, -2)
		);
}

function file_upload_max_size()
{
	static $max_size = -1;

	if ($max_size < 0) {
    	// Start with post_max_size.
		$max_size = parse_size(ini_get('post_max_size'));

    	// If upload_max_size is less, then reduce. Except if upload_max_size is
    	// zero, which indicates no limit.
		$upload_max = parse_size(ini_get('upload_max_filesize'));
		if ($upload_max > 0 && $upload_max < $max_size) {
			$max_size = $upload_max;
		}
	}
	return $max_size;
}

function parse_size($size)
{
  	$unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
  	$size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
  	if ($unit) {
    	// Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
  		return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
  	} else {
  		return round($size);
  	}
}

function deltaYears(Carbon\Carbon $start, Carbon\Carbon $end)
{
	return $end->year - $start->year;
}

function deltaMonths($start, $end): int
{
    if (!$start || !$end) {
        return 0;
    }

    // Convert to Carbon if strings are passed
    if (is_string($start)) {
        $start = Carbon::parse($start);
    }
    if (is_string($end)) {
        $end = Carbon::parse($end);
    }

    return $start->diffInMonths($end);
}


function isValidTimeSpan(Carbon\Carbon $start, Carbon\Carbon $end)
{
	if($start->timestamp < $end->timestamp) {
		return true;
	} else {
		return false;
	}
}