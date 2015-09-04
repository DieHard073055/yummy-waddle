<?php

function tags($tag, $text){
	echo "<$tag> $text</$tag>";
}
function hr(){
	echo "<hr />" ;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>PHP Functions</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
		<meta http-equiv="Content-Type"content="text/html; charset=iso-8859-1" />
	</head>
	<body>
	<div class="container">
		<?php
			tags("h1","Use of PHP built-in functions");
			/* Use of abs() and pow() built-in functions
				Use of echo statements
			*/
			//Initialising the variables
			$f = -9;
			$s= 2; $t = 5;
			//code 
			$absolute = abs($first);
			$power = pow($s, $t);
			//printing them to the screen
			tags("p","Absolute value of $f is : $absolute");
			tags("p","$s to the power of $t is : $power");

			tags("h2", "Different ways of producing the same results as above using coma(,) instead of period(.) (later on this..)");
			hr();
			tags("p", "Absolute value of $f is : ",abs($f),"");
			tags("p", "$s to the power of $t is : ", pow($s, $t),"");			
		?>		
	</div>
	</body>
</html>
