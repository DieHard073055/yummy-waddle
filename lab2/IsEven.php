<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>PHP Functions</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
		<meta http-equiv="Content-Type"content="text/html; charset=iso-8859-1" />
	</head>
	<body>
	<div class="container">

<?php

	function tags($tag, $text){
		echo "<$tag>$text</$tag>";
	}
	function tags_i($tag, $info, $text){
                echo "<$tag $info>$text</$tag>";
        }

	function br(){echo "<br />";}
	function even($value){
		if(($value % 2) == 0) return true;
		return false; 
	}

	
/* Script start */

	$value = 6;
	
	if(is_numeric($value)){
	
		$value = round($value);
		//Check if its even or not
		tags("h3", "Is is even ? ");
		br();
		if(even($value))	
		tags_i("h4","class=\"bg-success\"","Its even!");
		else
		tags_i("h4","class=\"bg-danger\"","Is not even!");
	}else{
		tags_i("h4","class=\"bg-danger\"","Invalid Value : Not a number!");

	}
	


		

?>

</div>
</body>
</html>

