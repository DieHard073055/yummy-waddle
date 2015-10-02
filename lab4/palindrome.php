<?php
	function get_html($tag, $text, $info=""){
		return "<$tag $info>$text</$tag>";
	}

	function get_inputbox($info){
		$out ="";
		foreach ($info as $key => $value) {
			$out .= "$key=\"$value\" ";
		}
		return "<input $out/>";
	}

	function has_at($email){
		$result = strpos($email, "@");
		if($result === false){
			return false;
		}else{
			return true;
		}
	}

	function check_palindrome($form_data){
		if(isset($_POST['submit'])){
			$palindrome = $_POST["palindrome"];
			if($palindrome != ""){
				$rev = strrev($palindrome);
				if(strcmp($palindrome, $rev) == 0){

				}else{
					$error['palindrome'] = "The string is not a palindrome";
				}
			}else{
				$error['palindrome'] = "Dont leave the inputbox empty";
			}

			if(isset($error)){
				$form_data .= get_html("p", $error['palindrome'], "class=\"text-danger\"");
			}else{
				$form_data .= get_html(
					"p",
					"This string is a palidrome",
					"class=\"text-success\""
				);
			}
		}
		return $form_data;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Perfect Palindrome</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	</head>
	<body class="container">
		<div class="container">
			<br/><br/>
			<h2>Perfect Palindrome</h2>
			<form action="palindrome.php" method="post" accept-charset="utf-8">
				<?php
				$form_section_1 = get_html("label","enter your test palindrome string :");
				$form_section_1 = get_html(
					"div",
						$form_section_1 . get_inputbox(array(
							"type"=>"text",
							"class"=>"form-control",
							"placeholder"=>"palindrome",
							"name"=>"palindrome"
						)), "class=\"form-group\"");

				$form_data = $form_section_1;
				$form_data.= get_html(
					"button",
					"Check for Palindrome",
					"type=\"submit\" class=\"btn btn-default\" name=\"submit\""
				);
				$form_data = check_palindrome($form_data);
				echo $form_data;
?>			<br/><br/><br/>
			</form>
    <p>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
  </p>
	</div>
	</body>
</html>
