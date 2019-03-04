<div id="page-wrapper">
	<div class="container-fluid">
<?php
/*echo $pdftarget;
echo $pdfsumber;*/
echo 'Target<br>';
foreach ($pdftarget as $key => $value) {
	$querytarget = $this->db->query('select * from katapdf_target where namadokumen = ?',array($value->nama))->result();
	$no =1;
	foreach ($querytarget as $key => $value) {
		# code...
		echo $value->kata.'|';
		$no++;
	}
echo '<br>';
}
echo '<Br>';
echo 'Sumber<br>';
foreach ($pdfsumber as $key => $value) {
	$querysumber = $this->db->query('select * from katapdf_sumber where namadokumen2 = ?',array($value->nama))->result();
	$no=1;
	foreach ($querysumber as $key => $value) {
		# code...
		echo $value->kata2.'|';
		$no++;
	}
echo '<br>';
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
#var_dump(count($sumber));
echo '<br>';
#$m = array();
$tr = 0;
while($tr < count($target)){
	$sm = 0;
	$querytarget = $this->db->query('select * from katapdf_target where namadokumen = ?',array($target[$tr]))->result();
	while($sm < count($sumber)){
		$querysumber = $this->db->query('select * from katapdf_sumber where namadokumen2 = ?',array($sumber[$sm]))->result();
		#looping checking flag and similarity
		#target
		foreach ($querytarget as $key => $valuet) {
			
			# code...
			#sumber
			$no=0;
			foreach ($querysumber as $key => $values) {
				echo $valuet->kata.'|'.$values->kata2;
				# code...
				if($valuet->kata == $values->kata2){
					
					$m[$tr][$sm][$no] = '1';
					echo "[$tr][$sm][$no]SAMA -->" . $valuet->kata.'|'.$values->kata2.' '.$m[$tr][$sm][$no].'<br>';
					$no++;
					break;
					continue;
				}else{
					$m[$tr][$sm][$no] = '0';
				}
				echo '<br>';
				$no++;
			}
			

			
		}
		#echo '<br>';
		$sm++;
	}
	$tr++;
}
print_r(($m[0][0]));
#ini hasil dari pencarian kata sama
echo '<Br>';
$i=0;
/*while($i<count($m)){
	$j=0;
	while($j<count($m[$i])){
		echo $m[$i][$j].'|';
		$j++;
	}
	$i++;
	echo '<Br>';
}*/
?>
	</div>
</div>
<!-- <div id="page-wrapper">
	<div class="container-fluid">
		<div class="row bg-title">
			<h4 class="page-title"><?php echo $board;?></h4>
		</div>
		<div class="row">
			<table class="table table-responsive table-striped table-bordered col-md-12 col-xs-12 col-xl-12">
				<tr>
					<th>No</th>
					<th>Nama Dokumen</th>
					<th>Prosentase Kemiripan</th>
				</tr>
				
			</table>
		</div>
	</div>
</div> -->