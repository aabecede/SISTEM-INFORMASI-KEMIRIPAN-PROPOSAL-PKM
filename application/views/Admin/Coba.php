<?php 

#$arrNilaiTarget = array(1, 1, 1, 1, 1, 1, 0, 0 ,0 ,0);
/*$arrNilaiTarget[0] = array(
							array(1, 1, 1),
							array(1, 1, 1),
					);*/
$arrNilaiTarget[1] = array(1, 1, 0);
#$arrNilaiTarget[2] = array(1, 1, 1, 1, 0, 1, 0);
/*$arrNilaiTarget = array(
						array(1, 1, 1, 1, 1, 1, 0, 0 ,0 ,0),
						array(1, 1, 1, 1, 1, 1, 0, 1 ,0 ,1),
						array(1, 1, 1),
						array(0),
						array(1),
					);*/
#$arrNilaiSumberSemuanya = array(array(1, 1, 1, 1, 1, 1, 0, 1, 1));
$arrNilaiSumberSemuanya[0] = array(1, 0, 1);
$arrNilaiSumberSemuanya[1] = array(0, 0, 1);
#$arrNilaiSumberSemuanya[2] = array(0, 0, 1, 1, 1, 1, 0 , 1, 0);
#$arrNilaiSumberSemuanya = array(
					/*array(1, 1, 1, 1, 1, 1, 0, 1, 1),
					array(1, 1, 1, 1, 1, 1, 0, 1, 1),
					array(1, 1, 1, 1, 1, 1, 0, 1, 1)
					);*/


function calculateSimiliarityAll($targetValues, $sumberValuesAll)
{
	$similarityValues = array();

	foreach ($targetValues as $targetVall) {

		foreach ($sumberValuesAll as $sumberValues) 
		{
			$percentSimilarity = calculateSimilarity($targetVall, $sumberValues);

			#echo "PS -> $percentSimilarity<br/>";

			$similarityValues[] = $percentSimilarity;
		}	

	}

	

	return $similarityValues;
}


function calculateSimilarity($targetValues, $sumberValues)
{
	$nilaiPerbandingan = array(); // {1, 1, 1, 1, 1, 0} <-- Hasil perbandingan 2 arr input dan target

	$pjgTarget = count($targetValues); // 5
	$pjgSumber = count($sumberValues); // 6

	$terpanjang = null;
	$terpendek = null;

	if($pjgTarget > $pjgSumber)
	{
		$terpanjang = $targetValues;
		$terpendek = $sumberValues;
	}
	else
	{
		$terpanjang = $sumberValues;
		$terpendek = $targetValues;
	}

	$jumlahAngka1 = 0;

	foreach ($terpanjang as $indeks => $nPanjang) 
	{
		$nPendek = $indeks <= (count($terpendek) - 1) ? $terpendek[$indeks] : -1; // - 1 maksudnya, datanya kosong karena indeks-nya kegedean

		if($nPanjang == $nPendek and $nPanjang != 0 and $nPendek != 0)
		{
			$nilaiPerbandingan[] = 1;

			$jumlahAngka1 += 1;
		}
		else
		{
			$nilaiPerbandingan[] = 0;
		}
	}

	// Pembagian dengan jumlah sumber atau target mana yang terpanjang
	$persenSimilarity = ($jumlahAngka1 / count($terpanjang)) * 100;

	return $persenSimilarity;
	#pre($pjgTarget);
}

function pre($var){
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}
#$calculateSimilarity = calculateSimilarity($arrNilaiTarget,$arrNilaiSumberSemuanya);

$similarities = calculateSimiliarityAll($arrNilaiTarget, $arrNilaiSumberSemuanya);

pre($similarities);

#pre($arrNilaiTarget);
#pre($arrNilaiSumberSemuanya);

?>
