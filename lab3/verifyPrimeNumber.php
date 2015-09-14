<?php

function verifyPrimeNumber($NumberTest){
	$primes = array(2, 3, 5, 7, 17);

	foreach($primes as $num){
		if($NumberTest == $num){
			echo_html("p", "Yes! its a prime number", "text-success");
			return;
		}
	}
	echo_html("p", "No! Its not a prime number", "text-danger");
}
function echo_html($tag, $text, $info=""){
	echo "<$tag $info>$text</$tag>";
}
echo"
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<title>Leap Year Calculator</title>
<link href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css\" rel=\"stylesheet\">
<meta http-equiv=\"Content-Type\"content=\"text/html; charset=iso-8859-1\" />
</head>";
if(isset($_POST["primenumber"])){ verifyPrimeNumber((int)$_POST["primenumber"]);}
