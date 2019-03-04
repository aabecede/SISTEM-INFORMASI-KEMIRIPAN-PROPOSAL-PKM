<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	var $date = 'select current_date as now';

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$now = $this->db->query($this->date)->row();
		$now = $now->now;
		$this->load->model('m_login');
		$this->load->library('formula');

		if($now >= $this->formula->date_lc()){
			redirect('Lc','refresh');
		}
		
	}

	public function index()
	{
		$this->load->view('login');
		$this->session->sess_destroy();
	}

	function proses(){
		
		
		$where = array(
			'username' => $this->input->post('username'), 
			'password' => md5($this->input->post('password')),
		);

		$cek = $this->m_login->cek_login('login',$where)->num_rows(); //cheking proses when there an exist id
		$query = $this->m_login->cek_login('login',$where)->row();
		//getting some data from table login

		#proses cheking while data is already exist
		if($cek > 0) // is data avaible ?
		{
			if($where['username'] == 'adminpkmpolinema'){
				$data_session = array(
					'nama' => $query->username,
					'stat' => 'login',
					'ha' => 'admin'
				);
				$this->session->set_userdata($data_session);
				redirect('admin2/','refresh');
			}else{
				$data_session = array(
					'nama' => $query->username,
					'stat' => 'login',
					'ha' => 'dosen',
				);
				$this->session->set_userdata($data_session);
				redirect('dosen','refresh');
			}
		}else{
			$data = array(
				'alert' => var_dump($where),
			);
			redirect('login','refresh',$data);
		}

	}

	function logout(){
		$this->session->sess_destroy();
		$data = array( 
			'alert' => $this->session->flashdata('Berhasil Logout')
		);
		redirect('login','refresh',$data);
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */