<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metode_all extends CI_Model {

	function get_sumber($tgl_awal, $tgl_akhir, $jurusan){

		$tahun = $tgl_awal;
		$tgl_awal = $tahun.'-01-01 00:00:00';
		$tgl_akhir = $tahun.'-12-31 23:59:00';
		return $this->db->query('select distinct(katapdf_target.namadokumen) as nama2, file_pdf.* from katapdf_target,file_pdf where file_pdf.jurusan = ? and file_pdf.nama = katapdf_target.namadokumen and file_pdf.tgl_up between ? and ?',array($jurusan, $tgl_awal, $tgl_akhir))->result();
	}

	function get_target($tgl_akhir, $jurusan){
		$tahun = $tgl_akhir;
		$tgl_awal = $tahun.'-01-01 00:00:00';
		$tgl_akhir = $tahun.'-12-31 23:59:00';
		return $this->db->query('select distinct(katapdf_target.namadokumen) as nama2, file_pdf.* from katapdf_target,file_pdf where file_pdf.jurusan = ? and file_pdf.nama = katapdf_target.namadokumen and file_pdf.tgl_up between ? and ?',array($jurusan, $tgl_awal, $tgl_akhir))->result();
		#return $this->db->query('select distinct(katapdf_target.namadokumen) as nama2, file_pdf.* from katapdf_target,file_pdf where file_pdf.nama = katapdf_target.namadokumen and file_pdf.tgl_up > ?',array($tgl_akhir))->result();

	}

	function get_TiapKataSumber($pdf_sumber){
		
		
		$nama_File_Pdf_Sumber = array();
		foreach ($pdf_sumber as $key => $value) {
			# code...
			$nama_File_Pdf_Sumber[] = $value->nama;
		}

		$_BanyakDocSumber = count($nama_File_Pdf_Sumber);

		
			#$arr_KataSumber = array(array());
			for ($nomor_DokumenSumber=0; $nomor_DokumenSumber < sizeof($nama_File_Pdf_Sumber) ; $nomor_DokumenSumber++) { 
				
				$querySumber = $this->db->query('select *, kata as kata_sumber from katapdf_target where namadokumen =?',array($nama_File_Pdf_Sumber[$nomor_DokumenSumber]))->result();

				$queryDocSumber = $this->db->query('select *, kata as kata_sumber from katapdf_target where namadokumen =?',array($nama_File_Pdf_Sumber[$nomor_DokumenSumber]))->row();

					$arr_KataSumber['nama_Doc_Sumber'][$nomor_DokumenSumber] = $queryDocSumber->namadokumen;

				foreach ($querySumber as $key => $value_Sumber) {

					
					$arr_KataSumber['_Kata_Sumber'][$nomor_DokumenSumber][$key] = $value_Sumber->kata_sumber;

				}

			}

		
		

			return @$arr_KataSumber;
		
	}

	function get_TiapKataTarget($pdf_target){


		$nama_File_Pdf_Target = array();

		foreach ($pdf_target as $key => $value) {
			# code...
			$nama_File_Pdf_Target[] = $value->nama;
		}

		$_BanyakDocTarget = count($nama_File_Pdf_Target);

		

			for ($nomor_DokumenTarget=0; $nomor_DokumenTarget < sizeof($nama_File_Pdf_Target) ; $nomor_DokumenTarget++) { 
			
				$querytarget = $this->db->query('select *, kata as kata_target from katapdf_target where namadokumen =?',array($nama_File_Pdf_Target[$nomor_DokumenTarget]))->result();

				$queryDocTarget = $this->db->query('select *, kata as kata_target from katapdf_target where namadokumen =?',array($nama_File_Pdf_Target[$nomor_DokumenTarget]))->row();

					$arr_KataTarget['nama_Doc_Target'][$nomor_DokumenTarget] = $queryDocTarget->namadokumen;

				foreach ($querytarget as $key => $value_Target) {

					
					$arr_KataTarget['_Kata_Target'][$nomor_DokumenTarget][$key] = $value_Target->kata_target;

				}

			}

			

			return $arr_KataTarget;

	}

	function similarity_Kata_Target($kata_target,$kata_sumber){

			$time = microtime();
			$time = explode(' ', $time);
			$time = $time[1] + $time[0];
			$start = $time;
			//$total_time = round(($finish - $start), 4);


		#$nilaiSimilarity[] = array();
		
		@$E_Target = sizeof($kata_target['_Kata_Target']);
		@$E_Sumber = sizeof($kata_sumber['_Kata_Sumber']);



		for ($no_DocTarget=0; $no_DocTarget < $E_Target ; $no_DocTarget++) { 
			

			$nilaiSimilarity['nama_Doc_Target'][$no_DocTarget] = $kata_target['nama_Doc_Target'][$no_DocTarget]; //get nama document target


			for ($no_DocSumber =0; $no_DocSumber  < $E_Sumber ; $no_DocSumber ++) { 

				for ($pjg_kata_target = 0; $pjg_kata_target  < sizeof($kata_target['_Kata_Target'][$no_DocTarget]) ; $pjg_kata_target ++) { 
					
					for ($pjg_kata_sumber = 0; $pjg_kata_sumber  < sizeof($kata_sumber['_Kata_Sumber'][$no_DocSumber]) ; $pjg_kata_sumber ++) { 

						#echo $kata_target[$no_DocTarget][$pjg_kata_target].'|'. $kata_sumber[$no_DocSumber][$pjg_kata_sumber].'<br>';

						if($kata_target['_Kata_Target'][$no_DocTarget][$pjg_kata_target] == $kata_sumber[
							'_Kata_Sumber'][$no_DocSumber][$pjg_kata_sumber])
						{

							$nilaiSimilarity['_Kata_Target'][$no_DocTarget][$no_DocSumber][$pjg_kata_target] = 1;	
							break;		

						}else{

							$nilaiSimilarity['_Kata_Target'][$no_DocTarget][$no_DocSumber][$pjg_kata_target] = 0;

						}

						

					}

					$nilaiSimilarity['jumlah_kata'] = count($nilaiSimilarity['_Kata_Target'][$no_DocTarget][$no_DocSumber]);

				}

			}
		}
			$time = microtime();
			$time = explode(' ', $time);
			$time = $time[1] + $time[0];
			$finish = $time;
			$total_time = round(($finish - $start), 4);
			@$nilaiSimilarity['time_similarity_kata_target'] = 'Tiap kata Simialrity Kata Target finish in '.$total_time.' Second';

		return @$nilaiSimilarity;
		#$this->pre($nilaiSimilarity);

	}

	function similarity_Kata_Sumber($kata_target,$kata_sumber){

			$time = microtime();
			$time = explode(' ', $time);
			$time = $time[1] + $time[0];
			$start = $time;
			

		#$nilaiSimilarity[] = array();

		@$E_Target = sizeof($kata_target['_Kata_Target']);
		@$E_Sumber = sizeof($kata_sumber['_Kata_Sumber']);



		for ($no_DocSumber=0; $no_DocSumber < $E_Sumber ; $no_DocSumber++) { 

			$nilaiSimilarity['nama_Doc_Sumber'][$no_DocSumber] = $kata_sumber['nama_Doc_Sumber'][$no_DocSumber]; // get doc sumber

			
			for ($no_DocTarget =0; $no_DocTarget  < $E_Target ; $no_DocTarget ++) { 

				for ($pjg_kata_Sumber = 0; $pjg_kata_Sumber  < sizeof($kata_sumber['_Kata_Sumber'][$no_DocSumber]) ; $pjg_kata_Sumber ++) { 
					
					for ($pjg_kata_Target = 0; $pjg_kata_Target  < sizeof($kata_target['_Kata_Target'][$no_DocTarget]) ; $pjg_kata_Target ++) { 

						#echo $kata_target[$no_DocTarget][$pjg_kata_target].'|'. $kata_sumber[$no_DocSumber][$pjg_kata_sumber].'<br>';

						if($kata_sumber['_Kata_Sumber'][$no_DocSumber][$pjg_kata_Sumber] == $kata_target['_Kata_Target'][$no_DocTarget][$pjg_kata_Target])
						{

							$nilaiSimilarity['_Kata_Sumber'][$no_DocSumber][$no_DocTarget][$pjg_kata_Sumber] = 1;	
							break;		

						}else{

							$nilaiSimilarity['_Kata_Sumber'][$no_DocSumber][$no_DocTarget][$pjg_kata_Sumber] = 0;

						}


					}

					$nilaiSimilarity['jumlah_kata'] = count($nilaiSimilarity['_Kata_Sumber'][$no_DocSumber][$no_DocTarget]);

				}

			}
		}
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$finish = $time;
		$total_time = round(($finish - $start), 4);
		
		@$nilaiSimilarity['time_similarity_kata_sumber'] = 'Tiap kata Simialrity Kata Target finish in '.$total_time.' Second';
		return @$nilaiSimilarity;
		#$this->pre($nilaiSimilarity);

	}

	function exactmatch($similarity_Target, $similarity_Sumber, $persentage){

		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$start = $time;

		
				#$nilaiPerbandingan = array();
			$tampilan[] = '<table id="tbl1" class="table table-striped table-bordered" cellspacing="0" width="100%">';
			$tampilan[] = "<thead>
							<tr>
								<th>No</th>
								<th>Dokumen Target</th>
								<th>Hasil Perbandingan</th>
						 	 </tr>
						 	</thead>
						 	<tbody>";
					 	 $no=1;
			for ($_DocTarget =0; $_DocTarget < sizeof($similarity_Target['_Kata_Target']) ; $_DocTarget++) { // mendapatkan banyak dokumen target

				$tampilan[] = '<tr>
								<td>'.$no.'</td>
								<td>'.$similarity_Target['nama_Doc_Target'][$_DocTarget].'</td>
								<td>';

				for ($_DocSumber =0; $_DocSumber  < sizeof($similarity_Sumber['_Kata_Sumber']); $_DocSumber ++) {  // mendapatkan banyak dokumen sumber

					$panjangTarget = count($similarity_Target['_Kata_Target'][$_DocTarget]); // mendapatkan niali terpanjang dari target / sumber
					$panjangSumber = count($similarity_Sumber['_Kata_Sumber'][$_DocSumber]);

					$terpanjang = null;
					$terpendek = null;

					if($panjangTarget > $panjangSumber){

						$terpanjang = $similarity_Target['_Kata_Target'][$_DocTarget][$_DocSumber];
						$terpendek = $similarity_Sumber['_Kata_Sumber'][$_DocSumber][$_DocTarget];

					}else{

						$terpanjang = $similarity_Sumber['_Kata_Sumber'][$_DocSumber][$_DocTarget];
						$terpendek = $similarity_Target['_Kata_Target'][$_DocTarget][$_DocSumber];

					}

					//masuk proses ini

					$nilaiPerbandingan = array();
					$jumlahAngka1 =0;

					foreach ($terpanjang as $key_terpanjang => $valuePanjang) {
						
						$nPendek = $key_terpanjang <= (count($terpendek) - 1) ? $terpendek[$key_terpanjang] : -1;

						#echo "$valuePanjang | $nPendek and $valuePanjang != 0 and $nPendek != 0<br>";

						if($valuePanjang == $nPendek and $valuePanjang != 0 and $nPendek != 0){

							

							$nilaiPerbandingan[] = 1;

							$jumlahAngka1 += 1;

							#echo $jumlahAngka1.'<br>';

						}else{

							$nilaiPerbandingan[] = 0;

						}

					}

					$persen[$_DocTarget][$_DocSumber] = ($jumlahAngka1/count($terpanjang)) * 100;

					
						//mengatur hasil outputan jika lebih dari persen 
						if($persen[$_DocTarget][$_DocSumber] >= $persentage){

							$tampilan[] = 'vs '.$similarity_Sumber['nama_Doc_Sumber'][$_DocSumber].' => '.number_format($persen[$_DocTarget][$_DocSumber],2).'%<br>';	
						}else{

							#$tampilan[] = 
						}
					
			

				}

				$no++;

				$tampilan[] = '</td>
								</tr>';
			}
			$tampilan[] = "</tbody></table>";

			$time = microtime();
			$time = explode(' ', $time);
			$time = $time[1] + $time[0];
			$finish = $time;
			$total_time = round(($finish - $start), 4);

			$tampilan[] = 'Proses Similarity Target selesai dalam : '.$similarity_Target['time_similarity_kata_target'].' Detik<br>';
			$tampilan[] = 'Jumlah Kata similarity Target :'.$similarity_Target['jumlah_kata'].' Kata<br><br>';
			$tampilan[] = 'Proses Similarity Sumber seleai dalam : '.$similarity_Sumber['time_similarity_kata_sumber'].' Detik<br>';
			$tampilan[] = 'Jumlah Kata similarity Sumber :'.$similarity_Sumber['jumlah_kata'].' Kata<br><br>';
			$tampilan[] = 'Proses Exatmatch selesai dalam : '.$total_time.' Detik';
			

			
			
			return $tampilan;

	}

	


	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

}

/* End of file Metode_bab.php */
/* Location: ./application/models/Metode_bab.php */