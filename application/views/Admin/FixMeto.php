<div id="page-wrapper">
	<div class="container-fluid">
<?php

function echopre($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

function ceksimilarity($arr_katatarget,$arr_katasumber){
	#$arr_hasil = array();
	foreach ($arr_katatarget as $nomor_kata_target => $kata_target) {
		# code...
		foreach ($arr_katasumber as $kata_sumber) {
			# code...
			if($kata_target == $kata_sumber){
				$arr_hasil[$nomor_kata_target] = 1;
				break;
			}else{
				$arr_hasil[$nomor_kata_target] = 0;
			}
		}
	}
	return $arr_hasil;
	#echopre($arr_hasil);

}

function looping($target,$sumber){
	$no_target = 0;
	
	while($no_target<count($target)){
		$no_sumber=0;
		while ($no_sumber<count($sumber)) {
			
			if($target[$no_target] == $sumber[$no_sumber]){
				$arr_hasil[$no_target][$no_sumber] = "$target[$no_target]|$sumber[$no_sumber]. Ini Kata Sama";
				break;
			}else{
				# code...
				$arr_hasil[$no_target][$no_sumber] = "$target[$no_target]|$sumber[$no_sumber] Tidak Sama";
			}

			$no_sumber++;
		}
		$no_target++;
	}

	return $arr_hasil;
}

function lopsimilitarget($target,$sumber,$arr_katatarget,$arr_katasumber){
	/*echo 'Jumlah target '.count($target).'<Br>';
	echo 'Jumlah Sumber '.count($sumber).'<br>';
	echo 'Jumlah Kata Target '.count($arr_katasumber[2]).'<br>';
	echopre($arr_katatarget[0][11]);*/
	$no_target=0;
	#$arr_hasil = array();
	while ( $no_target<count($target)) {
		$no_sumber =0;
		while($no_sumber<count($sumber)){
			$no_arr_target=0;
			while($no_arr_target<count($arr_katatarget[$no_target])){
				$no_arr_sumber=0;
				while ($no_arr_sumber<count($arr_katasumber[$no_sumber])) {
					# code...
					/*@$arr_hasil[$no_target][$no_sumber][$no_arr_target] = $arr_katatarget[$no_target][$no_arr_target].'|'.$arr_katasumber[$no_sumber][$no_arr_target].'| Nama PDF |'.$target[$no_target].'|'.$sumber[$no_sumber];*/
					if(@$arr_katatarget[$no_target][$no_arr_target] == @$arr_katasumber[$no_sumber][$no_arr_sumber]){
						/*@$arr_hasil[$no_target][$no_sumber][$no_arr_target] = '1 |'.$arr_katatarget[$no_target][$no_arr_target].'|'.$arr_katasumber[$no_sumber][$no_arr_target].'| Nama PDF'. $target[$no_target].'|'.$sumber[$no_sumber];*/
						@$arr_hasil[$no_target][$no_sumber][$no_arr_target] = 1;
						;#'1 | Jumlah kata '.count($arr_katatarget[$no_target]).'|'.count($arr_katasumber[$no_sumber]);
						#$arr_hasil[$no_arr_target] = '1';
						break;
					}else{
						/*@$arr_hasil[$no_target][$no_sumber][$no_arr_target] = '0 |'.$arr_katatarget[$no_target][$no_arr_target].'|'.$arr_katasumber[$no_sumber][$no_arr_target].'| Nama PDF'. $target[$no_target].'|'.$sumber[$no_sumber];*/
						@$arr_hasil[$no_target][$no_sumber][$no_arr_target] = 0;
						#'0 | Jumlah kata '.count($arr_katatarget[$no_target]).'|'.count($arr_katasumber[$no_sumber]);
						#$arr_hasil[$no_arr_target] = '0';
					}
					$no_arr_sumber++;
				}
				$no_arr_target++;
			}
			$no_sumber++;
		}
		$no_target++;
	}
	return $arr_hasil;
}

#function salah

function lopsimilisumber2($target,$sumber,$arr_katatarget,$arr_katasumber){
	$no_sumber=0;
	while ($no_sumber<count($sumber)) {
		# code...
		$no_target=0;
		while ($no_target<count($target)) {
			# code...
			$no_arr_sumber=0;
			while ($no_arr_sumber<count($arr_katasumber[$no_sumber])) {
				# code...
				$no_arr_target=0;
				while ($no_arr_target<count($arr_katatarget[$no_target])) {
					# code...
					if(@$arr_katasumber[$no_sumber][$no_arr_sumber] == @$arr_katatarget[$no_target][$no_arr_target] ){
						/*@$arr_hasil[$no_target][$no_sumber][$no_arr_target] = '1 |'.$arr_katasumber[$no_sumber][$no_arr_target].'|'.$arr_katatarget[$no_target][$no_arr_target].' => Nama PDF'. $sumber[$no_sumber].'|'.$target[$no_target];*/
						@$arr_hasil[$no_sumber][$no_target][$no_arr_sumber] = 1;
						#'1 | Jumlah kata '.count($arr_katasumber[$no_sumber]).'|'.count($arr_katatarget[$no_target]);
						#$arr_hasil[$no_arr_target] = '1';
						break;
					}else{
						/*@$arr_hasil[$no_target][$no_sumber][$no_arr_target] = '0 |'.$arr_katasumber[$no_sumber][$no_arr_target].'|'.arr_katatarget[$no_target][$no_arr_target].' => Nama PDF'. $sumber[$no_sumber].'|'.$target[$no_target];
						#$arr_hasil[$no_arr_target] = '0';*/
						@$arr_hasil[$no_sumber][$no_target][$no_arr_sumber] = 0;
						#'0 | Jumlah kata '.count($arr_katasumber[$no_sumber]).'|'.count($arr_katatarget[$no_target]);
						#$arr_hasil[$no_arr_target] = '0';
					}
					$no_arr_target++;
				}
				$no_arr_sumber++;
			}
			$no_target++;
		}
		$no_sumber++;
	}
	return $arr_hasil;
}

function perhitunganexactmatch($target,$sumber,$result_target,$result_sumber){
	#echopre($result_sumber);
	#echopre($result_target);
	#echopre($target);
	#echopre($sumber);
	$no_target = 0;
	while ($no_target<count($target)) {
		# code...
		$no_sumber =0;
		while ($no_sumber<count($sumber)) {
			# code...
			$no_result_target=0;
			while ($no_result_target<count($result_target[$no_target])) {
				# code...
				$no_result_sumber=0;
				while ($no_result_sumber<count($result_sumber[$no_sumber])) {
					# code...

					#echo @$result_sumber[$no_target][$no_sumber][$no_result_sumber].'<br>';
					if(@$result_target[$no_target][$no_sumber][$no_result_target] == 1 and $result_sumber[$no_sumber][$no_target][$no_result_sumber] == 1){
						if(count($result_target[$no_target])>count($result_sumber[$no_sumber])){
							$arr_hasil[$no_target][$no_sumber][$no_result_target] = 1;
						@$kemiripan_persen['hasil'][$no_target][$no_sumber] += (1/count($result_target[$no_target]))*100;
						@$kemiripan_persen['test'][$no_target][$no_sumber] += '1/ '.count($result_target[$no_target].'*100');#(1/count($result_target[$no_target]))*100;	
						#echo "(1/count($result_target[$no_target]))*100";
						}else{
						@$kemiripan_persen['hasil'][$no_target][$no_sumber] += (1/count($result_sumber[$no_sumber]))*100;
						@$kemiripan_persen['test'][$no_target][$no_sumber] += '1/'.count($result_sumber[$no_sumber].'*100');
						}
#						@$kemiripan_persen['nama_dokumen'][$no_target][$no_sumber] = (1/count($result_sumber[$no_sumber]))*100;
						
						break;
					}else{
						/*$arr_hasil[$no_target][$no_sumber][$no_result_target] = 0;
						@$kemiripan_persen['hasil'][$no_target][$no_sumber] += (0/count($result_target[$no_target]))*100;*/
						if(count($result_target[$no_target])>count($result_sumber[$no_sumber])){
							$arr_hasil[$no_target][$no_sumber][$no_result_target] = 1;
						@$kemiripan_persen['hasil'][$no_target][$no_sumber] += (0/count($result_target[$no_target]))*100;	
						@$kemiripan_persen['test'][$no_target][$no_sumber] += '0/ '.count($result_target[$no_target].'*100');
						}else{
						@$kemiripan_persen['hasil'][$no_target][$no_sumber] += (0/count($result_sumber[$no_sumber]))*100;
						@$kemiripan_persen['test'][$no_target][$no_sumber] += '0/ '.count($result_sumber[$no_sumber].'*100');
						}
						
					}
					#$kemiripan[$no_target][$no_sumber][$no_result_target] = $arr_hasil[$no_target][$no_sumber][$no_result_target];
					$no_result_sumber++;
				}
				$no_result_target++;
			}

			$no_sumber++;
		}
		$no_target++;
	}
	#return $arr_hasil;
	echopre($kemiripan_persen);
	#echoppre($arr_hasil);
}




#buat array sumber dan target
foreach ($pdftarget as $key => $value) {
	# code...
	$target[] = $value->nama;
}
#var_dump(count($target));
foreach ($pdfsumber as $key => $value) {
	# code...
	$sumber[] = $value->nama;
}

#proses perhitungan

#buat array 2 dimensi 1 dokumen banyak kata
$no_dokumen_target =0;
while($no_dokumen_target<count($target))
{
	$querytarget = $this->db->query('select *, kata as kata_target from katapdf_target where namadokumen =?',array($target[$no_dokumen_target]))->result();
	foreach ($querytarget as $id_dokumen_target => $value) {
	# code...
		$arr_target[$no_dokumen_target][$id_dokumen_target]= $value->kata_target;
	}	
	$no_dokumen_target++;
}

$no_dokumen_sumber =0;
while($no_dokumen_sumber<count($sumber)){
	$querysumber = $this->db->query('select *, kata2 as kata_sumber from katapdf_sumber where namadokumen2 = ?',array($sumber[$no_dokumen_sumber]))->result();
	foreach ($querysumber as $id_dokumen_sumber => $value) {
		$arr_sumber[$no_dokumen_sumber][$id_dokumen_sumber] = $value->kata_sumber;
	}
	$no_dokumen_sumber++;
}



#array 1 dimensi, looping sebanyak jumlah kata.
/*$querytarget= $this->db->query('select kata as kata_target from katapdf_target')->result();
$arr_target = array();

foreach ($querytarget as $key => $value) {
	# code...
	$arr_target[] = $value->kata_target;
}r

$querysumber = $this->db->query('SELECT kata2 as kata_sumber FROM `katapdf_sumber`')->result();
foreach ($querysumber as $key => $value) {
	$arr_sumber[] = $value->kata_sumber;
}*/

#try array 2dimensi
/*$querytarget= $this->db->query('select *,kata as kata_target from katapdf_target')->result();
$arr_target = array();
$no_querytarget =0;
foreach ($querytarget as $key => $value) {
	# code...
	
	$arr_target[$no_querytarget] = $value->kata_target;
	$no_querytarget++;
}
$no_querysumber=0;
$querysumber = $this->db->query('SELECT kata2 as kata_sumber FROM `katapdf_sumber`')->result();
foreach ($querysumber as $key => $value) {
	$arr_sumber[] = $value->kata_sumber;
}*/



$hasil_target = lopsimilitarget($target,$sumber,$arr_target,$arr_sumber);

$hasil_sumber = lopsimilisumber2($target,$sumber,$arr_target,$arr_sumber);
#$hasil = lopsimilisumber($target,$sumber,$arr_target,$arr_sumber);
/*echopre($arr_target);
echopre($arr_sumber);*/
#echopre($hasil);
$notarget = 0;
while ($notarget<count($target)) {
	$nosumber =0;
	while($nosumber<count($sumber)){
		$no=0;
		while($no<count($hasil_target[$notarget][$nosumber])){
			$res_target[$notarget][$nosumber][$no] =  $hasil_target[$notarget][$nosumber][$no];#$hasil_target[$notarget][$nosumber][$no].'|';
			echo $res_target[$notarget][$nosumber][$no];
			$no++;
		}
		$nosumber++;
		echo '<Br>';
	}
	$notarget++;
	#echo '<br>';
}
echo '<Br>';
$notarget = 0;
while ($notarget<count($target)) {
	$nosumber =0;
	while($nosumber<count($sumber)){
		$no=0;
		while($no<count($hasil_sumber[$nosumber][$notarget])){
			$res_sumber[$nosumber][$notarget][$no] =  $hasil_sumber[$nosumber][$notarget][$no];#$hasil_sumber[$nosumber][$notarget][$no].'|';
			echo $res_sumber[$nosumber][$notarget][$no];
			$no++;
		}
		$nosumber++;
		echo '<Br>';
	}
	$notarget++;
	#echo '<br>';
}

$hasil_akhir = perhitunganexactmatch($target,$sumber,$res_target,$res_sumber);
echopre($hasil_akhir);







?>
	</div>
</div>