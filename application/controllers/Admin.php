<?php
defined('BASEPATH') OR exit('No SCript transpassing');
class Admin extends CI_Controller
{
	protected $me;
	public function __construct()
	{
		parent::__construct();
		//&get_instance();
		$this->load->model('RenderScript');
		//echo "bingo";
		login_check();
		
	}
	public function index()
	{
		$this-> wh();
		
	}
	public function wh($opt="all",$parm1=null,$parm2=null)
	{		
		
	   switch($opt){
		   
		case "all":
		$data['page_content']=$this->RenderScript->format_wh_table();
		$this->load->view('header');
		$this->load->view('side_bar');
		$this->load->view('content',$data);
		$this->load->view('footer.php');
		break;
		
		case "edit":
		$this->wh_edit($opt,$parm1);
		break;
		
		case "update":
		$this->wh_view($opt,$parm1);
		break;
		
		case "unlink":
		$this->wh_unlink($opt,$parm1);
		break;
	   }

	}
	public function wh_edit($opt , $ID )
	{
		$data['page_content']=$this->RenderScript->format_wh_edit_form($ID);
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function wh_view($opt,$parm1)
	{
		
	}
	public function wh_unlink($opt,$parm1)
	{
		
		
	}
	public function edit($ID)
	{
		
	}
	public function remove($ID)
	{
		
		
	}

}
?>