<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdfparser extends CI_Controller {

	public function index()
	{
		
	}

	function file_pdf_parser($file){
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($file);
        $text = $pdf->getText();
        return $text;
    }

}

/* End of file Pdfparser.php */
/* Location: ./application/controllers/Pdfparser.php */