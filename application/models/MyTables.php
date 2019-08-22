<?php
-defined('BASEPATH') OR exit('No direct script access allowed');
	class MyTables extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		public function get_all_wh()
		{
			$query = $this->db->get('WH');
			return $query->result_array();
		}
		public function get_wh_by_id($ID)
		{
			$parms=array(
			"ID" => $this->db->escape_str($ID)
			);
			$query = $this->db->get_where('WH',$parms);
			$result = $query ->result_array();
			return   (count($result) > 0)  ?  $result[0] : null;
			
		}
		
		public function get_all_wh_cat()
		{
			$query = $this->db->get('WH_CAT');
			return $query->result_array();
		}
		public function get_wh_cat_by_id($ID)
		{
			$parms=array(
			"ID" => $this->db->escape_str($ID)
			);
			$query = $this->db->get_where('WH_CAT',$parms);
			$result = $query ->result_array();
			return   (count($result) > 0)  ?  $result[0] : null;
			
		}
		public function update_wh_cat($id,$name)
		{
			$id = $this->db->escape_str($id);
			$name=$this->db->escape_str($name);
			$data=array(
			"ID"=>  $id,
			"NAME"=>$NAME  
			);
			return $this->db->update("WH_CAT",$data);
		}
		
		
	}


?>