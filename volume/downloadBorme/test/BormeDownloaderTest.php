<?php
require_once __DIR__."/../vendor/autoload.php";
use BormeDownloader\BormeDownloader;

class BormeDownloaderTest extends PHPUnit\Framework\TestCase
{
	private $bormeDownloader;

	/**
	 * @before
	 */
	public function setBormeDownloader()
	{
		$this -> bormeDownloader = new BormeDownloader();
	}

	public function testUrlIsPdf()
	{
		$url = 'https://www.boe.es/borme/dias/2017/01/10/pdfs/BORME-A-2017-6-41.pdf';
		$this->assertTrue($this->bormeDownloader->urlIsPdf($url));
	}

	/**
	 * @expectedException DomainException
	 */
	public function testUrlIsPdfException()
	{
		$url = 'http://www.qashops.com/';
		$this->bormeDownloader->urlIsPdf($url);
	}
}