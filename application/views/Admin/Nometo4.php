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
	$arr_hasil = array();
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

$sql1 = 'SELECT kata as kata_target FROM `katapdf_target` where namadokumen ="1522885690Abstrak-4.pdf"';
$querytarget= $this->db->query($sql1)->result();
$arr_target = array();
foreach ($querytarget as $key => $value) {
	# code...
	$arr_target[] = $value->kata_target;
}
$querysumber = $this->db->query('SELECT kata2 as kata_sumber FROM `katapdf_sumber` where namadokumen2 ="1522885105Abstrak-1.pdf"')->result();
foreach ($querysumber as $key => $value) {
	$arr_sumber[] = $value->kata_sumber;
}
$hasil = ceksimilarity($arr_target,$arr_sumber);
echopre($hasil);



?>
	</div>
</div>