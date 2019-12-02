<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends CI_Controller {

    function __construct(){
		parent::__construct();
		// check_not_login();
        $this->load->library('form_validation');
        $this->load->model('m_admin', 'model');
    }

	public function index(){
        $this->template_admin->load('template_admin','admin/dashboard/v_dashboard');
	}

	public function discount(){
		$data = array(
			'data_diskon' => $this->model->get_diskon()
		);
		$this->template_admin->load('template_admin','admin/diskon/v_diskon', $data);
	}

	public function add_diskon(){
		$this->template_admin->load('template_admin','admin/diskon/v_addDiskon');
	}

	public function region(){
		$data = array(
			'data_region' => $this->model->get_region()
		);
		$this->template_admin->load('template_admin','admin/region/v_cabang', $data);
	}

	public function add_region(){
		$this->template_admin->load('template_admin','admin/region/v_addRegion');
	}

	public function karyawan(){
		$data  = array(
			'data_karyawan' => $this->model->get_data_karyawan()
		);
		$this->template_admin->load('template_admin','admin/karyawan/v_karyawan', $data);
	}

	public function add_karyawan(){
		$this->template_admin->load('template_admin','admin/karyawan/v_addKaryawan');
	}
}