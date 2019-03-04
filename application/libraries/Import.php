<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		#$this->load->mode
	}

	function importexcel(){
		$fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './assets/ImportExcel'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        #$media = $this->upload->data('file');
        $inputFileName = './assets/ImportExcel/'.$fileName;
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "huruf"=> $rowData[0][0],
                    
                );
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("stopword",$data);
                delete_files($fileName);
                     
            }
        redirect('welcome/gahe');
    
	}

}

/* End of file Coba.php */
/* Location: ./application/controllers/Coba.php */