<div id="page-wrapper">
	<div class="container-fluid">
<?php

function echopre($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

#echopre($match);
for ($i=0; $i < sizeof($match) ; $i++) { 
	# code...
	echo $match[$i];
}






?>
	</div>
</div>