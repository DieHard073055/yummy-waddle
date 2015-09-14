<?php

class fileController{

  function __construct(){if (!defined('DATA_FILE'))define("DATA_FILE", "bookingFile.txt");}

  function write_data($data){
    $out = "";
    foreach ($data as $key => $value) {
      if($key != "submit")
      $out .= $value .", ";
    }
    $out .= "\n";
    file_put_contents(DATA_FILE, $out, FILE_APPEND | LOCK_EX);
  }

  function read_data(){
    return file_get_contents(DATA_FILE);
  }

  function check_for_unique_bcode($bcode=""){
    $file_data =  explode(',', $this->read_data());
    $bcodes = array();
    for ($i=0; $i < count($file_data); $i++) {
      if(($i % 6)==0 ){
        $data = trim(preg_replace('/\s\s+/', ' ', $file_data[$i]));
        if($data != "")
        array_push($bcodes, $data);
      }
    }

    foreach ($bcodes as $code ) {
      if($code === $bcode){
        return false;
      }
    }
    return true;
  }

  function get_booking_data($bcode){
    $file_data =  explode(',', $this->read_data());
    $out = array();
    for ($i=0; $i < count($file_data); $i++) {
      if(($i % 6)==0 ){
        $data = trim(preg_replace('/\s\s+/', ' ', $file_data[$i]));
        if($data == $bcode){
          for ($j=$i; $j < $i+6; $j++) {
            array_push($out, $file_data[$j]);
          }
          return $out;
        }
      }
    }
    return "";
  }
}


//file_put_contents("awesome.txt", "YO!!!!\n", FILE_APPEND | LOCK_EX);
