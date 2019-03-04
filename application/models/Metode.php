<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metode extends CI_Model {

	function get_tiap_kata($pdf_target,$pdf_sumber){

		//mendapatkan nama dari pdf
		foreach ($pdf_target as $key => $value) {
			# code...
			$nama_File_Pdf_Target[] = $value->nama;
		}

		foreach ($pdf_sumber as $key => $value) {
			# code...
			$nama_File_Pdf_Sumber[] = $value->nama;
		}

		//mendapatkan tiap kata dari tiap dokumen pdf
		for ($nomor_DokumenTarget=0; $nomor_DokumenTarget < sizeof($nama_File_Pdf_Target) ; $nomor_DokumenTarget++) { 
			# code...
			$querytarget = $this->db->query('select *, kata as kata_target from katapdf_target where namadokumen =?',array($nama_File_Pdf_Target[$nomor_DokumenTarget]))->result();

			foreach ($querytarget as $key => $value_Target) {
				# code...
				#$arr_Kata['nama_Doc_Target'][$nomor_Kata_Target][$key] = $value_Target->namadokumen;
				$arr_Kata['kata_Target'][$nomor_DokumenTarget][$key] = $value_Target->kata_target;
			}
		}

		for ($nomor_DokumenSumber=0; $nomor_DokumenSumber < sizeof($nama_File_Pdf_Sumber) ; $nomor_DokumenSumber++) { 
			# code...
			$querytarget = $this->db->query('select *, kata2 as kata_sumber from katapdf_sumber where namadokumen2 =?',array($nama_File_Pdf_Sumber[$nomor_DokumenSumber]))->result();
			foreach ($querytarget as $key => $value_Sumber) {
				# code...
				#$arr_Kata['nama_Doc_Sumber'][$nomor_Kata_Sumber][$key] = $value_Sumber->namadokumen2;
				$arr_Kata['kata_Sumber'][$nomor_DokumenSumber][$key] = $value_Sumber->kata_sumber;
			}
		}


		return $arr_Kata;
		#$this->pre($arr_Kata);

	}

	function similarity_kata($get_kata){
		$nilaiSimilarity['Target'][][] = array();
		$nilaiSimilarity['Sumber'][][] = array();
		//Perbandingan dokumen target dengan sumber menunjukkan proses similarity
		for ($no_DokumenTarget=0; $no_DokumenTarget < sizeof($get_kata['kata_Target']) ; $no_DokumenTarget++) { 
			# code...
			for ($no_DokumenSumber=0; $no_DokumenSumber < sizeof($get_kata['kata_Sumber']) ; $no_DokumenSumber++) { 
				# code...
				for ($no_kataTarget=0; $no_kataTarget < sizeof($get_kata['kata_Target'][$no_DokumenTarget]) ; $no_kataTarget++) { 
					# code...
					for ($no_kataSumber=0; $no_kataSumber < sizeof($get_kata['kata_Sumber'][$no_DokumenSumber]) ; $no_kataSumber++) { 
						# code...

						if($get_kata['kata_Target'][$no_DokumenTarget][$no_kataTarget] == $get_kata['kata_Sumber'][$no_DokumenSumber][$no_kataSumber]){
							
							$nilaiSimilarity['Target'][$no_DokumenTarget][$no_kataTarget] = 1;
							break;

						}else{
							
							$nilaiSimilarity['Target'][$no_DokumenTarget][$no_kataTarget] = 0;

						}

					}
				}

			}
		}


		//Perbandingan dokumen Sumber dengan Target menunjukkan proses similarity
		for ($no_DokumenSumber=0; $no_DokumenSumber < sizeof($get_kata['kata_Sumber']) ; $no_DokumenSumber++) { 
			# code...
			for ($no_DokumenTarget=0; $no_DokumenTarget < sizeof($get_kata['kata_Target']) ; $no_DokumenTarget++) { 
				# code...
				for ($no_kataSumber=0; $no_kataSumber < sizeof($get_kata['kata_Sumber'][$no_DokumenSumber]) ; $no_kataSumber++) { 
					# code...
					for ($no_kataTarget=0; $no_kataTarget < sizeof($get_kata['kata_Target'][$no_DokumenTarget]) ; $no_kataTarget++) { 
						# code...

						if($get_kata['kata_Sumber'][$no_DokumenSumber][$no_kataSumber] == $get_kata['kata_Target'][$no_DokumenTarget][$no_kataTarget]){
							
							$nilaiSimilarity['Sumber'][$no_DokumenSumber][$no_kataSumber] = 1;
							break;

						}else{
							
							$nilaiSimilarity['Sumber'][$no_DokumenSumber][$no_kataSumber] = 0;

						}

					}
				}

			}
		}

		return $nilaiSimilarity;
		#$this->pre($nilaiSimilarity);
	}

	function exactmatch($similarity){

		$nilaiPerbandingan = array();

		$panjangTarget = count($similarity['Target']);
		$panjangSumber = count($similarity['Sumber']);

		$terpanjang = null;
		$terpendek = null;

		if($panjangTarget > $panjangSumber){

			$terpanjang = $similarity['Target'];
			$terpendek = $similarity['Sumber'];

		}else{

			$terpanjang = $similarity['Sumber'];
			$terpendek = $similarity['Target'];

		}

		$jumlahAngka1 = 0;

		foreach ($terpanjang as $indeks => $nPanjang) {
			
			$nPendek[$indeks] = $indeks <= (count($terpendek) - 1) ? $terpendek[$indeks] : -1;

			if($nPanjang[$indeks] == $nPendek[$indeks] and $nPanjang[$indeks] != 0 and $nPendek[$indeks] != 0){

				$nilaiPerbandingan[$indeks][] = 1;

				$jumlahAngka1[$indeks] += 1;

			}else{

				$nilaiPerbandingan[$indeks][] = 0;

			}

		}

		$persenSimilarity = ($jumlahAngka1[$indeks] / count($terpanjang[$indeks])) * 100;
		
		#$this->pre($persenSimilarity);

	}

	

	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
	

}

/* End of file Metode.php */
/* Location: ./application/models/Metode.php */