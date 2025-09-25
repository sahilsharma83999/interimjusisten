<?php

namespace App\Generators;

class FilenameGenerator {
	protected $tick = 0;

	public function generate($file)
	{
		//UserTime hash plus $tick
		$this->tick++;
		return md5(\Auth::user()->id.time()).'-'.$this->tick.'.'.$file->getClientOriginalExtension();
	}
}