<?php

function determineLeapYear($year){
	if(($year % 4) == 0){
		echo_html("p", "Its a Leap Year!", "class=\"text-success\"");
	}
	else if(($year % 100) == 0){
		echo_html("p", "Its a Leap Year!", "class=\"text-success\"");
	}
	else if(($year % 400) == 0){
		echo_html("p", "Its a Leap Year!", "class=\"text-success\"");
	}
	else echo_html("p", "Its not a Leap Year!", "class=\"text-danger\"");

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
if(isset($_POST["year"])){ determineLeapYear((int)$_POST["year"]);}
