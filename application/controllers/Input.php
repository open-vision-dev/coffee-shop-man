<?php

class Input extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("MyTables","tables");
		$this->load->model("STORE");
		$this->load->library("upload");
		$this->load->library("image_lib");
		$this->load->helper('file');
	}
	public function index ($mode,$page,$id)
	{
//		echo " mode   is $mode page is $page ";
	//	die();
	//	echo $page;
		//die();

		$modes = array("edit","update","unlink","change_bg","add");
		$pages = array("wh","wh_cat","store","meals","orders","ordersinfo","jobs","store_debits","workers_debits","workers","used_items");
		//var_dump($mode,$page,$id);
		(!in_array($page,$pages,TRUE)) ? exit(redirect("/")) : null;
		(!in_array($mode,$modes,TRUE)) ?  exit(redirect("/")) : null;
		$this->$mode($page,$id);

	}
	public function add($page)
	{
	//	echo "PULL";

		$page = strtoupper($page);
		if($page == "WH")
		{
			$this->add_wh();
		}else if(strtoupper($page) == "WH_CAT")
		{
			$this->add_wh_cat();

		}
		else if(strtoupper($page) == "STORE")
		{
			$this->add_store();
		}
		else if(strtoupper($page) == "EXPT")
		{
			$this->add_expt();
		}
		else if(strtoupper($page) == "EXPENSES")
		{
			$this->add_expenses();
		}
		else if(strtoupper($page) == "MEALS")
		{
			$this->add_meals();
		}
	//	$T  = mb_strtolower("add_$page");
	//	(method_exists($this->$T)) ? $T() : null;


	}
	public function edit($page,$id)
	{

		if($page == "wh")
		{
				$this->edit_wh($id);
		} //end of wh
		else if($page =="wh_cat")
		{
			$this->edit_wh_cat($id);
		}else if($page == "store")
		{
			$this->edit_store($id);
		}
		else if($page == "expt")
		{

			$this->edit_expt($id);
		}
		else if($page == "expenses")
		{
			$this->edit_expenses($id);
		}
		else if($page == "meals")
		{
			$this->edit_meals($id);
		}
	}
	public function unlink($page,$id)
	{
		if(strtoupper($page) == "WH")
		{
			$this->unlink_wh($id);

		}else if(strtoupper($page)=="WH_CAT")
		{
				$this->unlink_wh_cat($id);
		}
		else if(strtoupper($page)=="STORE")
		{
			$this->unlink_store($id);
		}
		else if(strtoupper($page)=="EXPT")
		{
			$this->unlink_expt($id);
		}
		else if(strtoupper($page)=="EXPENSES"){
				$this->unlink_expenses($id);
		}else if(strtoupper($page) == "MEALS")
		{
			$this->unlink_meals($id);
		}
	}

	/*#######################################################################################
	*	@@ WH SECTION
	*
	*
	*
	*/#######################################################################################
	public function add_wh()
	{
		//	echo "<pre class='code'><code>" . output_parms("POST") . "</code></pre>";
			$this->form_validation->set_rules("ARNAME" ,"Arabic NAME" ,"min_length[3]|required");
			$this->form_validation->set_rules("ENNAME" ,"English Name " ,"min_length[3]|required");
			$this->form_validation->set_rules("CAT" ,"CATEGORY  " , "min_length[1]|required");
			$this->form_validation->set_rules("WUNIT" ," Wight Unit", "min_length[1]|required");
			$this->form_validation->set_rules("WUNITSIZE","Weight Unit Size " , "min_length[1]|required");
			$this->form_validation->set_rules("EXPIRING","Expiring " , "min_length[1]|required");


		 	$ok = $this->form_validation->run ();
			if($ok)
			{
				$ARNAME=$this->input->post("ARNAME",TRUE);
				$ENNAME=$this->input->post("ENNAME",TRUE);
				$CAT=$this->input->post("CAT",TRUE);
				$WUNIT=$this->input->post("WUNIT",TRUE);
				$WUNITSIZE=$this->input->post("WUNITSIZE",TRUE);
				$EXPIRING=$this->input->post("EXPIRING",TRUE);
				$PIC = image_upload_to_hex_thumb("PIC",150,150);
				$result =  $this->tables->add_wh($ARNAME,$ENNAME,$WUNIT,$WUNITSIZE,$EXPIRING,$PIC,$CAT);
				if($result)
				{
					redirect("Admin/wh/view/$result");
				}
			}else{
				#TODO
			}
	}
	public function edit_wh($id)
	{
		$this->form_validation->set_rules('EN_NAME', 'English name', 'required|min_length[3]');
		$this->form_validation->set_rules('AR_NAME', 'Unit Size', 'required|min_length[3]');
		$this->form_validation->set_rules('WUNIT', 'Unit NAME', 'required|min_length[1]');
		$this->form_validation->set_rules('WUNIT_SIZE', 'Unit Size', 'required|min_length[1]');
		$this->form_validation->set_rules('EXPIRING', 'EXPIRING', 'required|min_length[1]');
		$this->form_validation->set_rules('CATID', 'CAT ', 'required|min_length[1]');
		$ok=$this->form_validation->run();
	   if($ok)
	   {
		   $EN_NAME=$this->input->post("EN_NAME");
		   $AR_NAME=$this->input->post("AR_NAME");
		   $WUNIT=$this->input->post("WUNIT");
		   $WUNIT_SIZE=$this->input->post("WUNIT_SIZE");
		   $EXPIRING=$this->input->post("EXPIRING");
		   $CATID=$this->input->post("CATID");
		   $pass=$this->tables->update_wh($id,$EN_NAME,$AR_NAME,$WUNIT,$WUNIT_SIZE,$EXPIRING,$CATID);
		   if($pass)
		   {
			   redirect(site_link_to("/Admin/wh/view/$id"));
		   }else{
			   redirect(site_link_to("/Admin/wh/edit/$id"));
		   }
	   }
	   else
	   {
		   redirect("Admin/wh/edit/$id");
   //	var_dump($_POST);
	   #@TODO
	   }
	}
	public function unlink_wh($id)
	{
		$this->form_validation->set_rules("pass" ," Password Required ", "min_length[1]|required");
		if($this->form_validation->run()==TRUE)
		{
			$pass=$this->input->post("pass",TRUE);
			$pass_validation = $this->tables->auth_action($pass);
			($pass_validation)  ?  null  :  redirect("/Admin/wh/unlink/$id");
			$store_count = $this->tables->get_store_count_by_wid($id);
			$used_count = $this->tables->get_unused_items_by_wid($id);
			if($store_count < 1 && $used_count < 1){
			//	echo "unlink t 1";
						$ok = $this->tables->unlink_wh($id);

					 ($ok) ? redirect("Admin/wh/all") : redirect("admin/wh/unlink/$id"); ;
			}else{
				//	echo "unlink type 2";
				//	die();
					$pass1 = $this->tables->unlink_store_by_wid($id);
					$pass2 = $this->tables->unlink_used_items_by_id($id);
					$pass3 = $this->tables->unlink_wh($id);

					($pass1 || $pass2 || $pass3) ?   redirect("Admin/wh/all") : redirect("admin/wh/unlink/$id");
			}


		}
		else
		{
					redirect(site_link_to("/Admin/wh/unlink/$id"));
		}
	}
	/*#######################################################################################
	*	@@ EXPT SECTION
	*
	*
	*
	*/#######################################################################################
	public function add_wh_cat()
	{
		$this->form_validation->set_rules("NAME" ," ", "min_length[1]|required");
		$NAME=$this->input->post("NAME",TRUE);
		if($this->form_validation->run())
		{

			$ok =$this->tables-> add_wh_cat($NAME);
			($ok) ?      redirect("/Admin/wh_cat/") : redirect("/Admin/wh_cat/add");
		}
		#TODO
	}
	public function edit_whcat($id)
	{
		//echo output_parms();
		$this->form_validation->set_rules("NAME" ," ", "min_length[1]|required");
		if($this->form_validation->run()!= FALSE){
						$NAME=$this->input->post("NAME",TRUE);
						$ok = 	$this->tables->update_wh_cat($id,$NAME);
						($ok) ? redirect("/Admin/wh_cat") : redirct("/Admin/wh_cat/update/$id");
		}
	}
	public function unlink_whcat($id)
	{
		#TODO
		$ok = $this->tables->unlink_wh_cat($id);
		($ok) ?  redirect("/Admin/wh_cat/") : redirect("/Admin/wh_cat/unlink/$id/");
	}

	/*#######################################################################################
	*	@@ STORE SECTION
	*
	*
	*
	*/#######################################################################################
	public function add_store(
	){
	$this->form_validation->set_rules("wid" ,"  اسم المنتج", "min_length[1]|required");
	$this->form_validation->set_rules("qty" ,"  الكمية", "min_length[1]|required");
	$this->form_validation->set_rules("price" ,"  السعر", "min_length[1]|required");
	$this->form_validation->set_rules("expdt" ,"  تاريخ الانتهاء", "min_length[1]|required");
	$this->form_validation->set_rules("tp" ,"  اجمالي السعر", "min_length[1]|required");
	if($this->form_validation->run())
		{
		$wid=$this->input->post("wid",TRUE);
		$qty=$this->input->post("qty",TRUE);
		$price=$this->input->post("price",TRUE);
		$expdt=$this->input->post("expdt",TRUE);
		$tp=$this->input->post("tp",TRUE);
		$ok = $this->tables-> add_store($wid,$qty,$price,$tp,$expdt);
		($ok) ?  redirect("/Admin/store/all")  : redirect("/Admin/store/add");
		}
	else
		{
		$data['page_content'] = $this->STORE->render_store_add();
		$data['page_name'] = "STORE_ADD";
		$this->load->view("header");
		$this->load->view("side_bar");
		$this->load->view("content",$data);
		$this->load->View("footer");
		}
	}
	public function edit_store($ID
		)
		{

			$this->form_validation->set_rules("QTY" ,"  ", "min_length[1]|required");
			$this->form_validation->set_rules("PRICE" ,"  ", "min_length[1]|required");
			$this->form_validation->set_rules("TP" ,"  ", "min_length[1]|required");
			$this->form_validation->set_rules("EXPDT" ,"  ", "min_length[1]|required");
			if($this->form_validation->run())
			{
				$QTY=$this->input->post("QTY",TRUE);
				$PRICE=$this->input->post("PRICE",TRUE);
				$TP=$this->input->post("TP",TRUE);
				$EXPDT=$this->input->post("EXPDT",TRUE);
				$ok = $this->tables->update_store($ID,$QTY,$PRICE,$TP,$EXPDT);
					(!$ok )? redirect("/Admin/store/edit/$ID") :	redirect("/Admin/store/all") ;
			}else{
				redirect("/Admin/store/edit/$ID");
			}

		}
		public function unlink_store($id)
		{
			if(isset($id))
			{
				$ok = $this->tables->unlink_store_by_id($id);
				($ok) ? redirect("/Admin/store/all") : redirect("/Admin/store/unlink/$id");
			}else{
				#TODO
			}
		}
	/*#######################################################################################
	*	@@ EXPT SECTION
	*
	*
	*
	*/#######################################################################################
	public function add_expt()
	{
	$this->form_validation->set_rules("name" ,"  ", "min_length[1]|required");
	$this->form_validation->set_rules("pri" ,"  ", "min_length[1]|required");
	if($this->form_validation->run())
		{
		$name=$this->input->post("name",TRUE);
		$pri=$this->input->post("pri",TRUE);
		$ok = $this->tables->add_expt($name,$pri);
		($ok) ? redirect("/Admin/expt/all") : redirect("/Admin/expt/add");
		}
		redirect("/Admin/expt/add");
	}
	public function edit_expt($id)
	{
		$this->form_validation->set_rules("name" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("pri" ,"  ", "min_length[1]|required");
		if($this->form_validation->run()){

		$name=$this->input->post("name",TRUE);
		$pri=$this->input->post("pri",TRUE);
		$ok = $this->tables->update_expt($id,$name,$pri);
		($ok) ?  redirect("/Admin/expt/all") : redirect("/Admin/expt/edit/$id");
		}
		#TODO

	}

	public function unlink_expt($id)
	{
		$ok = $this->tables->unlink_expt($id);
		($ok ) ? redirect("/Admin/expt/all") : redirect("/Admin/expt/unlink/$id");
	}
	public function unlink_expenses($id)
	{
	//	echo "id = > ".$id;

		$ok = $this->tables->unlink_expenses($id);
//		echo "<pre>";
//		die(var_dump($this->db));
//
		($ok) ?  redirect("/Admin/expenses/all") : redirect("/Admin/expenses/unlink/$id");
	}
	/*#######################################################################################
	*	@@ EXPENSES SECTION
	*
	*
	*
	*/#######################################################################################
	public function  add_expenses()
	{
		echo output_parms();

	$this->form_validation->set_rules("NAME" ,"  ", "min_length[1]|required");
	$this->form_validation->set_rules("expt" ,"  ", "min_length[1]|required");
	$this->form_validation->set_rules("ِamt" ,"  ", "min_length[1]|required");
	if($this->form_validation->run())
		{

		$name=$this->input->post("NAME",TRUE);
		$expt=$this->input->post("expt",TRUE);
		$ِamt=$this->input->post("ِamt",TRUE);

		$ok = $this->tables->add_expenses($name,$expt,$amt);
		($ok) ? redirect("/Admin/expenses/all") : redirect("/Admin/expenses/add");
		}else
		{
		redirect("/Admin/expenses/add");
		}

	}
	public function edit_expenses($id)
	{
		$this->form_validation->set_rules("name" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("amt" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("expt" ,"  ", "min_length[1]|required");
		if($this->form_validation->run())
		{

		$name=$this->input->post("name",TRUE);
		$amt=$this->input->post("amt",TRUE);
		$expt=$this->input->post("expt",TRUE);
		$ok = $this->tables->update_expenses($id,$name,$expt,$amt);
		//var_dump($this->tables->db);
	//	echo "<pre>";
	//	var_dump($this->tables->db);

		//
		($ok) ? redirect("/Admin/expenses/all") : redirect("/Admin/expenses/edit/$id");
		}
		redirect("/Admin/expenses/edit/$id");

	}
	/*#######################################################################################
	*	@@ EXPENSES SECTION
	*
	*
	*
	*/#######################################################################################

	public function add_meals()
	{

	$this->form_validation->set_rules("NAME" ,"  ", "min_length[1]|required");
	$this->form_validation->set_rules("WHID" ,"  ", "min_length[1]|required");

	$this->form_validation->set_rules("PRICE" ,"  ", "min_length[1]|required");
	$this->form_validation->set_rules("MTYPE" ,"  ", "min_length[1]|required");
	if($this->form_validation->run()){
		$NAME=$this->input->post("NAME",TRUE);
		$WHID=$this->input->post("WHID",TRUE);
		$PIC =image_upload_to_hex_thumb('PIC',150,150);
		$PRICE=$this->input->post("PRICE",TRUE);
		$MTYPE=$this->input->post("MTYPE",TRUE);
		$ok  = $this->tables->add_meals($MTYPE,$NAME,$PIC,$PRICE,$WHID);
		($ok) ? redirect("/Admin/meals/all") : redirct("/Admin/meals/add");
	}else{
		redirct("/Admin/meals/add");
	}

	}
	public function edit_meals($ID)
	{

		//echo output_parms();
		$this->form_validation->set_rules("NAME" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("MTYPE" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("PRICE" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("WHID" ,"  ", "min_length[1]|required");
		if($this->form_validation->run())
		{

			$NAME=$this->input->post("NAME",TRUE);
			$MTYPE=$this->input->post("MTYPE",TRUE);
			$PRICE=$this->input->post("PRICE",TRUE);
			$WHID=$this->input->post("WHID",TRUE);
			$ok  = $this->tables->update_meals($ID,$MTYPE,$NAME,$PRICE,$WHID);
			($ok) ? redirect("/Admin/meals/all/") : redirect("/Admin/meals/edit/$ID");
		}else{
			redirect("/Admin/meals/edit/$ID");
		}
	}
	public function meals_change_bg($ID)
	{

		$PIC = image_upload_to_hex_thumb('PIC');
		$ID = esc($ID);
		if($PIC != null & $ID != null)
		{
			$ok = $this->tables->update_meals_pic($ID,$PIC);
			//die(var_dump($this->tables->db));
				($ok) ? redirect("/Admin/meals/all") : redirect("/Admin/meals/edit/$ID");
		}

	//	redirect("/Admin/meals/edit/$ID");
	}
	public function unlink_meals($ID)
	{
		$ok = $this->tables->unlink_meals($ID);
	//	die(var_dump($this->tables->db));
		($ok) ?  redirect("/Admin/meals/all") : redirect("/Admin/meals/unlink/$ID");
	}
	/*#######################################################################################
	*	@@ MISC SECTION
	*
	*
	*
	*/#######################################################################################

	public function change_bg($page,$id)
	{
		$page = strtoupper($page);
		if($page == "WH")
		{
			$image = image_upload_to_hex_thumb("PIC",150,150);
			if($image != null)
			{
					$data = $this->tables -> get_wh_by_id($id);
					if(!is_null($data))
					{
					$data=  array(
						"PIC" => $image
					);
					$this->db->where("ID",$id);
					$ok = 	$this->db->update("WH",$data);
					if($ok){
						redirect("/Admin/wh/view/$id");
					}else{
						redirect("/Admin/wh/change_bg/$id");
					}
					}
			}
		}else if($page == "MEALS")
		{

			$this->meals_change_bg($id);
		}

		//redirect("/Admin/wh.change/$id");
	}




}

?>
