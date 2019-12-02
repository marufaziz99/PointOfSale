<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_admin extends CI_Model{

    	public function get_data_karyawan(){
    		$this->db->select('*');
    		$this->db->from('kasir');

    		$query = $this->db->get();
    		return $query->result();
    	}

    }

?>