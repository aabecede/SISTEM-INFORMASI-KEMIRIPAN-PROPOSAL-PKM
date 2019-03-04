<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin2 extends CI_Controller {

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
			$this->load->model('Metode_abs');
			$this->load->model('Metode_bab');
			$this->load->model('Metode_bab2');
			$this->load->model('Metode_all');
		}
	}

	public function index()
	{
			$data = array(
				'nama' => $this->session->userdata('nama'),
				'icon' => 'Dashboard',
			);
			#$this->load->view('admin/FullContent',$data,FALSE);
			$this->load->view('admin/HeaderLumino',$data,FALSE);
			$this->load->view('admin/new/Content');
			$this->load->view('admin/FooterLumino');
			#echo '<a href="'.site_url('login/logout').'">logout</a>';
	}

	public function datalogin()
	{
		$table = 'login';
		$data = array(
			'nama' => $this->session->userdata('nama'),
			'icon' => 'Data Login',
			'tabel1' => $this->M_Crud->view_get($table),
		);
		$this->load->view('admin/HeaderLumino',$data,FALSE);
		$this->load->view('admin/new/datalogin');
		$this->load->view('admin/FooterLumino');
	}

	public function daftarkata()
	{
		$table = 'stopword';
		$data = array(
			'icon' => 'Daftar Kata',
			'nama'=> $this->session->userdata('nama'),
			'tabel1' => $this->M_Crud->view_get($table),
		);
		#var_dump($data);
		$this->load->view('admin/HeaderLumino',$data,FALSE);
		$this->load->view('admin/new/DaftarKata');
		$this->load->view('admin/FooterLumino');
	}

	public function pdf()
	{
		
		$data = array(
			'icon' => 'PDF',
			'nama'=> $this->session->userdata('nama'),
			'tabel1' => $this->M_Crud->get_pdf_baru()->result(),
			'tabel2' => $this->M_Crud->get_pdf_lama()->result(),
		);
		#var_dump($data);
		
		$this->load->view('admin/HeaderLumino',$data,FALSE);
		$this->load->view('admin/new/PDF');
		$this->load->view('admin/FooterLumino');
	}

	public function uppdf()
	{
		$data = array(
			'board' => 'Upload PDF',
			'nama'=> $this->session->userdata('nama'),
			'tabel1' => $this->M_Crud->view_get('file_pdf'),
		);
		$this->load->view('admin/HeaderLumino',$data,FALSE);
		$this->load->view('admin/new/uploadpdf');
		$this->load->view('admin/FooterLumino');
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
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$start = $time;

		$data =  array(
			'nama'=> $this->session->userdata('nama'),
			'icon' => 'Prosentase Similarity',
			#'composer' => $this->load->view('vendor/autoload'),
			'pdfsumber' => $this->M_Crud->get_pdfsumber()->result(),
			'pdftarget' => $this->M_Crud->get_pdftarget()->result(),
		);
		
		$data['kata_sumber'] = $this->Metode_fix->get_TiapKataSumber($data['pdfsumber']);
		$data['kata_target'] = $this->Metode_fix->get_TiapKataTarget($data['pdftarget']);
		$data['sim_kata_target'] = $this->Metode_fix->similarity_Kata_Target($data['kata_target'],$data['kata_sumber']);
		$data['sim_kata_sumber'] = $this->Metode_fix->similarity_Kata_Sumber($data['kata_target'],$data['kata_sumber']);
		$data['match'] = $this->Metode_fix->exactmatch($data['sim_kata_target'],$data['sim_kata_sumber']);

		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$finish = $time;
		$total_time = round(($finish - $start), 4);

		$data['totalproses'] = 'Finish in '. $total_time .' Second';
	
		#$this->echopre($data);
		if(count($data['kata_sumber']) > 0 and count($data['kata_target']) > 0){
			#$this->echopre($data);
			$this->load->view('admin/HeaderLumino',$data,FALSE);
			$this->load->view('admin/new/Fixmeto2');
			$this->load->view('admin/FooterLumino');	
			
		}else{

			echo '<script>alert("Tidak ada perbandingan data");</script>';
			redirect('admin/pdf','refresh');

		}
		
		
	}

	public function NprosesSimilarity()
	{
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$persen = $this->input->post('persen');
		$jurusan = $this->input->post('jurusan');

		if($awal == null){

			$else = array(
				'nama' => $this->session->userdata('nama'),
				'icon' => 'Presentase PDF',
				/*'input' => $this->input->post(),
				'total_proses' => 'Finish in '. $total_time .' Second',
				'match' => $core['match'],*/
				);
			echo '<script>alert("Inputkan Tanggal dengan benar")</script>';
			#$this->echopre($else);
			$this->load->view('admin/HeaderLumino',$else);
			$this->load->view('admin/new/Metodefull');
			$this->load->view('admin/FooterLumino');
		}else{
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$start = $time;
		$core['pdf_sumber'] = $this->Metode_all->get_sumber($awal, $akhir, $jurusan);
		$core['pdf_target'] = $this->Metode_all->get_target($akhir, $jurusan);
		$core['kata_sumber'] = $this->Metode_all->get_TiapKataSumber($core['pdf_sumber']);
		$core['kata_target'] = $this->Metode_all->get_TiapKataTarget($core['pdf_target']);
		$core['sim_kata_target'] = $this->Metode_all->similarity_Kata_Target($core['kata_target'],$core['kata_sumber']);
		$core['sim_kata_sumber'] = $this->Metode_all->similarity_Kata_Sumber($core['kata_target'],$core['kata_sumber']);
		$core['match'] = $this->Metode_all->exactmatch($core['sim_kata_target'],$core['sim_kata_sumber'], $persen);

		$time = microtime();
		$time = explode(' ', $time);
		@$time = $time[1] + $time[0];
		$finish = $time;
		$total_time = round(($finish - $start), 4);

		if(count($core['pdf_sumber']) == null){

			echo '<script>alert("Data Pdf Sumber Tidak ada")</script>';
			redirect('admin2/NprosesSimilarity','refresh');

		}elseif(count($core['pdf_target']) == null){

			echo '<script>alert("Data Pdf Target Tidak ada")</script>';
			redirect('admin2/NprosesSimilarity','refresh');

		}else{

			#$data['totalproses'] = 'Finish in '. $total_time .' Second';
			$tanggal = $awal.' to '.$akhir.'<br> Dengan Presentase Kemiripan > '.$persen.'%';
			$jurusan = 'Jurusan yang dibandingkan '.$jurusan;

		$data = array(
				'nama' => $this->session->userdata('nama'),
				'icon' => 'Presentase PDF',
				'input' => $this->input->post(),
				'totalproses' => 'Finish in '. $total_time .' Second',
				'match' => $core['match'],
				'jurusan' => $jurusan,
				'tanggal' => $tanggal,
				);

			
			$this->load->view('admin/HeaderLumino',$data,FALSE);
			$this->load->view('admin/new/Metodefull');
			$this->load->view('admin/FooterLumino');
			#$this->echopre($core);

		}

		

		}
	}

	public function exactmatch_abs()
	{

		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$persen = $this->input->post('persen');
		$jurusan =  $this->input->post('jurusan');

		if($awal == null){

			$else = array(
				'nama' => $this->session->userdata('nama'),
				'icon' => 'Presentase Abstrak dan Judul',
				/*'input' => $this->input->post(),
				'total_proses' => 'Finish in '. $total_time .' Second',
				'match' => $core['match'],*/
				);
			echo '<script>alert("Inputkan Tanggal dengan benar")</script>';
			#$this->echopre($else);
			$this->load->view('admin/HeaderLumino',$else);
			$this->load->view('admin/new/MetodeBabAbs');
			$this->load->view('admin/FooterLumino');
		}else{
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$start = $time;
		$core['pdf_sumber'] = $this->Metode_abs->get_sumber($awal, $akhir, $jurusan);
		$core['pdf_target'] = $this->Metode_abs->get_target($akhir, $jurusan);
		$core['kata_sumber'] = $this->Metode_abs->get_TiapKataSumber($core['pdf_sumber']);
		$core['kata_target'] = $this->Metode_abs->get_TiapKataTarget($core['pdf_target']);
		$core['sim_kata_target'] = $this->Metode_abs->similarity_Kata_Target($core['kata_target'],$core['kata_sumber']);
		$core['sim_kata_sumber'] = $this->Metode_abs->similarity_Kata_Sumber($core['kata_target'],$core['kata_sumber']);
		$core['match'] = $this->Metode_abs->exactmatch($core['sim_kata_target'],$core['sim_kata_sumber'], $persen);

		$time = microtime();
		$time = explode(' ', $time);
		@$time = $time[1] + $time[0];
		$finish = $time;
		$total_time = round(($finish - $start), 4);

		if(count($core['pdf_sumber']) == null){

			echo '<script>alert("Data Pdf Sumber Tidak ada")</script>';
			redirect('admin2/exactmatch_abs','refresh');

		}elseif(count($core['pdf_target']) == null){

			echo '<script>alert("Data Pdf Target Tidak ada")</script>';
			redirect('admin2/exactmatch_abs','refresh');

		}else{

			#$data['totalproses'] = 'Finish in '. $total_time .' Second';
			$tanggal = $awal.' to '.$akhir.'<br> Dengan Presentase Kemiripan > '.$persen.'%';
			$jurusan = 'Jurusan yang dibandingkan '.$jurusan;

		$data = array(
				'nama' => $this->session->userdata('nama'),
				'icon' => 'Presentase Abstrak dan Judul',
				'input' => $this->input->post(),
				'totalproses' => 'Finish in '. $total_time .' Second',
				'match' => $core['match'],
				'jurusan' => $jurusan,
				'tanggal' => $tanggal,
				);

			
			$this->load->view('admin/HeaderLumino',$data,FALSE);
			$this->load->view('admin/new/MetodeBabAbs');
			$this->load->view('admin/FooterLumino');
			#$this->echopre($core);

		}

		

		}

			

	}

	public function exactmatch_bab1()
	{

		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$persen = $this->input->post('persen');
		$jurusan = $this->input->post('jurusan');

		if($awal == null){

			$else = array(
				'nama' => $this->session->userdata('nama'),
				'icon' => 'Presentase Bab 1',
				/*'input' => $this->input->post(),
				'total_proses' => 'Finish in '. $total_time .' Second',
				'match' => $core['match'],*/
				);
			echo '<script>alert("Inputkan Tanggal dengan benar")</script>';
			#$this->echopre($else);
			$this->load->view('admin/HeaderLumino',$else);
			$this->load->view('admin/new/MetodeBabI');
			$this->load->view('admin/FooterLumino');
		}else{
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$start = $time;
		$core['pdf_sumber'] = $this->Metode_bab->get_sumber($awal, $akhir, $jurusan);
		$core['pdf_target'] = $this->Metode_bab->get_target($akhir, $jurusan);
		$core['kata_sumber'] = $this->Metode_bab->get_TiapKataSumber($core['pdf_sumber']);
		$core['kata_target'] = $this->Metode_bab->get_TiapKataTarget($core['pdf_target']);
		$core['sim_kata_target'] = $this->Metode_bab->similarity_Kata_Target($core['kata_target'],$core['kata_sumber']);
		$core['sim_kata_sumber'] = $this->Metode_bab->similarity_Kata_Sumber($core['kata_target'],$core['kata_sumber']);
		$core['match'] = $this->Metode_bab->exactmatch($core['sim_kata_target'], $core['sim_kata_sumber'], $persen);

		$time = microtime();
		$time = explode(' ', $time);
		@$time = $time[1] + $time[0];
		$finish = $time;
		$total_time = round(($finish - $start), 4);

		if(count($core['pdf_sumber']) == null){

			echo '<script>alert("Data Pdf Sumber Tidak ada")</script>';
			redirect('admin2/exactmatch_bab1','refresh');

		}elseif(count($core['pdf_target']) == null){

			echo '<script>alert("Data Pdf Target Tidak ada")</script>';
			redirect('admin2/exactmatch_bab1','refresh');

		}else{

			#$data['totalproses'] = 'Finish in '. $total_time .' Second';
			$tanggal = $awal.' to '.$akhir.'<br> Dengan Presentase Kemiripan > '.$persen.'%';
			$jurusan = 'Jurusan yang dibandingkan '.$jurusan;
		$data = array(
				'nama' => $this->session->userdata('nama'),
				'icon' => 'Presentase Bab 1',
				'input' => $this->input->post(),
				'totalproses' => 'Finish in '. $total_time .' Second',
				'match' => $core['match'],
				'jurusan' => $jurusan,
				'tanggal' => $tanggal,
				);

			
			$this->load->view('admin/HeaderLumino',$data,FALSE);
			$this->load->view('admin/new/MetodeBabI');
			$this->load->view('admin/FooterLumino');
			#$this->echopre($core);

		}

		

		}

			

	}

	public function exactmatch_bab2()
	{

		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$jurusan = $this->input->post('jurusan');
		$persen = $this->input->post('persen');
		if($awal == null){

			$else = array(
				'nama' => $this->session->userdata('nama'),
				'icon' => 'Presentase Bab 2',
				/*'input' => $this->input->post(),
				'total_proses' => 'Finish in '. $total_time .' Second',
				'match' => $core['match'],*/
				);
			echo '<script>alert("Inputkan Tanggal dengan benar")</script>';
			#$this->echopre($else);
			$this->load->view('admin/HeaderLumino',$else);
			$this->load->view('admin/new/MetodeBabII');
			$this->load->view('admin/FooterLumino');
		}else{
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$start = $time;
		$core['pdf_sumber'] = $this->Metode_bab2->get_sumber($awal, $akhir, $jurusan);
		$core['pdf_target'] = $this->Metode_bab2->get_target($akhir, $jurusan);
		$core['kata_sumber'] = $this->Metode_bab2->get_TiapKataSumber($core['pdf_sumber']);
		$core['kata_target'] = $this->Metode_bab2->get_TiapKataTarget($core['pdf_target']);
		$core['sim_kata_target'] = $this->Metode_bab2->similarity_Kata_Target($core['kata_target'],$core['kata_sumber']);
		$core['sim_kata_sumber'] = $this->Metode_bab2->similarity_Kata_Sumber($core['kata_target'],$core['kata_sumber']);
		$core['match'] = $this->Metode_bab2->exactmatch($core['sim_kata_target'],$core['sim_kata_sumber'],$persen);

		$time = microtime();
		$time = explode(' ', $time);
		@$time = $time[1] + $time[0];
		$finish = $time;
		$total_time = round(($finish - $start), 4);

		if(count($core['pdf_sumber']) == null){

			echo '<script>alert("Data Pdf Sumber Tidak ada")</script>';
			redirect('admin2/exactmatch_bab2','refresh');

		}elseif(count($core['pdf_target']) == null){

			echo '<script>alert("Data Pdf Target Tidak ada")</script>';
			redirect('admin2/exactmatch_bab2','refresh');

		}else{

			#$data['totalproses'] = 'Finish in '. $total_time .' Second';
			$tanggal = $awal.' to '.$akhir.'<br> Dengan Presentase Kemiripan > '.$persen.'%';
			$jurusan = 'Jurusan yang dibandingkan '.$jurusan;
		$data = array(
				'nama' => $this->session->userdata('nama'),
				'icon' => 'Presentase Bab 2',
				'input' => $this->input->post(),
				'totalproses' => 'Finish in '. $total_time .' Second',
				'match' => $core['match'],
				'Jurusan' => $jurusan,
				'tanggal'=> $tanggal,
				);

			
			$this->load->view('admin/HeaderLumino',$data,FALSE);
			$this->load->view('admin/new/MetodeBabII');
			$this->load->view('admin/FooterLumino');
			#$this->echopre($core);

		}

		

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

/* End of file Admin2.php */
/* Location: ./application/controllers/Admin2.php */