<?php
foreach ($pdftarget as $key => $value) {

	$target[] = $value->nama; //making array for check
}
#var_dump($target);
foreach ($pdfsumber as $key => $value) {
	# code...
	$sumber[] = $value->nama; //making array for check
}
#echo '<br>';
#var_dump($sumber);
#checking similarity
$i=0;
$noi=1;
while ($i<count($target)) {
	# code...
	#echo @$target[$i].'<br>';
	#connector parsing
	$parser = new \Smalot\PdfParser\Parser(); //loading parser library

        $pdftarget    = $parser->parseFile('assets/file/'.$target[$i]); //making variable for saving a parsing data from pdf to text.
        $txt_target = $pdftarget->getText(); //making variable for parsing data to text web.
	$j=0;
	$noj =1;
	echo 'Data Target-'.$noi.'<br>Nama File : '.$target[$i].'<br>';
	echo 'Perbandingan dengan file sumber :<br>';
	while($j<count($sumber)){
		$pdfsumber    = $parser->parseFile('assets/file/'.$sumber[$j]);//making variable for saving a parsing data from pdf to text.
        $txt_sumber = $pdfsumber->getText();//making variable for parsing data to text web.
        $cek = similar_text($txt_target, $txt_sumber, $persen);//cek a similarity
		#echo 'Ini sumber'.@$sumber[$j].'<br>';
        echo 'Sumber-'.$noj.' '.$sumber[$j].'Kemiripan Prosesntase '.number_format($persen,2).'% <br>';
		
		$j++;
		$noj++;
	}
	echo '<br>';
	$i++;
	$noi++;
}
?>
<!-- phalcon
phpstom -->