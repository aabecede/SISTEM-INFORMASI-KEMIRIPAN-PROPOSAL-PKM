<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Querypage extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	function insert($dataarray){
		for($i=1;$i<count($dataarray);$i++){
			$data = array(
				'character' => $dataarray[$i]['character'],
			);
			$this->db->insert('stopword',$data);
		}
	}

	function update($dataarray){
		for($i=1;$i<count($dataarray);$i++){
			$data = array(
				'character' => $dataarray[$i]['character'],
			);
			$param = array(
				'id'=>$dataarray[$i][$i]
			);
			$this->db->where($param);
			return $this->db->update('stopword',$data);
		}
	}

	function search($dataarray){
		for ($i=1; $i <count($dataarray) ; $i++) { 
			$search = array(
				'character' => $dataarray[$i]['character']
			);
		}
		$data = array();
		$this->db->where($search);
		$this->db->limit(1);
		$q = $this->db->get_where('stopword');
		if($q->num_rows()>0){
			$data = $q->row_array();
		}
		$q->free_result();
		return $data;
	}
	

}

/* End of file Querypage.php */
/* Location: ./application/models/Querypage.php */