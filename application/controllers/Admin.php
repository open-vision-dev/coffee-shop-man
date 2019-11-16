<?php
defined('BASEPATH') OR exit('No SCript transpassing U Niggero');
class Admin extends CI_Controller
{
	protected $me;
	public function __construct()
	{
		parent::__construct();
		//&get_instance();
		$this->load->model('RenderScript');
		$this->load->model("WH");
		$this->load->model("WH_CAT");
		$this->load->model("STORE");
		$this->load->model("EXPENSES");
		$this->load->model("MEALS");
		$this->load->model("ORDERS");
		$this->load->model("USED_ITEMS");
		$this->load->model("JOBS");
		$this->load->model("WORKERS");
		$this->load->model("WORKERS_DEBITS");
		$this->load->model("STORE_DEBITS");
		$this->load->model("REPORTS");
		//echo "bingo";
		login_check();

	}
	public function index()
	{
		$this-> wh();

	}
	public function wh_cat($mode="all",$parm1=null,$parm2=null)
	{
			$modes = array(
				"all","edit", "update","unlink","add"
			);
			$target = __FUNCTION__ . '_'.$mode;

			(in_array($mode, $modes , TRUE))? null: redirect("/");
			(method_exists($this, $target)) ?  $this->$target($parm1,$parm2)  : print($target)   ;
	}

	public function store($mode="all",$parm1=null,$parm2=null)
	{
			$modes = array(
				"all","edit", "update","unlink","add"
			);
			$target = __FUNCTION__ . '_'.$mode;
			$mode = ($mode == "update") ? "edit" : "edit";
			(in_array($mode, $modes , TRUE))? null: redirect("/");
			(method_exists($this, $target)) ?  $this->$target($parm1,$parm2)  : print($target)   ;
	}
	public function expt($mode="all",$parm1=null,$parm2=null)
	{
		$modes = array(
			"all","edit", "update","unlink","add"
		);
		$target = __FUNCTION__ . '_'.$mode;
		$mode = ($mode == "update") ? "edit" : "edit";
		(in_array($mode, $modes , TRUE))? null: redirect("/");
		(method_exists($this, $target)) ?  $this->$target($parm1,$parm2)  : print($target)   ;
	}
	public function expenses($mode="all",$parm1=null,$parm2=null)
	{
		($parm=null) ? "this is it " : "";
		$modes=array("all" , "edit" , "update" ,"unlink" , "add","search");
		$target = __FUNCTION__ . '_'.$mode;
		$mode = ($mode == "update") ? "edit" : "edit";
		(in_array($mode, $modes , TRUE))? null: redirect("/");

		(method_exists($this, $target)) ?  $this->$target($parm1,$parm2)  : print($target)   ;

	}
	public function meals($mode="all",$parm1=null,$parm2=null)
	{
		$modes = array(
			"all","edit", "update","unlink","add"
		);
		$target = __FUNCTION__ . '_'.$mode;
		$mode = ($mode == "update") ? "edit" : "edit";
		(in_array($mode, $modes , TRUE))? null: redirect("/");
		(method_exists($this, $target)) ?  $this->$target($parm1,$parm2)  : print($target)   ;

	}
	public function orders($mode="all",$parm1=null,$parm2=null)
	{
		$modes = array(
			"all","edit", "update","unlink","add","info"
		);
		$target = __FUNCTION__ . '_'.$mode;
		$mode = ($mode == "update") ? "edit" : "edit";
		(in_array($mode, $modes , TRUE))? null: redirect("/");
		$parm1 =($parm1 == null && $mode == "all")   ?   expenses_prev_month()  : $parm1;
		$parm2 = ($parm2 == null && $mode == "all") ?    expenses_current_month()   : $parm2;
		(method_exists($this, $target)) ?  $this->$target($parm1,$parm2)  : print($target)   ;

	}
	public function used_items($mode="all",$parm1=null,$parm2=null,$parm3=null)
	{
		$modes = array(
			"all","edit", "update","unlink","add","info"
		);
		$target = __FUNCTION__ . '_'.$mode;
		$mode = ($mode == "update") ? "edit" : "edit";
		(in_array($mode, $modes , TRUE))? null: redirect("/");
		(method_exists($this, $target)) ?  $this->$target($parm1,$parm2,$parm3)  : print($target)   ;
	}
	public function jobs($mode="all",$parm1=null,$parm2=null,$parm3=null)
	{
		$modes = array(
			"all","edit", "update","unlink","add","info"
		);
		$target = __FUNCTION__ . '_'.$mode;
		$mode = ($mode == "update") ? "edit" : "edit";
		(in_array($mode, $modes , TRUE))? null: redirect("/");
		(method_exists($this, $target)) ?  $this->$target($parm1,$parm2,$parm3)  : print($target)   ;
	}
	public function workers	($mode="all",$parm1=null,$parm2=null,$parm3=null)
	{
		$modes = array(
			"all","edit", "update","unlink","add","info"
		);
		$target = __FUNCTION__ . '_'.$mode;
		$mode = ($mode == "update") ? "edit" : "edit";
		(in_array($mode, $modes , TRUE))? null: redirect("/");
		(method_exists($this, $target)) ?  $this->$target($parm1,$parm2,$parm3)  : print($target)   ;
	}
	public function workers_debits($mode="all",$parm1=null,$parm2=null,$parm3=null)
	{
		$modes = array(
			"all","edit", "update","unlink","add","info"
		);
		$target = __FUNCTION__ . '_'.$mode;
		$mode = ($mode == "update") ? "edit" : "edit";
		(in_array($mode, $modes , TRUE))? null: redirect("/");
		(method_exists($this, $target)) ?  $this->$target($parm1,$parm2,$parm3)  : print($target)   ;
	}
	public function store_debits($mode="all",$parm1=null,$parm2=null,$parm3=null)
	{
		$modes = array(
			"all","edit", "update","unlink","add","info" ,"pay"
		);
		$target = __FUNCTION__ . '_'.$mode;
		$mode = ($mode == "update") ? "edit" : "edit";
		(in_array($mode, $modes , TRUE))? null: redirect("/");
		(method_exists($this, $target)) ?  $this->$target($parm1,$parm2,$parm3)  : print($target)   ;
	}
	public function reports($mode='all',$parm1=null,$parm2=null,$parm3=null)
	{
		$modes = array(
			"all" , "info","edit","search"
		);
		$target = __FUNCTION__ . '_'.$mode;
		$mode = ($mode == "update") ? "edit" : "edit";
		(in_array($mode, $modes , TRUE))? null: redirect("/");
		(method_exists($this, $target)) ?  $this->$target($parm1,$parm2,$parm3)  : print($target)   ;
	}
	public function wh($opt="all",$parm1=null,$parm2=null)
	{

	   switch($opt){

		case "all":
		$data['page_content']=$this->RenderScript->format_wh_table();
		$data['page_name'] = "WH-LIST";
		$this->load->view('header');
		$this->load->view('side_bar');
		$this->load->view('content',$data);
		$this->load->view('footer.php');
		break;
		case "add":
		$this->wh_add();
		break;
		case "edit":
		$this->wh_edit($opt,$parm1);
		break;

		case "view":
		$this->wh_view($opt,$parm1);
		break;
		case "change_bg":
		$this->change_bg($opt,$parm1);
		break;
		case "unlink":
		$this->wh_unlink($opt,$parm1);
		break;
		case "listing":
		$this->wh_listing($opt,$parm1);
		break;
	   }

	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////

public function wh_cat_all(){
	$data['page_content'] =  $this->WH_CAT-> render_wh_cat_all();
	$data ["page_name"] = "WH_CAT_ALL";
	$this->load->view("header");
	$this->load->view("side_bar");
	$this->load->view("content",$data);
	$this->load->view("footer");
}
public function  wh_cat_unlink($parm1,$parm2)
{
		$data['page_content'] = $this->WH_CAT->render_wh_cat_unlink($parm1);
		$data['page_name'] = "WH_CAT_NAME";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data);
		$this->load->view("footer");
}
		public function  wh_cat_add($parm1=null,$parm2=null)
		{
			$data['page_content'] =  $this->WH_CAT -> render_wh_cat_add();
			$data ["page_name"] = "WH_CAT_ADD";
			$this->load->view("header");
			$this->load->view("side_bar");
			$this->load->view("content",$data);
			$this->load->view("footer");
		}
		public function  wh_cat_edit($parm1=null,$parm2=null)
		{
			$data['page_content'] =  $this->WH_CAT -> render_wh_cat_update($parm1);
			$data ["page_name"] = "WH_CAT_UPDATE";
			$this->load->view("header");
			$this->load->view("side_bar");
			$this->load->view("content",$data);
			$this->load->view("footer");
		}

	public function wh_add($parm1=null,$parm2=null)
	{
		$data['page_name'] = "WH-ADD";
		$data['page_content']=$this->WH->render_wh_item_add();
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function wh_edit($opt , $ID )
	{
		$data['page_name'] = "WH-EDIT";
		$data['page_content']=$this->WH->format_wh_edit_form($ID);
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function wh_view($opt,$ID)
	{
		$data['page_content'] = $this->WH->render_wh_item_view($ID);
		$data['page_name'] = "WH-VIEW";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function wh_unlink($opt,$ID)
	{
		$data['page_content'] = $this->WH->render_wh_item_unlink($ID);
		$data['page_name'] = "WH-UNLINK";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");

	}
	public function wh_listing($opt,$ID)
	{
		$data['page_content'] = $this->WH->render_wh_listing($ID);
		$data['page_name'] = "WH-LISTING";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}

	public function change_bg($opt,$ID)
	{
		$data['page_content'] = $this->WH->render_wh_change_thumb($ID);
		$data['page_name'] = "WH-BG";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	########################################################################################################################
	# @@ STORE
	public function store_all($parm1,$parm2)
	{
		$data['page_content'] = $this->STORE->render_store_list($parm1,$parm2);
		$data['page_name'] = "STORE_LIST";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function store_add($parm1,$parm2)
	{
		$data['page_content'] = $this->STORE->render_store_add();
		$data['page_name'] = "STORE_ADD";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data);
		$this->load->View("footer");
	}
	public function store_edit($parm1,$parm2)
	{
		$data['page_content'] = $this->STORE->render_store_edit($parm1,$parm2);
		$data['page_name'] = "STORE_EDIT";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function store_unlink($parm1,$parm2)
	{
		$data['page_content'] = $this->STORE->render_store_unlink($parm1);
		$data['page_name'] = "STORE_UNLINK";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	########################################################################################
	# EXPT

	public function expt_all($parm1=null,$parm2=null)
	{
	$data['page_content'] = $this->EXPENSES->render_expt_list();
	$data['page_name'] = "EXPT_LIST";
	$this->load->view("header");
	$this->load->view("side_bar");
	$this->load->view("content",$data );
	$this->load->view("footer");
	}
	public function expt_add($parm1,$parm2)
	{
		$data['page_content'] = $this->EXPENSES->render_expt_add();
		$data['page_name'] = "EXPT_ADD";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function expt_edit($parm1,$parm2)
	{
		$data['page_content'] = $this->EXPENSES->render_expt_edit($parm1);
		$data['page_name'] = "EXPT_EDIT";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");

	}
	public function expt_unlink($parm1,$parm2)
	{
		$data['page_content'] = $this->EXPENSES->render_expt_unlink($parm1);
		$data['page_name'] = "EXPT_UNLINK";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}







	############################################################################################
	# EXPENSES

	public function expenses_all($parm1,$parm2)
	{
		$data['page_content'] = $this->EXPENSES->render_expenses_all($parm1,$parm2);
		$data['page_name'] = "EXPENSES_LIST";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function expenses_search ($parm1,$parm2)
	{
		$parm1 = (isset($_POST['start']) && strlen($_POST['start'])) ?   $_POST['start'] : $parm1;
		$parm2 = (isset($_POST['end']) && strlen($_POST['end'])) ?   $_POST['end'] : $parm2;
		$data['page_content'] = $this->EXPENSES->render_expenses_all($parm1,$parm2);
		$data['page_name'] = "EXPENSES_SEARCH";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function expenses_add($pa)
	{
		$data['page_content'] = $this->EXPENSES->render_expenses_add();
		$data['page_name'] = "EXPENSES_ADD";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function expenses_edit($id)
	{
		$data['page_content'] = $this->EXPENSES->render_expenses_edit($id);
		$data['page_name'] = "EXPENSES_EDIT";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function expenses_unlink($id)
	{
		$data['page_content'] = $this->EXPENSES->render_expenses_unlink($id);
		$data['page_name'] = "EXPENSES_UNLINK";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}



	#######################################################################################################
	public function meals_add()
	{
		$data['page_content'] = $this->MEALS->render_meal_add();
		$data['page_name'] = "MEALS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function meals_edit($id)
	{
		$data['page_content'] = $this->MEALS->render_meal_edit($id);
		$data['page_name'] = "MEALS_EDIT";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function meals_unlink($id)
	{
		$data['page_content'] = $this->MEALS->render_meal_unlink($id);
		$data['page_name'] = "MEALS_UNLINK";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function meals_all()
	{
		$data['page_content'] = $this->MEALS->render_meal_all();
		$data['page_name'] = "MEALS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function meals_change_bg($ID)
	{
		$data['page_content'] = $this->MEALS->render_change_bg($ID);
		$data['page_name'] = "MEALS_CHANGE_BG";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	#############################################################################################
	public function orders_add()
	{
		$data['page_content'] = $this->ORDERS->render_orders_add();
		$data['page_name'] = "ORDERS_ADD";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function orders_all($parm1=null,$parm2=null)
	{
		if(isset($_POST['start']) && isset($_POST['end']))
		{
			$parm1 = $_POST['start'];
			$parm2 = $_POST['end'];
		}
		$data['page_content'] = $this->ORDERS->render_orders_all($parm1,$parm2);
		$data['page_name'] = "ORDERS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}

	public function orders_info($ID)
	{
		$data['page_content'] = $this->ORDERS->render_orders_info($ID);
		$data['page_name'] = "ORDERS_INFO";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}

	public function orders_edit($ID)
	{
		$data['page_content'] = $this->ORDERS->render_orders_edit($ID);
		$data['page_name'] = "ORDERS_EDIT";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function orders_unlink($ID)
	{

		$data['page_content'] = $this->ORDERS->render_orders_unlink($ID);
		$data['page_name'] = "ORDERS_UNLINK";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	######################################################################################
	public function used_items_all($start=null,$end=null,$cat=null)
	{
		$start = ($start == null && isset($_POST['start'])) ? $_POST['start'] : $start;
		$end = ($start == null && isset($_POST['end'])) ? $_POST['end'] : $end;

		$data['page_content'] = $this->USED_ITEMS->render_used_items_all($start,$end,$cat);
		$data['page_name'] = "USED_ITEMS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function used_items_add()
	{
		$data['page_content'] = $this->USED_ITEMS->render_used_items_add();
		$data['page_name'] = "USED_ITEMS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function used_items_remove($id)
	{
		$data['page_content'] = $this->USED_ITEMS->render_used_items_unlink($id);
		$data['page_name'] = "USED_ITEMS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	#########################################################################
	public function jobs_all()
	{
		$data['page_content'] = $this->JOBS->render_jobs_all();
		$data['page_name'] = "JOBS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function jobs_add()
	{
		$data['page_content'] = $this->JOBS->render_jobs_add();
		$data['page_name'] = "JOBS_ADD";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function jobs_update($id)
	{

		$data['page_content'] = $this->JOBS->	render_job_update($id);
		$data['page_name'] = "JOBS_UPDATE";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");

	}
	public function jobs_unlink($id)
	{

		$data['page_content'] = $this->JOBS->	render_jobs_unlink($id);
		$data['page_name'] = "JOBS_UNLINK";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");

	}
	##########################################################
	public function workers_add()
	{
		$data['page_content'] = $this->WORKERS->render_workers_add();
		$data['page_name'] = "WORKERS_ADD";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}

	public function workers_edit($id)
	{
		$data['page_content'] = $this->WORKERS->render_workers_edit($id);
		$data['page_name'] = "WORKERS_EDIT";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function workers_info($id,$begin=null,$end=null)
	{
		if(isset($_POST['start']) && isset($_POST['end']))
		{
			$begin = $_POST['start'];
			$end = $_POST['end'];
		//	var_dump($_POST);
		}
		$data['page_content'] = $this->WORKERS->render_workers_info($id,$begin,$end);
		$data['page_name'] = "WORKERS_INFO";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function workers_unlink($id)
	{
		$data['page_content'] = $this->WORKERS->render_workers_unlink($id);
		$data['page_name'] = "WORKERS_UNLINK";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function workers_all()
	{
		$data['page_content'] = $this->WORKERS->render_workers_all();
		$data['page_name'] = "WORKERS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
######################################################
	public function workers_debits_all($start=null,$end=null)
	{
		if(isset($_POST['start']) && isset($_POST['end']))
		{
			$start = $_POST['start'];
			$end = $_POST['end'];
		//	var_dump($_POST);
		}
		$data['page_content'] = $this->WORKERS_DEBITS->render_all_debits($start,$end);
		$data['page_name'] = "WORKERS_DEBITS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function workers_debits_add()
	{
		$data['page_content'] = $this->WORKERS_DEBITS->render_add_debits();
		$data['page_name'] = "WORKERS_DEBITS_ADD";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function workers_debits_unlink($ID)
	{
		$data['page_content'] = $this->WORKERS_DEBITS->render_unlink_debits($ID);
		$data['page_name'] = "WORKERS_DEBITS_UNLINK";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	#########################################################
	public function store_debits_all($start=null,$end=null)
	{
		if(isset($_POST['start']) && isset($_POST['end']))
		{
			$start = $_POST['start'];
			$end = $_POST['end'];
		//	var_dump($_POST);
		}
		$data['page_content'] = $this->STORE_DEBITS->render_all_debits($start,$end);
		$data['page_name'] = "STORE_DEBITS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function store_debits_add()
	{
		$data['page_content'] = $this->STORE_DEBITS->render_add_debits();
		$data['page_name'] = "STORE_DEBITS_ADD";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function store_debits_update($id)
	{
		$data['page_content'] = $this->STORE_DEBITS->render_edit_debits($id);
		$data['page_name'] = "WORKERS_DEBITS_UPDATE";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function store_debits_unlink($ID)
	{
		$data['page_content'] = $this->STORE_DEBITS->render_unlink_debits($ID);
		$data['page_name'] = "STORE_DEBITS_UNLINK";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	public function store_debits_pay($ID)
	{
		$data['page_content'] = $this->STORE_DEBITS->render_pay_debits($ID);
		$data['page_name'] = "STORE_DEBITS_PAY";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}
	########################################################################33
	public function reports_all($start=null,$end=null)
	{
		if(isset($_POST['start']) && isset($_POST['end'])){
			$start  =$_POST['start'];
			$end = $_POST['end'];
		}
		$data['page_content'] = $this->REPORTS->render_reports_all($start,$end);
		$data['page_name'] = "REPORTS_ALL";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data );
		$this->load->view("footer");
	}

	###########################################################
#####################################
	public function edit($ID)
	{

	}
	public function remove($ID)
	{


	}

}
?>
