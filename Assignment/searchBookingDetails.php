<?php
class model{
  function get_search_form_data(){
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
    );
    return $form_data;
  }
  function get_search_form_title(){
    return "Search Booking Details";
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
				$label = $this->get_html("label", $title, "for=\"$name\"");
				$input = $this->get_input_box($value);

				$form_element = $this->get_html(
					"div",
					$label . $input,
					"class =\"form-group\""
				);
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
		$form .= $this->get_html("button", "Submit","type=\"submit\" name=\"submit\" class=\"btn btn-default\" id=\"submitbutton\" ");
		$form = $this->get_html("form", $form, "action=\"searchBookingDetails.php\" method=\"get\" id=\"bookingform\"");
		$form = $this->get_html("div", $form, "class=\"container-fluid\"");
		$form = $this->get_html("div", $form, "class=\"row\"");
		$form .= $this->get_html("a", "<br/><br/>Home", "href=\"home.php\"");
		$form = $this->get_html("div", $form, "class=\"col-xs-6 col-md-4\"");
		$form = $this->get_html("body", $form, "class = \"container\"");

		echo $form;
	}

	function print_header($title){
		include 'head.php';
	}

}
class controller{
  function main(){
    require_once "porcessBookATransport.php";
    require_once "processSearchBookingDetails.php";
    $searchModel = new model;
    $searchView = new view;

    if(!isset($_GET['submit'])){
      $searchView->print_header($searchModel->get_search_form_title());
      $searchView->generate_form(
        $searchModel->get_search_form_title(),
        $searchModel->get_search_form_data()
     );
   }else{
     /*******************************/
 		/*          bcode
 		/*******************************/
 		if(isset($_GET['bcode']) && strlen($_GET['bcode']) > 0){
 			if(strlen($_GET['bcode']) == 4){
 				if(!isset($fc))
 				$fc = new fileController();
 				if(!$fc->check_for_unique_bcode($_GET['bcode'])){
 						//Clean!
            //call process booking
            $processSearchController = new process_controller;
            $processSearchController->main($fc->get_booking_data($_GET['bcode']));
 				}else{
 					$error['bcode'] = "Please select a booking code that exists";
 				}
 			}else{
 				$error['bcode'] = "Booking Code is not 4 characters long!";
 			}
 		}else{
 			$error['bcode'] = "Booking Code cannot be left empty";
 		}
    if(isset($error)){
      $searchView->print_header($searchModel->get_search_form_title());
      $searchView->generate_form(
        $searchModel->get_search_form_title(),
        $searchModel->get_search_form_data(),
        $error
     );
    }

   }

  }
}

$searchController = new controller;
$searchController->main();
