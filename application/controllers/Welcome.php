<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("/");
	}
	public function index()
	{
		
		$this->load->library("session");
		if(!$this->is_logged_in())
		{
	
			$this->load->view("login");
		}
		else
		{
			lvl_based_redirect($this);
		}
		
	}
	protected function render_table_awesome($users)
	{
		
		//$this->load->model->RenderScript->format_users($USERS);
		
	}
	protected function is_logged_in()
	{
		return $this->session->has_userdata('lvl');
	}
	
	
}