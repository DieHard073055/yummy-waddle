<?php
class model{
	function get_booking_form_title(){
		return "Book a Transport Page";
	}
	function get_booking_form_details(){
		$form_data = array(
			array(
				"Booking Code : ",
				"text",
				"bcode",
				array(
					"type" => "text",
					"class" => "form-control",
					"name" => "bcode",
					"id" => "bcode",
					"max" => 4
				),
			),
			array(
				"Booking Description : ",
				"text",
				"bdesc",
				array(
					"type" => "text",
					"class" => "form-control",
					"name" => "bdesc",
					"id" => "bdesc",
					"max" => 50
				),
			),
			array(
				"Booking Date : ",
				"text",
				"bdate",
				array(
					"type" => "text",
					"class" => "form-control",
					"name" => "bdate",
					"id" => "bdate",
					"disabled" => 0
				),
			),
			array(
				"Transport type : ",
				"radio",
				"btranstype",
				array(
					array(
						"type" => "radio",
						"name" => "btranstype",
						"value" => "Van",
						"checked" => 0
					),
					array(
						"type" => "radio",
						"name" => "btranstype",
						"value" => "Coaster"
					),
					array(
						"type" => "radio",
						"name" => "btranstype",
						"value" => "Bus"
					),
				),
			),

			array(
				"No of Passangers : ",
				"text",
				"bpassangers",
				array(
					"type" => "text",
					"class" => "form-control",
					"name" => "bpassangers",
					"id" => "bpassangers"
				),
			),

			array(
				"Destination : ",
				"text",
				"bdestination",
				array(
					"type" => "text",
					"class" => "form-control",
					"name" => "bdestination",
					"id" => "bdestination"
				),
			),

		);

		return $form_data;
	}
}

class view{


	function get_html($tag, $text, $info=""){
		return "<$tag $info>\n$text\n</$tag>\n";
	}


	function get_input_box($attributes){
		$info = "";
		foreach ($attributes as $att => $key){
			$info .= $att . "=\"" . $key . "\" ";
		}
		return "<input $info/>\n";
	}


	function get_form_element($title, $type, $name, $value){
		switch($type){
			case "text":
				$label = $this->get_html("label", $title, "for=\"$name\"");
				$input = $this->get_input_box($value);

				$form_element = $this->get_html(
					"div",
					$label . $input,
					"class =\"form-group\""
				);
				break;

			case "radio":
				$label = $this->get_html("label", $title, "for=\"$name\"");
				$input ="";
				foreach ($value as $val ) {
					$radio = $this->get_input_box($val).$val['value'];
					$radio = $this->get_html("label", $radio);
					$input .= $this->get_html("div", $radio, "class=\"radio\"");
				}


				$form_element = $this->get_html(
					"div",
					$input,
					"class =\"form-group\""
				);
				break;

			case "hidden":
			$input = $this->get_input_box($value);

			$form_element = $this->get_html(
				"div",
				$input,
				"class =\"form-group\""
			);
			break;
		}
		return $form_element;
	}

	function generate_form($title, $form_data, $error=""){

		$form = $this->get_html("h2", $title);
		foreach ($form_data as $form_element) {
			if($error != ""){
				foreach ($error as $key => $val) {

					if($key == $form_element[2]){
						$form .=$this->get_html("p", $val, "class=\"text-danger\"");
					}
				}
			}

			$form .= $this->get_form_element(
				$form_element[0],
				$form_element[1],
				$form_element[2],
				$form_element[3]
			);
		}
		$form .= $this->get_html("button", "Submit","type=\"button\" name=\"submit\" class=\"btn btn-default\" id=\"submitbutton\" ");
		$form = $this->get_html("form", $form, "action=\"bookATransport.php\" method=\"post\" id=\"bookingform\"");
		$form = $this->get_html("div", $form, "class=\"container-fluid\"");
		$form = $this->get_html("div", $form, "class=\"row\"");
		$form .= $this->get_html("a", "<br/><br/>Home", "href=\"home.php\"");
		$form = $this->get_html("div", $form, "class=\"col-xs-6 col-md-4\"");

		$form.= $this->get_html("script",
			"
			window.addEventListener(\"DOMContentLoaded\", function () {
				document.getElementById(\"submitbutton\").addEventListener(\"click\", function () {
				  submitForm();
				});
			});
			document.getElementById('bdate').value = getdate();
			function submitForm(){
				document.getElementById('bdate').disabled = false;
				document.getElementById('submitbutton').type = \"submit\";
				document.getElementById('submitbutton').click();

			}
			function getdate(){
				var today = new Date();
		    var dd = today.getDate();
		    var mm = today.getMonth()+1; //January is 0!

		    var yyyy = today.getFullYear();
				var xxxx = Math.floor(yyyy * 0.01);
				xxxx *= 100;
				yyyy = yyyy - xxxx;
		    if(dd<10){
		        dd='0'+dd
		    }
		    if(mm<10){
		        mm='0'+mm
		    }
		    var today = dd+'/'+mm+'/'+yyyy;
				return today;
			}",
			"type=\"text/javascript\""
		);
		$form = $this->get_html("body", $form, "class = \"container\"");

		echo $form;
	}

	function print_header($title){
		include 'head.php';
	}
}

class controller{
  /*Main Function*/
  function main(){
		require_once "porcessBookATransport.php";

    $booking_form_model = new model;
    $booking_form_view = new view;

		if(isset($_POST['submit'])){

			$result = $this->validateForm($_POST);

			if($result != 1){
				$booking_form_view->print_header(
					$booking_form_model->get_booking_form_title()
				);
				$booking_form_view->generate_form(
					$booking_form_model->get_booking_form_title(),
					$booking_form_model->get_booking_form_details(),
					$result
				);
			}else{
				if(!isset($fc))
				$fc = new fileController();
				$fc->write_data($_POST);

			}
		}else{
			$booking_form_view->print_header(
				$booking_form_model->get_booking_form_title()
			);
	    $booking_form_view->generate_form(
				$booking_form_model->get_booking_form_title(),
				$booking_form_model->get_booking_form_details()
			);
		}
  }

	function validateForm($values){
		/*******************************/
		/*          bcode
		/*******************************/
		if(isset($_POST['bcode']) && strlen($_POST['bcode']) > 0){
			if(strlen($_POST['bcode']) == 4){
				if(!isset($fc))
				$fc = new fileController();
				if($fc->check_for_unique_bcode($_POST['bcode'])){
						//Clean!
				}else{
					$error['bcode'] = "Please select a booking code that is unique";
				}
			}else{
				$error['bcode'] = "Booking Code is not 4 characters long!";
			}
		}else{
			$error['bcode'] = "Booking Code cannot be left empty";
		}
		/*******************************/
		/*          bdesc
		/*******************************/
		if(isset($_POST['bdesc']) && strlen($_POST['bdesc']) > 0){
			if(strlen($_POST['bdesc']) < 50){
				//Clean!
			}else{
				$error['bdesc'] = "Description cannot be more than 50 characters";
			}
		}else{
			$error['bdesc'] = "Booking Description cannot be left empty";
		}

		/*******************************/
		/*          bpassangers
		/*******************************/

			$capacity['Van'] = 10;
			$capacity['Coaster'] = 30 ;
			$capacity['Bus'] = 75 ;
			$num="";
			foreach ($values as $key => $val) {
				if($key == 'btranstype'){
					$num =(int) $capacity[$val];
				}
			}

			/*******************************/
			/*          bdestination
			/*******************************/
			if(isset($_POST['bdestination']) && strlen($_POST['bdestination']) > 0){
				//all good
			}else{
				$error['bdestination'] = "Booking Destination cannot be left empty";
			}

		if(isset($values['bpassangers'])){
			if(strlen($values['bpassangers']) < 3){
				if(is_numeric($values['bpassangers'])){
					if($values['bpassangers'] <= $num){
						//Clean!
					}else{
						$error['bpassangers'] = "No. of Passenger is more than what the vehical can support";
					}
				}else{
					$error['bpassangers'] = "No. of Passenger can only be numbers";
				}
			}else{
				$error['bpassangers'] = "No. of Passenger cannot be more than $num";
			}
		}else{
			$error['bpassangers'] = "No. of Passenger cannot be left empty";
		}


		if(isset($error)){
			return $error;
		}else{
			//submit form
			return 1;
		}


	}
}

$booking_form_controller = new controller;
$booking_form_controller->main();
