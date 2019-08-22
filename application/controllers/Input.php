<?php

class Input extends CI_Controller
{

	public function __construct()
	
	{
		parent::__construct();
		$this->load->model("MyTables");
		
	}
	public function index ($page,$mode,$id)
	{
	//	echo $page;
		//die();
		$modes = array("edit","update","unlink");
		(!in_array($mode,$modes,TRUE)) ?  exit(redirect("/")) : null;
		$this->$mode($page);
		
	}
	public function edit($page,$id)
	{
		if($page == "wh")
		{
			if($this->form_validation->run() == FALSE)
			{
				redirect(site_to_link('/index.php/wh/edit/1/')';
			}
		}
		
	}


}

?>