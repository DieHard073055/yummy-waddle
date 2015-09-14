<?php
class process_model{
  var $bcode;
  var $bdesc;
  var $bdate;
  var $btranstype;
  var $bpassangers;
  var $bdestination;

  function __construct($data){
    $this->bcode = $data[0];
    $this->bdesc = $data[1];
    $this->bdate = $data[2];
    $this->btranstype = $data[3];
    $this->bpassangers = $data[4];
    $this->bdestination = $data[5];
  }
  function get_title(){
    return "Transport Booking Details";
  }

}
class process_view{
  function get_html($tag, $text, $info=""){
    return "<$tag $info>\n$text\n</$tag>\n";
  }

  function generate_view($model){
    $html = $this->get_html("h2", $model->get_title());
    $html.= $this->get_html("p","Booking Code : " . $model->bcode);
    $html.= $this->get_html("p","Booking Description : " . $model->bdesc);
    $html.= $this->get_html("p","Booking Date : " . $model->bdate);
    $html.= $this->get_html("p","Transport Type : " . $model->btranstype);
    $html.= $this->get_html("p","No. of Passengers : " . $model->bpassangers);
    $html.= $this->get_html("p","Destination : " . $model->bdestination);
    $html = $this->get_html("div", $html, "class=\"row\"");
		$html .= $this->get_html("a", "<br/><br/>Home", "href=\"home.php\"");
    $html .= $this->get_html("a", "<br/><br/>Back to Search", "href=\"searchBookingDetails.php\"");
		$html = $this->get_html("div", $html, "class=\"col-xs-6 col-md-4\"");
		$html = $this->get_html("body", $html, "class = \"container\"");

    echo $html;
  }
  function print_header($title){
		include 'head.php';
	}
}
class process_controller{
  function main($data){
    $processSearchModel = new process_model($data);
    $processSearchView = new process_view;
    $processSearchView->print_header($processSearchModel->get_title());
    $processSearchView->generate_view($processSearchModel);
  }
}
