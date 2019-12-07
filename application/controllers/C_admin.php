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
		$jumlah = 0;
		$omset = 0;
		foreach ($this->model->get_transaksi() as $key => $value) {
			$jumlah++;
			$omset = $omset + $value->total;
		}
		$data = array(
			'region' => $this->model->get_region(),
			'powder' => $this->model->get_count_powder(),
			'topping' => $this->model->get_count_topping(),
			'karyawan' => $this->model->get_count_karyawan(),
			'profit' => $omset,
			'order' => $jumlah
		);
        $this->template_admin->load('template_admin','admin/dashboard/v_dashboard', $data);
	}

	public function shift1(){
		$jumlah = 0;
		$omset = 0;
		$status_proses = 0;	
		$status_succcess = 0;
		foreach ($this->model->get_transaksi_shift1() as $key => $value) {
			$jumlah++;
			$omset = $omset + $value->total;
			if($value->status != 'Success'){
				$status_proses++;
			}
			else{
				$status_succcess++;
			}
		}
		$data = array(
			'jumlah' => $jumlah,
			'omset' => $omset,
			'proses' => $status_proses,
			'success' => $status_succcess,
			'region' => $this->model->get_region()
		);
		$this->template_admin->load('template_admin','admin/transaksi/v_shift1', $data);
	}

	public function shift2(){
		$jumlah = 0;
		$omset = 0;
		$status_proses = 0;	
		$status_succcess = 0;
		foreach ($this->model->get_shift2() as $key => $value) {
			$jumlah++;
			$omset = $omset + $value->total;
			if($value->status != 'Success'){
				$status_proses++;
			}
			else{
				$status_succcess++;
			}
		}
		$data = array(
			'jumlah' => $jumlah,
			'omset' => $omset,
			'proses' => $status_proses,
			'success' => $status_succcess,
			'region' => $this->model->get_region()
		);
		$this->template_admin->load('template_admin','admin/transaksi/v_shift2', $data);
	}

	public function total_transaksi(){
		$jumlah = 0;
		$omset = 0;
		$status_proses = 0;	
		$status_succcess = 0;
		foreach ($this->model->get_transaksi() as $key => $value) {
			$jumlah++;
			$omset = $omset + $value->total;
			if($value->status != 'Success'){
				$status_proses++;
			}
			else{
				$status_succcess++;
			}
		}
		$data = array(
			'jumlah' => $jumlah,
			'omset' => $omset,
			'proses' => $status_proses,
			'success' => $status_succcess,
			'region' => $this->model->get_region()
		);
		$this->template_admin->load('template_admin','admin/transaksi/v_totalTransaksi', $data);
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

	public function insert_diskon(){
		if (isset($_POST['submit'])) {		
		
			$nominal = $this->input->post('nominal', TRUE);
			$min_pembelian = $this->input->post('min_pembelian', TRUE);

			$this->model->insert_diskon($nominal,$min_pembelian);

			if($this->db->affected_rows()>0){
				$this->session->set_flashdata('flash','Data Diskon Berhasil Ditambahkan');
			}

			echo "<script>window.location='".base_url('index.php/c_admin/discount')."'</script>";

		}
	}

	public function update_diskon(){
		#code update...
	}

	public function delete_diskon(){
		#code delete ...
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

	public function insert_region(){
		if (isset($_POST['submit'])) {
			$nama = $this->input->post('nama', TRUE);
			$alamat = $this->input->post('alamat', TRUE);

			$this->model->insert_region($nama,$alamat);
			if($this->db->affected_rows()>0){
				$this->session->set_flashdata('flash','Data Region Berhasil Ditambahkan');
			}

			echo "<script>window.location='".base_url('index.php/c_admin/region')."'</script>";
		}
	}

	public function update_region(){
		#code update
	}

	public function delete_region(){
		#code delete
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

	public function insert_karyawan(){
		if(isset($_POST['submit'])){
			$id = $this->input->post('id', TRUE);
			$nama = $this->input->post('nama',TRUE);
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);
			$kontak = $this->input->post('kontak', TRUE);
			$email = $this->input->post('email', TRUE);
			$alamat = $this->input->post('alamat',TRUE);

			$this->model->insert_karyawan($id, $nama, $username, $password, $kontak, $email, $alamat);

			if($this->db->affected_rows()>0){
				$this->session->set_flashdata('flash','Data Karyawan Berhasil Ditambahkan');
			}

			echo "<script>window.location='".base_url('index.php/c_admin/karyawan')."'</script>";
		}
	}
}