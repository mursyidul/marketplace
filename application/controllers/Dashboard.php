<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	  {
	    parent::__construct();
	    checkSessionUser();
	    $this->load->model("Model_master");
	  }
	public function index()
	{
	  
	  // echo $this->db->last_query();
	  $this->template->load("template", "dashboard/dashboard");
	}
}
