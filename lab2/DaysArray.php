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
	function br(){echo "<br />";}
	
	$Days = array(
		array("Sunday",	"Dimanche"),
		array("Monday",	"Lundi"),
		array("Tuesday",	"Mardi"),
		array("Wednesday",	"Mercredi"),
		array("Thursday",	"Jeudi"),
		array("Friday",	"Vendredi")
	);

	tags("h4", "The Days of the week in English are : ");
	for($i=0;$i<sizeof($Days);$i++)
		tags("p",$Days[$i][0]);

	br();br();
	tags("h4", "The Days of the week in French are : ");
        for($i=0;$i<sizeof($Days);$i++)
                tags("p",$Days[$i][1]);

?>

</div>
</body>
</html>

