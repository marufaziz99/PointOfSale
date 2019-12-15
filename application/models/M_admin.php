<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_admin extends CI_Model{

    	public function get_admin(){
    		$id = $this->session->userdata('id_staff');

    		$this->db->select('*');
    		$this->db->from('staff');
    		$this->db->where('level',1);
    		$this->db->where('id_staff', $id);

    		$query = $this->db->get();

    		return $query;

    	}

    	public function update_profile($id, $nama, $username, $email, $contact, $alamat, $password){
    		$data = array(
                'Nama' => $nama,
                'username' => $username,
                'contact' =>$contact,
                'alamat' => $alamat,
                'email' => $email
            );

            if (!empty($password)) {
                $data['password'] = $password;
            }

            $this->db->where('id_staff', $id);
            $this->db->update('staff', $data);
    	}

    	// public function sum_total(){
    	// 	$currentDate = date('Y-m-d');
    	// 	$this->db->select('(SELECT SUM(jual.total) FROM jual WHERE jual.tanggal = "$currentDate" ) AS omset', FALSE);
    	// 	$query = $this->db->get('jual');

    	// 	return $query;
    	// }

    	public function get_omset_bulanan(){
    		$mon = date('m');
    		$sql = $this->db->query("SELECT SUM(total) AS omset FROM jual WHERE MONTH(tanggal) = '$mon' ");

    		return $sql->result();
    	}

        public function get_count_powder(){

            $sql = $this->db->count_all_results('powder');

            return $sql;
        }

        public function get_count_topping(){
        	return $this->db->count_all_results('topping');
        }

        public function get_count_karyawan(){
        	$this->db->where('level', 2);
        	$this->db->from('staff');
        	return $this->db->count_all_results();
        }

        public function get_menu_basic(){
        	$this->db->where('id_jenis', 1);
        	$this->db->from('powder');

        	return $this->db->count_all_results();
        }

        public function get_menu_pm(){
        	$this->db->where('id_jenis', 2);
        	$this->db->from('powder');

        	return $this->db->count_all_results();
        }

        public function get_menu_soklat(){
        	$this->db->where('id_jenis', 3);
        	$this->db->from('powder');

        	return $this->db->count_all_results();
        }

        public function get_menu_coklat_pm(){
        	$this->db->where('id_jenis', 4);
        	$this->db->from('powder');

        	return $this->db->count_all_results();
        }

        public function get_menu_yakult(){
        	$this->db->where('id_jenis', 5);
        	$this->db->from('powder');

        	return $this->db->count_all_results();
        }

        public function get_menu_juice(){
        	$this->db->where('id_jenis', 6);
        	$this->db->from('powder');

        	return $this->db->count_all_results();
        }

        public function get_transaksi_shift1(){
            $currentDate = date('Y-m-d');

            $sql = $this->db->query("SELECT * FROM jual WHERE tanggal = '$currentDate' AND waktu BETWEEN '08:00:00' AND '16:00:00'");

            return $sql->result();
        }

        public function get_shift2(){
            $currentDate = date('Y-m-d');

            $sql = $this->db->query("SELECT * FROM jual WHERE tanggal = '$currentDate' AND waktu BETWEEN '16:00:00' AND '22:00:00'");

            return $sql->result();
        }

        public function get_transaksi(){
            $currentDate = date('Y-m-d');

            $sql = $this->db->query("SELECT * FROM jual WHERE tanggal = '$currentDate'");

            return $sql->result(); 
        }

        public function get_jenis_menu(){
        	$this->db->select('*');
        	$this->db->from('jenis_menu');

        	$query = $this->db->get();

        	return $query->result();
        }

        public function get_sajian(){
        	$this->db->select('*');
        	$this->db->from('penyajian');

        	$query = $this->db->get();

        	return $query->result();
        }

        public function get_varian($id, $region){
        	$this->db->select('*');
        	$this->db->from('varian_powder');
        	$this->db->join('region', 'varian_powder.id_region = region.id_region');
        	$this->db->where('varian_powder.id_varian', $id);
        	$this->db->where('varian_powder.id_region', $region);
        	$query = $this->db->get();

        	return $query;
        }

        public function update_varian(){
        	#code...
        }

        public function delete_varian($id){
        	$this->db->where('id_varian', $id);
        	$this->db->delete('varian_powder');
        }

        public function get_powder($id, $region){
        	$this->db->select('*');
        	$this->db->from('powder');
        	$this->db->join('detail_penyajian','powder.id_powder = detail_penyajian.id_powder');
        	$this->db->join('penyajian', 'detail_penyajian.id_penyajian = penyajian.id_penyajian');
        	$this->db->join('varian_powder', 'powder.id_varian = varian_powder.id_varian');
        	$this->db->where('powder.id_varian', $id);
        	$this->db->where('varian_powder.id_region', $region);

        	$query = $this->db->get();

        	return $query->result();
        }

        public function update_powder(){
        	#code...
        }

        public function delete_powder($id){
        	$this->db->where('id_powder', $id);
        	$this->db->delete('powder');
        }

        public function get_topping($id = null){
        	$this->db->select('*');
        	$this->db->from('topping');
        	if($id != null){
                $this->db->where('id_topping', $id);
                $query = $this->db->get();
	    		return $query;
            }
            else{
				$query = $this->db->get();
	    		return $query->result();
            } 
        }

        public function insert_topping($nama, $harga, $stok, $region){
        	$data = array(
        		'nama_topping' => $nama,
        		'harga' => $harga,
        		'stock_awal' => $stok,
        		'penambahan' => 0,
        		'total' => $stok,
        		'sisa' => $stok,
        		'id_region' => $region
        	);

        	$this->db->insert('topping', $data);
        }

        public function update_topping($id, $nama, $harga, $penambahan, $sisa){
        	$data = array();

        	if (!empty($nama)) {
        		$data['nama_topping'] = $nama;
        	}

        	if (!empty($harga)) {
        		$data['harga'] = $harga;
        	}

        	if (!empty($penambahan)) {
        		$data['stock_awal'] = $sisa;
        		$data['penambahan'] = $penambahan;
        		$data['total'] = $sisa + $penambahan;
        		$data['sisa'] = $data['total'];
        	}

        	$this->db->where('id_topping', $id);
        	$this->db->update('topping', $data);
        }

        public function delete_topping($id){
        	$this->db->where('id_topping', $id);
        	$this->db->delete('topping');
        }

        public function get_ekstra($id = null){
        	$this->db->select('*');
        	$this->db->from('ekstra');
        	if ($id != null) {
        		$this->db->where('id_ekstra', $id);
        		$query = $this->db->get();
        		return $query;
        	}
        }

        public function get_id_ekstra($nama, $satuan, $region){
        	$this->db->select('*');
        	$this->db->from('ekstra');
        	$this->db->where('nama_ekstra', $nama);
        	$this->db->where('satuan', $satuan);
        	$this->db->where('id_region', $region);

        	$query = $this->db->get();

        	return $query;
        }

        public function insert_ekstra($nama, $stok, $satuan, $region){
        	$data = array(
        		'nama_ekstra' => $nama,
        		'stock_awal' => $stok, 
        		'penambahan' => 0,
        		'total' => $stok,
        		'sisa' => $stok,
        		'satuan' => $satuan,
        		'id_region' => $region
         	);

         	$this->db->insert('ekstra', $data);
        }

        public function insert_detail_ekstra($id){
        	for ($i=1; $i <=6 ; $i++) { 
        		$data = array(
        			'id_ekstra' => $id,
        			'id_jenis' => $i,
        			'pemakaian' => 0
        		);

        		$this->db->insert('detail_ekstra', $data);
        	}
        }

        public function update_ekstra($id, $nama, $sisa, $penambahan, $satuan){
        	$data = array();

        	if(!empty($nama)){
        		$data['nama_ekstra'] = $nama;
        	}

        	if(!empty($satuan)){
        		$data['satuan'] = $satuan;
        	}

        	if (!empty($penambahan)) {
        		$data['stock_awal'] = $sisa;
        		$data['penambahan'] = $penambahan;
        		$data['total'] = $sisa + $penambahan;
        		$data['sisa'] = $data['total'];
        	}

        	$this->db->where('id_ekstra', $id);
        	$this->db->update('ekstra', $data);
        }

        public function delete_ekstra($id){
        	$this->db->where('id_ekstra', $id);
        	$this->db->delete('ekstra');
        }

    	public function get_diskon($id = null){
    		$this->db->select('*');
    		$this->db->from('diskon');
            if($id != null){
                $this->db->where('id_diskon', $id);
                $query = $this->db->get();
	    		return $query;
            }
            else{
				$query = $this->db->get();
	    		return $query->result();
            }    		
    	}

        public function insert_diskon($nominal, $min_pembelian){
            $data = array(
                'total_diskon' => $nominal,
                'min_pembelian' => $min_pembelian
            );

            $this->db->insert('diskon', $data);
        }

        public function update_diskon($id, $total, $min_pembelian){
        	$data = array(
        		'total_diskon' => $total,
        		'min_pembelian' => $min_pembelian
        	);

        	$this->db->where('id_diskon', $id);
        	$this->db->update('diskon', $data);
        }

        public function delete_diskon($id){
        	$this->db->where('id_diskon', $id);
        	$this->db->delete('diskon');
        }

    	public function get_region($id = null){
    		$this->db->select('*');
    		$this->db->from('region');
            if($id != null){
                $this->db->where('id_region', $id);
                $query = $this->db->get();
	    		return $query;
            }
            else{
            	$query = $this->db->get();
	    		return $query->result();
            }
    		
    	}

        public function insert_region($nama , $alamat){
            $data = array(
                'nama_region' => $nama,
                'alamat' => $alamat
            );

            $this->db->insert('region',$data);
        }

        public function update_region($id, $nama ,$alamat){
        	$data = array(
        		'nama_region' => $nama,
        		'alamat' => $alamat
        	);

        	$this->db->where('id_region', $id);
        	$this->db->update('region', $data);
        }

        public function delete_region($id){
        	$this->db->where('id_region', $id);
        	$this->db->delete('region');
        }

    	public function get_data_karyawan($id = null){
    		$this->db->select('*');
    		$this->db->from('staff');
    		$this->db->where('level', 2);
            if($id != null){
                $this->db->where('id_staff', $id);
                $query = $this->db->get();
	    		return $query;
            }
            else{
            	$query = $this->db->get();
	    		return $query->result();
            }          
   		
    	}

    	public function insert_karyawan($id, $nama, $username, $password, $kontak, $email, $alamat){
            $data = array(
                'id_staff' => $id,
                'Nama' => $nama,
                'username' => $username,
                'password' => $password,
                'contact' =>$kontak,
                'alamat' => $alamat,
                'email' => $email
            );

            $this->db->insert('staff', $data);
        }

        public function update_karyawan($id, $nama, $username, $password, $kontak, $email, $alamat){
            $data = array(
                'Nama' => $nama,
                'username' => $username,
                'contact' =>$kontak,
                'alamat' => $alamat,
                'email' => $email
            );

            if (!empty($password)) {
                $data['password'] = $password;
            }

            $this->db->where('id_staff', $id);
            $this->db->update('staff', $data);
        }

        public function delete_karyawan($id){
            $this->db->where('id_staff', $id);
            $this->db->delete('staff');
        }

    }

?>