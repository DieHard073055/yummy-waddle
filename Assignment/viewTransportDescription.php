<?php
//
class model{

	function get_table_data(){
		$table_data = array(
			array(
				"Van", "10", "http://www.wired.com/images_blogs/underwire/2010/07/VAN-lost-6601.jpg"
			),
			array(
				"Coaster", "30", "http://toyota.ht/wp-content/uploads/2014/08/hinoto-toyota_coaster_6.jpg"
			),
			array(
				"Bus", "75", "https://www.thomasbus.com/_img/our_buses/bus_lg_school_efx_02.jpg"
			)
		);
		return $table_data;
	}
	function get_title(){
		return "Transport Description";
	}
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
	function get_image_html($src, $info){
		return "<img src=\"$src\" class=\"$info\" height=\"75\" width=\"142\"";
	}
  function print_header($title){ include 'head.php'; }
  function load_view(){
    $this->print_header($this->model->get_title());

		$table_data = $this->model->get_table_data();
		$table_row = "";

		for ($i=0; $i < count($table_data); $i++) {
			$table_col="";
			for ($j=0; $j < count($table_data[$i]); $j++) {
				if(strpos($table_data[$i][$j], "http") !== false){
					$table_data[$i][$j] = $this->get_image_html($table_data[$i][$j], "img-rounded");
				}
				$table_col .= $this->echo_html("td", $table_data[$i][$j]);
			}
			$table_row.=$this->echo_html("tr", $table_col);
		}


		$html = $this->echo_html("table", $table_row, "class=\"table table-hover\"");
		$html .= $this->echo_html("a", "<br/><br/>Home", "href=\"home.php\"");
		$html = $this->echo_html("h2", $this->model->get_title()) . $html;
    $html = $this->echo_html("body", $html, "class=\"container\"");
    $html = $this->echo_html("html", $html, "xmlns=\"http://www.w3.org/1999/xhtml\"");

    echo $html;
  }
}

class controller{
  /*Main Function*/
	function main(){
		$TransViewController = new view;
		$TransModelController = new model;
		$TransViewController->set_model($TransModelController);
		$TransViewController->load_view();
	}
}
$TransController = new controller;
$TransController->main();
