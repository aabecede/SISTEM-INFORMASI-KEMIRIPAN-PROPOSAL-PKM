  <?php
     
    // Include Composer autoloader if not already done.
    #include 'vendor/autoload.php';
     
    // Parse pdf file and build necessary objects.
    $parser = new \Smalot\PdfParser\Parser();
    $pdf    = $parser->parseFile('assets/file/ee.pdf');
     
    // Retrieve all pages from the pdf file.
    $pages  = $pdf->getPages();
    $details = $pdf->getDetails();
    $text = strtolower($pdf->getText());

    
     
    // Loop over each page to extract text.
    $no = 1;
    foreach ($details as $property => $value) {
    if (is_array($value)) {
        $value = implode(', ', $value);
    }
    echo $property . ' => ' . $value . "<br>";
    }

    foreach ($pages as $page) {

       echo '<br>Page'.$no.'<br>'.$page->getText().'<br>';
        #$no++;

    }
    #var_dump($pdf->getText());
    $explode = explode('.',$text);//hilangkan titik

    $implode = implode('',$explode);

    $explode2 = explode(',',$implode);//hilangkan koma

    $implode2 = implode('',$explode2);

    $explode3 = explode(' ',$implode2);//hilangkan spasi

    $implode3 = implode('',$explode3);

    #var_dump($explode3);
    
    $stopword = $this->db->get('stopword')->result();
    foreach ($stopword as $key => $value) {
        $stop[] = $value->huruf;
    }
    

    foreach ($explode3 as $key => $value) {
        $ex[] = $value;
    }

    //switch case
   


    #var_dump($ex);
    //ngulang kata stopword
    /*$j =0;
    while($j<=count($ex)){
        echo @$ex[$j].'<br>';
        $j++;
    }*/
    
    
   /* foreach ($hasil2 as $key => $value) {
        echo $value.'<br>';
    }*/

        #percobaan1
        $no=0;
      foreach ($explode3 as $key => $value) {
        #echo $value.'<br>';
        //cheking stopword
        if($value == 'pelita' or $value == 'aku' or $value =='yang' or $value == 'ini'){
           # echo 'DIHILANGKAN<br>';
        }else{
            $hasil[] = $value;
            #echo $value.'<br>';
        }
        $no++;
        #echo $value.'<Br>';

    }

#var_dump($hasil);
    echo '<br><br><br>';
    echo 'Kalimat Asli :<br>'.$text;
   echo ' <br><br>Ini Implode 1 Menghilangkan titik<br>'.$implode;
   echo '<br><br><br>Implode ke2 Menghilangkan koma<br>'.$implode2;
   echo '<br><br>Implode 3<br>'.$implode3;
   echo '<br><br><br>Ini final<br>';
   foreach ($hasil as $key => $value) {
       echo $value.' ';
   }
   #echo $text;
    
    
    
   

     
    ?>