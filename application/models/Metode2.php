<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metode2 extends CI_Model {

	function get_TiapKataSumber($pdf_sumber){
		foreach ($pdf_sumber as $key => $value) {
			# code...
			$nama_File_Pdf_Sumber[] = $value->nama;
		}

		#$arr_KataSumber = array(array());
		for ($nomor_DokumenSumber=0; $nomor_DokumenSumber < sizeof($nama_File_Pdf_Sumber) ; $nomor_DokumenSumber++) { 
			
			$querytarget = $this->db->query('select *, kata2 as kata_sumber from katapdf_sumber where namadokumen2 =?',array($nama_File_Pdf_Sumber[$nomor_DokumenSumber]))->result();

			foreach ($querytarget as $key => $value_Sumber) {

				#$arr_Kata['nama_Doc_Sumber'][$nomor_Kata_Sumber][$key] = $value_Sumber->namadokumen2;
				$arr_KataSumber[$nomor_DokumenSumber][$key] = $value_Sumber->kata_sumber;

			}

		}

		return $arr_KataSumber;
		#$this->pre($arr_KataSumber);
	}

	function get_TiapKataTarget($pdf_target){
		foreach ($pdf_target as $key => $value) {
			# code...
			$nama_File_Pdf_Target[] = $value->nama;
		}

		#$arr_KataSumber = array(array());
		for ($nomor_DokumenTarget=0; $nomor_DokumenTarget < sizeof($nama_File_Pdf_Target) ; $nomor_DokumenTarget++) { 
			
			$querytarget = $this->db->query('select *, kata as kata_target from katapdf_target where namadokumen =?',array($nama_File_Pdf_Target[$nomor_DokumenTarget]))->result();

			foreach ($querytarget as $key => $value_Target) {

				#$arr_Kata['nama_Doc_Sumber'][$nomor_Kata_Sumber][$key] = $value_Sumber->namadokumen2;
				$arr_KataTarget[$nomor_DokumenTarget][$key] = $value_Target->kata_target;

			}

		}

		return $arr_KataTarget;
		#$this->pre($arr_KataTarget);
	}

	function similarity_Kata_Target($kata_target,$kata_sumber){

		$nilaiSimilarity[] = array();

		$E_Target = sizeof($kata_target);
		$E_Sumber = sizeof($kata_sumber);



		for ($no_DocTarget=0; $no_DocTarget < $E_Target ; $no_DocTarget++) { 
			
			for ($no_DocSumber =0; $no_DocSumber  < $E_Sumber ; $no_DocSumber ++) { 

				for ($pjg_kata_target = 0; $pjg_kata_target  < sizeof($kata_target[$no_DocTarget]) ; $pjg_kata_target ++) { 
					
					for ($pjg_kata_sumber = 0; $pjg_kata_sumber  < sizeof($kata_sumber[$no_DocSumber]) ; $pjg_kata_sumber ++) { 

						#echo $kata_target[$no_DocTarget][$pjg_kata_target].'|'. $kata_sumber[$no_DocSumber][$pjg_kata_sumber].'<br>';

						if($kata_target[$no_DocTarget][$pjg_kata_target] == $kata_sumber[$no_DocSumber][$pjg_kata_sumber])
						{

							$nilaiSimilarity[$no_DocTarget][$no_DocSumber][$pjg_kata_target] = 1;	
							break;		

						}else{

							$nilaiSimilarity[$no_DocTarget][$no_DocSumber][$pjg_kata_target] = 0;

						}

					}

				}

			}
		}

		return $nilaiSimilarity;
		#$this->pre($nilaiSimilarity);

	}

	function similarity_Kata_Sumber($kata_target,$kata_sumber){

		$nilaiSimilarity[] = array();

		$E_Target = sizeof($kata_target);
		$E_Sumber = sizeof($kata_sumber);



		for ($no_DocSumber=0; $no_DocSumber < $E_Sumber ; $no_DocSumber++) { 
			
			for ($no_DocTarget =0; $no_DocTarget  < $E_Target ; $no_DocTarget ++) { 

				for ($pjg_kata_Sumber = 0; $pjg_kata_Sumber  < sizeof($kata_sumber[$no_DocSumber]) ; $pjg_kata_Sumber ++) { 
					
					for ($pjg_kata_Target = 0; $pjg_kata_Target  < sizeof($kata_target[$no_DocTarget]) ; $pjg_kata_Target ++) { 

						#echo $kata_target[$no_DocTarget][$pjg_kata_target].'|'. $kata_sumber[$no_DocSumber][$pjg_kata_sumber].'<br>';

						if($kata_sumber[$no_DocSumber][$pjg_kata_Sumber] == $kata_target[$no_DocTarget][$pjg_kata_Target])
						{

							$nilaiSimilarity[$no_DocSumber][$no_DocTarget][$pjg_kata_Sumber] = 1;	
							break;		

						}else{

							$nilaiSimilarity[$no_DocSumber][$no_DocTarget][$pjg_kata_Sumber] = 0;

						}

					}

				}

			}
		}

		return $nilaiSimilarity;
		#$this->pre($nilaiSimilarity);

	}

	function exactmatch($similarity_Target, $similarity_Sumber){

		#$nilaiPerbandingan = array();
		$tampilan[] = "<table class='table table-responsive'>";
		$tampilan[] = "<tr>
						<th>No</th>
						<th>Dokumen Target</th>
						<th>Hasil Perbandingan</th>
				 	 </tr>";
				 	 $no=1;
		for ($_DocTarget =0; $_DocTarget < sizeof($similarity_Target) ; $_DocTarget++) { // mendapatkan banyak dokumen target

			$tampilan[] = "<tr>
							<td>$no</td>
							<td>Nama Dokumen[$_DocTarget]</td>
							<td>";

			for ($_DocSumber =0; $_DocSumber  < sizeof($similarity_Sumber); $_DocSumber ++) {  // mendapatkan banyak dokumen sumber

				$panjangTarget = count($similarity_Target[$_DocTarget]); // mendapatkan niali terpanjang dari target / sumber
				$panjangSumber = count($similarity_Sumber[$_DocSumber]);

				$terpanjang = null;
				$terpendek = null;

				if($panjangTarget > $panjangSumber){

					$terpanjang = $similarity_Target[$_DocTarget][$_DocSumber];
					$terpendek = $similarity_Sumber[$_DocSumber][$_DocTarget];

				}else{

					$terpanjang = $similarity_Sumber[$_DocSumber][$_DocTarget];
					$terpendek = $similarity_Target[$_DocTarget][$_DocSumber];

				}

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
				
				//mengatur hasil outputan jika lebih dari 20%
				if($persen[$_DocTarget][$_DocSumber] >= 20){

					$tampilan[] = 'vs Dokumen Sumber'.$_DocSumber.' =>'.number_format($persen[$_DocTarget][$_DocSumber],2).'%<br>';	
				}

				
				

			}

			$no++;

			$tampilan[] = '</td>
							</tr>';
		}
		$tampilan[] = "</table>";
		

		
		#$this->pre($persen);
		#return $persen;
		return $tampilan;
		#$this->pre($similarity_Sumber[0][0]);
	}

	function allExatch($target, $sumber){

		/*$exatmatch = array();

		foreach ($target as $key_target) {
			
			foreach ($sumber as $key_sumber) {
				
				$persenSimilarity = $this->exactmatch($key_target,$key_sumber);

				$exatmatch[][] = $persenSimilarity;

			}

		}

		return $exatmatch;*/
		/*for ($E_Target=0; $E_Target < sizeof($target) ; $E_Target++) { 
			
			#$hasil[] = $target[$E_Target];
			for ($E_Sumber=0; $E_Sumber < sizeof($sumber) ; $E_Sumber++) { 
				
				$hasil[$E_Target][$E_Sumber] = $this->exactmatch($target,$sumber);
			
			}

		}
		$this->pre($hasil);
		$this->pre(sizeof($target));
		$this->pre(sizeof($sumber));*/

	}


	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

}

/* End of file Metode2.php */
/* Location: ./application/models/Metode2.php */