<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controllererror extends CI_Controller{

	public function index()
	{
		$this->load->view('error404');
	}
}
?>