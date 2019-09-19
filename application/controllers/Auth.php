<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("MyUsersModel");
		//$this->load->library("input");
	}

	public function login()
	{
		$this->form_validation->set_rules('user', 'user', 'required|min_length[4]');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[1]');
		if ($this->form_validation->run() == FALSE)
                {
                       
						
						$this->load->view("login");
                }
                else
                {
						//var_dump($result//	
										
						$user = $this->input->post("user",TRUE);
                        $pass = $this->input->post("pass",TRUE);
                       $ok=$this->MyUsersModel->auth_user($user , $pass );
					   if($ok)
					   {
						   redirect( site_link_to('Admin/wh/'));
							//lvl_based_redirect($this);
						// $this->load->view('index');
					   }else{
						    redirect(site_link_to('Auth/login'));
					   }
						//$this->load->view('formsuccess');
                }
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("/");	
	}

	
}


?>