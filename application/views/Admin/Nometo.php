<?php
/*$not = 1;
foreach ($pdftarget as $key => $valuetarget) {
    $nos =1;
    foreach ($pdfsumber as $key => $valuesumber) {
        $parser = new \Smalot\PdfParser\Parser();

        $pdftarget    = $parser->parseFile('assets/file/'.$valuetarget->nama);
        $txt_target = $pdftarget->getText();

        $pdfsumber    = $parser->parseFile('assets/file/'.$valuesumber->nama);
        $txt_sumber = $pdfsumber->getText();

        $cek = similar_text(@$txt_target, @$txt_sumber, $persen);
        echo 'Perbandingan Dokumen'.$valuetarget->nama.' Dengan '.$valuesumber->nama.' Total Kemiripan '. number_format($persen,2).'%<br>';
        
        $nos++;
    }
    $not++;
}*/
/*$cek = similar_text($txt_target, $txt_sumber, $persen);
echo 'Perbandingan Dokumen'.$valuetarget->nama.' Dengan '.$valuesumber->nama.' Total Kemiripan '. number_format($persen).'%<br>';
echo 'Target<br>';
echo $txt_target;
echo '<br><br><Br>Sumber<br><br>';
echo $txt_sumber;*/

#versi2
$not = 1;
foreach ($pdftarget as $key => $valuetarget) {
    $nos =1;
    echo 'Data Target-'.$not.' '.$valuetarget->nama.'<br>';
    $parser = new \Smalot\PdfParser\Parser();

        $pdftarget    = $parser->parseFile('assets/file/'.$valuetarget->nama);
        $txt_target = $pdftarget->getText();

    foreach ($pdfsumber as $key => $valuesumber) {
        #echo 'Data Sumber-'.$nos.' '.$valuesumber->    nama.'<br>';

        $pdfsumber    = $parser->parseFile('assets/file/'.$valuesumber->nama);
        $txt_sumber = $pdfsumber->getText();

        $cek = similar_text(@$txt_target, @$txt_sumber, $persen);
        echo 'Perbandingan Target-'.$not .' '.$valuetarget->nama.' Dengan Sumber'.$nos.' '.$valuesumber->nama.' Total Kemiripan '. number_format($persen,2).'%<br>';

        $nos++;
    }
    $not++;
}

?>