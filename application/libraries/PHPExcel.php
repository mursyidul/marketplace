<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";
class Libexcel extends PHPExcel {
   public function __construct() {
      parent::__construct();
   }
}