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
	function verify_email($form_data){
		if(isset($_POST['submit'])){
//			var_dump($_POST);
			$email = $_POST['email'];
			$email2 = $_POST['emailagain'];

			if(!empty($email)){
				if(has_at($email)){
					if($email === $email2){

					}else{
						$error["email"] = "The emails dont match!";
					}
				}else{
					$error["email"] = "Your email is missing the \"@\", Please enter again";
				}
			}else{
				$error["email"] = "Your email is empty! Please try again";
			}
		}

		if(isset($error)){
			$form_data .= get_html("p", $error['email'], "class=\"text-danger\"");
		}else{
			$form_data .= get_html(
				"p",
				"Thank you! you have keyed in the same email",
				"class=\"text-success\""
			);
		}
		return $form_data;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Prime Number Calculator</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	</head>
	<body class="container">
		<div class="container">
			<br/><br/>
			<h2>We must verify your email address</h2>
			<form action="verify_email.php" method="post" accept-charset="utf-8">
				<?php
				$form_section_1 = get_html("label","Email :");
				$form_section_1 = get_html(
					"div",
						$form_section_1 . get_inputbox(array(
							"type"=>"email",
							"class"=>"form-control",
							"placeholder"=>"Email",
							"name"=>"email"
						)), "class=\"form-group\"");

				$form_section_2 = get_html("label","Enter Email Again:");
				$form_section_2 = get_html(
					"div",
						$form_section_2 . get_inputbox(array(
							"type"=>"email",
							"class"=>"form-control",
							"placeholder"=>"Email",
							"name"=>"emailagain"
						)), "class=\"form-group\"");
				$form_data = $form_section_1 . $form_section_2;
				$form_data.= get_html(
					"button",
					"Submit",
					"type=\"submit\" class=\"btn btn-default\" name=\"submit\""
				);
				$form_data = verify_email($form_data);
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
