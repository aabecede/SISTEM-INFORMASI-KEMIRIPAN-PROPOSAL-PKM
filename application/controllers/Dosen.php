<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		if($this->session->userdata('stat'!= 'login')){
			redirect('login','refresh');
		}else{
			#$nama = $this->session->userdata('nama');
			$this->load->helper('form','url');
			$this->load->model('M_Crud');
		}
	}
	public function index()
	{
		$data = array(
			'nama' => $this->session->userdata('nama')
		);
		$this->load->view('dosen/Header',$data,FALSE);
		$this->load->view('dosen/content');
		echo 'unknow';
		$this->load->view('admin/Footer');
	}

	public function uploadpdf()
	{
		# code...
		$data = array(
			'board' => 'Upload PDF Semua',
			'nama' => $this->session->userdata('nama'),
			'tabel1' => $this->M_Crud->get_pdf('2018-01-01')->result(),
			'stat' => $this->session->userdata('stat'),

		);
		#$this->echopre($data);
		$this->load->view('dosen/Header',$data,FALSE);
		$this->load->view('dosen/Uploadpdf');
		$this->load->view('admin/Footer');
	}

//new patch
	public function uploadpdf_abs()
	{
		# code...
		$data = array(
			'board' => 'Upload PDF Abstrak',
			'nama' => $this->session->userdata('nama'),
			'tabel1' => $this->M_Crud->get_abs(),
			'stat' => $this->session->userdata('stat'),

		);
		#$this->echopre($data);
		$this->load->view('dosen/Header',$data,FALSE);
		$this->load->view('dosen/Uploadpdf_abs');
		$this->load->view('admin/Footer');
	}

	public function uploadpdf_bab1()
	{
		# code...
		$data = array(
			'board' => 'Upload PDF Bab I',
			'nama' => $this->session->userdata('nama'),
			'tabel1' => $this->M_Crud->get_bab1(),
			'stat' => $this->session->userdata('stat'),

		);
		#$this->echopre($data);
		$this->load->view('dosen/Header',$data,FALSE);
		$this->load->view('dosen/Uploadpdf_bab1');
		$this->load->view('admin/Footer');
	}

	public function uploadpdf_bab2()
	{
		# code...
		$data = array(
			'board' => 'Upload PDF Bab II',
			'nama' => $this->session->userdata('nama'),
			'tabel1' => $this->M_Crud->get_bab2(),
			'stat' => $this->session->userdata('stat'),

		);
		#$this->echopre($data);
		$this->load->view('dosen/Header',$data,FALSE);
		$this->load->view('dosen/Uploadpdf_bab2');
		$this->load->view('admin/Footer');
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
			redirect('dosen/uploadpdf','refresh');
		}
		else{

			$data = array('upload_data' => $this->upload->data($filename));
			$now = $this->M_Crud->now();
			$now = $now->now;
			$jurusan = $this->input->post('jurusan');
			$db = array(
				'nama' => $filename,
				'uploader' => $this->input->post('uploader'),
				'tgl_up' => $now,
				'jurusan' => $jurusan,
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
				$this->load->view('dosen/ParsingTextpdf');
				redirect('dosen/uploadpdf','refresh');
			}else{
				echo '<script>alert("Gagal Upload")</script>';
				redirect('dosen/uploadpdf','refresh');
			}
		}
	}

	function importpdf_abs(){
		$filename = time().$_FILES['filepdf']['name'];
		$config['file_name'] = $filename;
		$config['upload_path'] = './assets/File/';
		$config['allowed_types'] = 'pdf';
		
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('filepdf')){
			$error = array('error' => $this->upload->display_errors());
			echo '<script>alert("'.$error['error'].'")</script>';
			redirect('dosen/uploadpdf_abs','refresh');
		}
		else{

			$data = array('upload_data' => $this->upload->data($filename));
			$now = $this->M_Crud->now();
			$now = $now->now;
			$jurusan = $this->input->post('jurusan');
			$db = array(
				'nama' => $filename,
				'uploader' => $this->input->post('uploader'),
				'tgl_up' => $now,
				'jurusan' => $jurusan,
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
				$this->load->view('dosen/ParsingTextpdf_abs');
				redirect('dosen/uploadpdf_abs','refresh');
			}else{
				echo '<script>alert("Gagal Upload")</script>';
				redirect('dosen/uploadpdf_abs','refresh');
			}
		}
	}

	function importpdf_bab1(){
		$filename = time().$_FILES['filepdf']['name'];
		$config['file_name'] = $filename;
		$config['upload_path'] = './assets/File/';
		$config['allowed_types'] = 'pdf';
		
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('filepdf')){
			$error = array('error' => $this->upload->display_errors());
			echo '<script>alert("'.$error['error'].'")</script>';
			redirect('dosen/uploadpdf_bab1','refresh');
		}
		else{

			$data = array('upload_data' => $this->upload->data($filename));
			$now = $this->M_Crud->now();
			$now = $now->now;
			$jurusan = $this->input->post('jurusan');
			$db = array(
				'nama' => $filename,
				'uploader' => $this->input->post('uploader'),
				'tgl_up' => $now,
				'jurusan' => $jurusan,
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
				$this->load->view('dosen/ParsingTextpdf_bab1');
				redirect('dosen/uploadpdf_bab1','refresh');
			}else{
				echo '<script>alert("Gagal Upload")</script>';
				redirect('dosen/uploadpdf_bab1','refresh');
			}
		}
	}

	function importpdf_bab2(){
		$filename = time().$_FILES['filepdf']['name'];
		$config['file_name'] = $filename;
		$config['upload_path'] = './assets/File/';
		$config['allowed_types'] = 'pdf';

		
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('filepdf')){
			$error = array('error' => $this->upload->display_errors());
			echo '<script>alert("'.$error['error'].'")</script>';
			redirect('dosen/uploadpdf_bab2','refresh');
		}
		else{

			$data = array('upload_data' => $this->upload->data($filename));
			$now = $this->M_Crud->now();
			$now = $now->now;
			$jurusan = $this->input->post('jurusan');
			$db = array(
				'nama' => $filename,
				'uploader' => $this->input->post('uploader'),
				'tgl_up' => $now,
				'jurusan' => $jurusan,
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
				$this->load->view('dosen/ParsingTextpdf_bab2');
				redirect('dosen/uploadpdf_bab2','refresh');
			}else{
				echo '<script>alert("Gagal Upload")</script>';
				redirect('dosen/uploadpdf_bab2','refresh');
			}
		}
	}

	function echopre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

}

/* End of file Dosen.php */
/* Location: ./application/controllers/Dosen.php */