<?php

require_once __DIR__."/vendor/autoload.php";
use BormeDownloader\BormeDownloader;

$url = 'https://www.boe.es/borme/dias/2017/01/10/pdfs/BORME-A-2017-6-41.pdf';

$bormeDownloader = new BormeDownloader();

try{
	echo $bormeDownloader->downloadBorme($url);
}catch (Exception $e){
	echo $e -> getMessage();
}catch (DomainException $e){
	echo $e -> getMessage();
}
