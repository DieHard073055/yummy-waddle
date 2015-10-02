<?php
//
class model{
  var $_title = "Transport Reservation System";
  var $_name = "Eshan Shafeeq";
  var $_id = "4231171";
  var $_lastModified ="10";
  var $_url_bookingPage = "bookATransport";
  var $_url_searchPage = "searchBookingDetails";
  var $_url_descriptionPage = "viewTransportDescription";

  function get_title(){return $this->_title;}
  function get_name(){ return $this->_name;}
  function get_id(){ return $this->_id;}
  function get_lastModified(){ return $this->_lastModified;}
  function get_url_bookingPage(){ return $this->_url_bookingPage;}
  function get_url_searchPage(){ return $this->_url_searchPage;}
  function get_url_descriptionPage(){ return $this->_url_descriptionPage;}
}

class view{
  var $model;

  function set_model($m){
    $this->model = $m;
  }
  /*Utility functions*/
  function echo_html($tag, $text, $info=""){
      return "<$tag $info>$text</$tag>";
  }
  function link($url, $text){
    return $this->echo_html("a", $text, "href=\"".$url."\""). $this->space();
  }
  function space(){return "   ";}
  function print_header($title){ include 'head.php'; }
  function load_view(){
    $this->print_header($this->model->get_title());

    $html = $this->echo_html("h3",$this->model->get_title());
    $html .= $this->echo_html("p",$this->model->get_name());
    $html .= $this->echo_html("p",$this->model->get_id());
    $html .= $this->echo_html("p",$this->model->get_lastModified());
    $html .= $this->link($this->model->get_url_bookingPage().".php", $this->model->get_url_bookingPage());
    $html .= $this->link($this->model->get_url_searchPage().".php", $this->model->get_url_searchPage());
    $html .= $this->link($this->model->get_url_descriptionPage().".php", $this->model->get_url_descriptionPage());


    $html = $this->echo_html("body", $html, "class=\"container\"");
    $html = $this->echo_html("html", $html, "xmlns=\"http://www.w3.org/1999/xhtml\"");
    $start = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
            \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">";

    echo $start . $html;
  }
}

class controller{
  /*Main Function*/
  function main(){
    $home_model = new model;
    $home_view = new view;
    $home_view->set_model($home_model);
    $home_view->load_view();
  }
}

$home_controller = new controller;
$home_controller->main();

 ?>
