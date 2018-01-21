<?php
namespace BormeDownloader;

class BormeDownloader
{
	public static function downloadBorme($url)
	{
		if(filter_var($url,FILTER_VALIDATE_URL))
		{

		}else{
			throw new DomainException('Url inválida : '.$url);
		}
	}



}