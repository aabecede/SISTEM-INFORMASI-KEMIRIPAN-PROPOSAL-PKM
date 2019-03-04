<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		#chekcing ur session is avaible or no, when session is exist it could be access this other is denied
		if($this->session->userdata('stat'!= 'login') or $this->session->userdata('nama') != 'adminpkmpolinema'){
			redirect('login','refresh');
		}else{
			#$nama = $this->session->userdata('nama');
			$this->load->helper('form','url');
			$this->load->model('M_Crud');
			$this->load->model('Metode');
			$this->load->model('Metode2');
			$this->load->model('Metode_fix');
		}
	}

	public function index()
	{
			$data = array(
				'nama' => $this->session->userdata('nama'),
				
			);
			#$this->load->view('admin/FullContent',$data,FALSE);
			$this->load->view('admin/Header',$data,FALSE);
			$this->load->view('admin/Content');
			$this->load->view('admin/Footer');
			#echo '<a href="'.site_url('login/logout').'">logout</a>';
	}

	public function datalogin()
	{
		$table = 'login';
		$data = array(
			'nama' => $this->session->userdata('nama'),
			'board' => 'Data Login',
			'tabel1' => $this->M_Crud->view_get($table),
		);
		$this->load->view('admin/header',$data,FALSE);
		$this->load->view('admin/datalogin');
		$this->load->view('admin/footer');
	}

	public function daftarkata()
	{
		$table = 'stopword';
		$data = array(
			'nama'=> $this->session->userdata('nama'),
			'tabel1' => $this->M_Crud->view_get($table),
		);
		var_dump($data);
	}

	public function pdf()
	{
		
		$data = array(
			'board' => 'PDF',
			'nama'=> $this->session->userdata('nama'),
			'tabel1' => $this->M_Crud->get_pdf_lama()->result(),
			'tabel2' => $this->M_Crud->get_pdf_baru()->result(),
		);
		#var_dump($data);
		
		$this->load->view('admin/Header',$data,FALSE);
		$this->load->view('admin/PDF');
		$this->load->view('admin/Footer');
	}

	public function uppdf()
	{
		$data = array(
			'board' => 'Upload PDF',
			'nama'=> $this->session->userdata('nama'),
			'tabel1' => $this->M_Crud->view_get('file_pdf'),
		);
		$this->load->view('admin/header',$data,FALSE);
		$this->load->view('admin/uploadpdf');
		$this->load->view('admin/footer');
	}

	function importpdf(){
		$filename = time().$_FILES['filepdf']['name'];
		$config['file_name'] = $filename;
		$config['upload_path'] = './assets/File/';
		$config['allowed_types'] = 'pdf';
		
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('filepdf')){
			$error = array('error' => $this->upload->display_errors());
			echo '<script>alert("'.$error['error'].'")</script>';
			redirect('admin/uppdf','refresh');
		}
		else{

			$data = array('upload_data' => $this->upload->data($filename));
			$now = $this->M_Crud->now();
			$now = $now->now;
			$db = array(
				'nama' => $config['file_name'],
				'uploader' => $this->input->post('uploader'),
				'tgl_up' => $now,
				'status' => 'acc',
			);
			$query = $this->M_Crud->ins('file_pdf',$db);
			if($query == true){
				$row = array(
					'pdf' => $config['file_name'],
					'stopword' => $this->M_Crud->get_stopword(),
					#'insert' => $this->M_Crud->ins(),
				);
				echo '<script>alert("Berhasil Upload")</script>';
				$this->load->view('vendor/autoload',$row);
				$this->load->view('admin/ParsingTextpdf');
				redirect('admin/uppdf','refresh');
			}else{
				echo '<script>alert("Gagal Upload")</script>';
				redirect('admin/uppdf','refresh');
			}
		}
	}

	/*------------------------------------SIMILARITY-----------------------*/
	public function presesimilarity()
	{
		$data =  array(
			'nama'=> $this->session->userdata('nama'),
			'board' => 'Prosentase Similarity',
			#'composer' => $this->load->view('vendor/autoload'),
			'pdfsumber' => $this->M_Crud->get_pdfsumber()->result(),
			'pdftarget' => $this->M_Crud->get_pdftarget()->result(),
		);
		
		$data['kata_sumber'] = $this->Metode_fix->get_TiapKataSumber($data['pdfsumber']);
		$data['kata_target'] = $this->Metode_fix->get_TiapKataTarget($data['pdftarget']);
		$data['sim_kata_target'] = $this->Metode_fix->similarity_Kata_Target($data['kata_target'],$data['kata_sumber']);
		$data['sim_kata_sumber'] = $this->Metode_fix->similarity_Kata_Sumber($data['kata_target'],$data['kata_sumber']);
		$data['match'] = $this->Metode_fix->exactmatch($data['sim_kata_target'],$data['sim_kata_sumber']);
	
		#$this->echopre($data);
		if(count($data['kata_sumber']) > 0 and count($data['kata_target']) > 0){

			$this->load->view('admin/header',$data,FALSE);
			$this->load->view('admin/Fixmeto2');
			$this->load->view('admin/footer');	
			
		}else{

			echo '<script>alert("Tidak ada perbandingan data");</script>';
			redirect('admin/pdf','refresh');

		}
		
		
	}

	function coba(){
		$coba = $this->M_Crud->kata_sumber();
		$this->echopre($coba);
	}

	function echopre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

	
	/*----------------------------------END SIMILARITY --------------------*/

	


}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */