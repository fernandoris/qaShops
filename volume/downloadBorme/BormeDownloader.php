<?php
namespace BormeDownloader;

class BormeDownloader
{
	public function downloadBorme ($url)
	{
		try{
			$this->isUrlValid($url);
			$this->urlIsPdf($url);
			$tmpFile = $this->downloadFile($url);
			$text = $this->parsePdf($tmpFile);
			$newFilename = pathinfo($tmpFile,PATHINFO_FILENAME).'.txt';
			$bytes  = file_put_contents(Config::get()['TXTDIR']."/".$newFilename,$text)!==flase;
			if($bytes!==false)
			{
				unlink($tmpFile);
				return Config::get()['TXTDIR']."/".$newFilename;
			}else{
				throw new \Exception('No se ha podido escribir el fichero correspondiente a la url : '.$url);
			}
		}catch (Exception $e){
			throw $e;
		}catch (\DomainException $e){
			throw $e;
		}
	}

	private function urlIsPdf($url)
	{
		if (!in_array("Content-Type: application/pdf", get_headers($url)))
		{
			throw new \DomainException('La url no es un pdf : '.$url);
		}
	}

	private function parsePdf($tmpFile)
	{
		$parser = new \Smalot\PdfParser\Parser();
		$pdf    = $parser->parseFile($tmpFile);
		$text   = $pdf->getText();
		return $text;
	}

	private function downloadFile($url)
	{
		$fileName = BormeDownloader::getFilenameFormURL($url);
		$dest = Config::get()['TMPDIR']."/".$fileName;
		if(copy($url,$dest)){
			return $dest;
		}else{
			throw new Exception( 'No se ha podido descargar : ' . $url );
		}
	}

	private function isUrlValid($url)
	{
		if(filter_var($url,FILTER_VALIDATE_URL))
		{
			return true;
		}else{
			throw new \DomainException('Url inválida : '.$url);
		}
	}

	public static function getFilenameFormURL($url)
	{
		$parts = explode('/', $url);
		return array_pop($parts);
	}


}