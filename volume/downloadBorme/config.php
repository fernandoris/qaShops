<?php
namespace BormeDownloader;

class Config
{
	public static function get(){
		return [
			'TMPDIR' => __DIR__."/tmp"
		];
	}
}