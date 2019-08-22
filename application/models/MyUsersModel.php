<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class MyUsersModel extends CI_Model 
	{
		public function __construct()
		{
			$this->load->database();
			$this->load->library("session");
			//$this->load->model("form_validation");
			
		}
		public function get_all_users()
		{
			$query = $this->db->query("SELECT * FROM USERS ") -> result_array();
			return $query;
		}
		public function auth_user($user , $pass )
		{

			$user = $this->db->escape_str($user);
			$pass = $this->db->escape_str($pass);
			//echo ($pass);
			$parms = array(
						"USERNAME" => $user ,
						"PWD"  => hash_hmac("sha512",$pass,"C-X-C",false) 
						);
			$result = $this->db->get_where("USERS",$parms)->row();
			//..var_dump($this->db);
		//	var_dump($result);	
			if($result != null)
			{
				//var_dump($result);
				
					$this->session->set_userdata("name", $result->USERNAME);
					$this->session->set_userdata("lvl", $result->LVL);
					$this->session->set_userdata("id", $result->ID);
					return true;
			}else{
				//$this->load->view('login');
				//echo "<pre class='well' >not logged in" .var_dump($result,$parms) . "</pre>";
				//var_dump($_SESSION);
			}
			return false;
			
			
		}
		
		
	}