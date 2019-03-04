<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formula
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	function date_lc(){
		$date = '2019-04-10';
		return $date;
	}
	

}

/* End of file Formula.php */
/* Location: ./application/libraries/Formula.php */
