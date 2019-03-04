<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Crud extends CI_Model {

	function ins($table,$data){
		return $this->db->insert($table,$data);
	}

	function view_get($table){
		return $this->db->get($table)->result();
	}
	function get_pdf(){
		return $this->db->get('file_pdf');
	}
	function get_pdf_baru(){
		$curtime = date_create(date('Y-m-d'));
		$curtime2 = date_create('0000-00-00');
		$diff = date_diff($curtime,$curtime2);
		$satu = array($diff->y,'01','01');
		$implo = implode('-', $satu);
		return $this->db->query('select * from file_pdf where tgl_up >= ?',array($implo));
	}

	function get_pdf_lama(){
		$curtime = date_create(date('Y-m-d'));
		$curtime2 = date_create('0000-00-00');
		$diff = date_diff($curtime,$curtime2);
		$satu = array($diff->y,'01','01');
		$implo = implode('-', $satu);
		return $this->db->query('select * from file_pdf where tgl_up <= ?',array($implo));	
	}
	
	function now(){
		return $this->db->query('select now() as now')->row();
	}
	
	function get_pdftarget(){
		return $this->db->query('select DISTINCT(file_pdf.nama), file_pdf.* from file_pdf, katapdf_target where katapdf_target.namadokumen = file_pdf.nama and file_pdf.uploader != "adminpkmpolinema"');
	}

	function get_pdfsumber(){
		return $this->db->query('select DISTINCT(file_pdf.nama), file_pdf.* from file_pdf, katapdf_sumber where katapdf_sumber.namadokumen2 = file_pdf.nama and file_pdf.uploader = "adminpkmpolinema"');
		//return $this->db->query('select * from file_pdf where uploader = "adminpkmpolinema"');
	}

	function get_stopword(){
		return $this->db->get('stopword')->result();
	}

	function filterstop(){
		return $this->db->query('select * from stopword where huruf = ?',array($huruf))->row();
	}

	/*function baru*/
	function get_sumber(){
		$query = $this->db->query("select * from file_pdf where uploader != 'adminpkmpolinema'")->result();
		foreach ($query as $key => $value) {
			# code...
			$pdf_sumber[] = $value->nama;
		}
		return $pdf_sumber;
	}
	#ini masih error
	function kata_sumber(){
		$qnama_pdf_sumber = $this->get_sumber();
		$arr_hasil_kata_sumber = array();
		foreach ($qnama_pdf_sumber as $nomorpdf_sumber => $value) {
			#$arr_hasil_kata_sumber[$nomorpdf_sumber] = $value;
			$query_kata_sumber = $this->db->query("select kata2 from katapdf_sumber where namadokumen2 = ? ",array($value))->result();
			foreach ($query_kata_sumber as $no_dockumen => $hasil_kata_sumber) {
				# code...
				$arr_hasil_kata_sumber[$no_dockumen] = $hasil_kata_sumber;
			}

		}
		return $arr_hasil_kata_sumber;
		
		
	}

	function ttarget(){
		$query = $this->get_pdftarget()->result();
		foreach ($query as $key => $value) {
			
			$text = $this->db->query('select * from katapdf_target')->result();
		}
		return $text;

	}

	function tsumber(){
		$query = $this->get_pdfsumber()->result();
		foreach ($query as $key => $value) {
			
			$text = $this->db->query('select kata2 from katapdf_sumber')->result();

		}
		return $text;
	}

	function get_abs(){
		
		return $this->db->query('select distinct(file_pdf.nama) as nama_dokumen, file_pdf.* from file_pdf, abstrak where abstrak.namadokumen = file_pdf.nama')->result();

	}

	function get_bab1(){
		
		return $this->db->query('select distinct(file_pdf.nama) as nama_dokumen, file_pdf.* from file_pdf, bab1 where bab1.namadokumen = file_pdf.nama')->result();

	}

	function get_bab2(){
		
		return $this->db->query('select distinct(file_pdf.nama) as nama_dokumen, file_pdf.* from file_pdf, bab2 where bab2.namadokumen = file_pdf.nama')->result();

	}

	

	

}

/* End of file M_Crud.php */
/* Location: ./application/models/M_Crud.php */