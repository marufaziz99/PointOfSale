<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_admin extends CI_Model{

        public function get_transaksi_shift1(){
            $currentDate = date('Y-m-d');

            $sql = $this->db->query("SELECT * FROM jual WHERE tanggal = '$currentDate' AND waktu BETWEEN '08:00:00' AND '16:00:00'");

            return $sql->result();
        }

    	public function get_diskon(){
    		$this->db->select('*');
    		$this->db->from('diskon');

    		$query = $this->db->get();
    		return $query->result();
    	}

    	public function get_region(){
    		$this->db->select('*');
    		$this->db->from('region');

    		$query = $this->db->get();
    		return $query->result();
    	}

    	public function get_data_karyawan(){
    		$this->db->select('*');
    		$this->db->from('staff');

    		$query = $this->db->get();
    		return $query->result();
    	}

    	public function new_id_karyawan(){
    		// $sql = $this->db->query("select max('id_staff') as maxID from staff");

    		// $this->db->select_max('id_staff');

    		// $query = $this->db->get('staff');

    		// return $query->row();
    	}

    }

?>