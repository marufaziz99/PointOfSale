<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends CI_Controller {

    function __construct(){
		parent::__construct();
		// check_not_login();
        $this->load->library('form_validation');
        $this->load->model('m_barista', 'model');
    }

	public function index(){
        $this->template_admin->load('template_admin','admin/v_dashboard');
	}

	public function karyawan(){
		$this->template_admin->load('template_admin','admin/v_karyawan');
	}
}