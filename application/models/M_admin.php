<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_admin extends CI_Model{

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

    }

?>