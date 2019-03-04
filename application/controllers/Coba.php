<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller {

	public function index()
	{
		$data = array(
			'composer' => $this->load->view('vendor/autoload'),
		);

		

		$this->load->view('CobaInput');
	}

}

/* End of file Coba.php */
/* Location: ./application/controllers/Coba.php */