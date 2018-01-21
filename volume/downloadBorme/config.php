<?php
namespace BormeDownloader;

class Config
{
	/**
	 * Devuelve un array con la configuración básica.
	 * @return array
	 */
	public static function get(){
		return [
			'TMPDIR' => __DIR__."/tmp",
			'TXTDIR' => __DIR__."/txt"
		];
	}
}