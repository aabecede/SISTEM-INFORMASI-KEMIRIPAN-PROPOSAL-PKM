<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Querypage');
		#$this->load->helper(array('form', 'url', 'inflector'));
   		$this->load->library('form_validation');
	}
	public function index()
	{
		/*#$this->load->view('welcome_message');
		#$path='C:\xampp\htdocs\aab\skripsi\aa.pdf';
		$file = '\file\ee.pdf';
		$path = 'C:\xampp\htdocs\aab\sik\assets'.$file;
		#$path = base_url('assets/file/ee.pdf');
		#$content = shell_exec('C:/xpdf/pdftotext -enc "UTF-8" '.$path.' -');
		$content = shell_exec(base_url('assets/xpdf/pdftotext -enc "UTF-8" '.$path.'-'));
		echo $content;
		var_dump($content);*/
		$data = array(
			'composer' => $this->load->view('vendor/autoload'),
		);
		$this->load->view('Coba');
	}

	#import file stopword
	public function importstopword()
	{
		$this->load->view('import/importstopword');
	}

	public function importexcel(){
		$fileName = $_FILES['fileexcel']['name'];
	$config['file_name'] = $fileName;
    $config['allowed_types'] = 'xls|xlsx|csv';
	$config['upload_path'] = './ImportExcel/';
    $config['allowed_types'] = 'xls';
                
    $this->load->library('upload', $config);

     if (! $this->upload->do_upload('fileexcel'))
     {
            $data = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata('msg_excel', 'Insert failed. Please check your file, only .xls file allowed.');
            echo $data['error'];
            echo $fileName.'<br>';
            echo 'Masih gagal';
     }
     else
     {
            $data = array('error' => false);
            $upload_data = $this->upload->data();

            $this->load->library('excel_reader');
            $this->excel_reader->setOutputEncoding('CP1251');

            $file =  $upload_data['full_path'];
            $this->excel_reader->read($file);
            error_reporting(E_ALL ^ E_NOTICE);

            // Sheet 1
            $data = $this->excel_reader->sheets[0] ;
            $dataexcel = Array();
            for ($i = 1; $i <= $data['numRows']; $i++) {
               if($data['cells'][$i][1] == '') break;
               $dataexcel[$i-1]['character'] = $data['cells'][$i][1];
            }
          /*  for ($j =1;$j<=$data['numRows'];$j++)
            {
              if($data['cells'][$j][1] == '') break;
              $dataexcel[$j-1]['username'] = $data['cells'][$j][2];
              $dataexcel[$j-1]['password'] = $data['cells'][$j][2];
              $dataexcel[$j-1]['nama'] = $data['cells'][$j][1];
              $dataexcel[$j-1]['level'] = $data['cells'][$j]['2'];
              $dataexcel[$j-1]['username'] = $data['cells'][$j]['1'];
            }*/
    //cek data
    $check= $this->Querypage->search($dataexcel); 
	    if (count($check) > 0)
	    {
	      $this->Querypage->update($dataexcel); #update chapter when database is exist
	      // set pesan
	      $this->session->set_flashdata('msg_excel', 'update data success');
	  }else{
	      $this->Querypage->insert($dataexcel); //insert data
	      #$this->Querypage->insert_login($dataexcel);
	      // set pesan
	      $this->session->set_flashdata('msg_excel', 'inserting data success');
	  }
	  echo 'berhasil';
  	}
  	#redirect('welcome/gahe');

	}

	function gahe()
	{
		$now = date('Y-m-d H:m:s');
		$tanggal = date_create('2018-01-13 12:13:14');
		$default = date_create('0000-00-00 00:00:00');
		$diff = date_diff($default,$tanggal);
		
		echo 'Last Modified '. $diff->y.' '.$diff->m.' '.$diff->d;
	}

	function cobacoba(){
		/*$kata = "Hello Pattern"; //3 huruf
		$katacoba = "Hello Word";
		echo similar_text($kata,$kata,$persen);
		$stop = $this->db->get('stopword')->result();
		$exp = explode(' ',$kata);
		foreach ($exp as $key => $value) {
			$query = $this->db->query('select * from stopword where huruf="'.$value.'" ')->row();
			if($query == true){
				$deteksi[] = $query->huruf;
			}else{
				$filter[] = $value;
			}
		}
		var_dump($filter);*/
		$this->load->view('vendor/autoload');
		$this->load->view('admin/ParsingTextpdf');
		
	}

	function vina(){
		$matrix = array('1','2','3','4','5','6');
		$hitungan = array('123','456','789','124','234','345');
		#var_dump(count($hitungan));
		$no=0;
		for ($i=0; $i<3 ; $i++) { 
			for ($j=0; $j<2 ; $j++) { 
				$matt[$i][$j]= $matrix[$no];
				echo $matt[$i][$j];
				$no++;
			}
			echo '<br>';
			
		}
	}




	
}
