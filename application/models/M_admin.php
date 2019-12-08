<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_admin extends CI_Model{

        public function get_count_powder(){

            $sql = $this->db->count_all_results('powder');

            return $sql;
        }

        public function get_count_topping(){
        	return $this->db->count_all_results('topping');
        }

        public function get_count_karyawan(){
        	return $this->db->count_all_results('staff');
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

    	public function get_diskon($id = null){
    		$this->db->select('*');
    		$this->db->from('diskon');
            if($id != null){
                $this->db->where('id_diskon', $id);
            }

    		$query = $this->db->get();
    		return $query->result();
    	}

        public function insert_diskon($nominal, $min_pembelian){
            $data = array(
                'total_diskon' => $nominal,
                'min_pembelian' => $min_pembelian
            );

            $this->db->insert('diskon', $data);
        }

    	public function get_region($id = null){
    		$this->db->select('*');
    		$this->db->from('region');
            if($id != null){
                $this->db->where('id_region', $id);
            }

    		$query = $this->db->get();
    		return $query->result();
    	}

        public function insert_region($nama , $alamat){
            $data = array(
                'nama_region' => $nama,
                'alamat' => $alamat
            );

            $this->db->insert('region',$data);
        }

    	public function get_data_karyawan($id = null){
    		$this->db->select('*');
    		$this->db->from('staff');
            if($id != null){
                $this->db->where('id_staff', $id);
            }
            $this->db->where('hak_akses', 'Barista');

    		$query = $this->db->get();
    		return $query->result();
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

    }

?>