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

		$modes = array("edit","update","unlink","change_bg","add","pay");
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
		else if(strtoupper($page) == "ORDERS")
		{
			$this->add_orders();
		}else if(strtoupper($page) == "USED_ITEMS")
		{
			$this->add_used_items();
		}
		else if(strtoupper($page) == "JOBS")
		{
			$this->add_jobs();
		}
		else if(strtoupper($page) == "WORKERS")
		{
			$this->add_workers();
		}
		else if(strtoupper($page) == "WORKERS_DEBITS")
		{
			$this->add_workers_debits();
		}
		else if(strtoupper($page) == "STORE_DEBITS")
		{
			$this->add_store_debits();
		}

	//	$T  = mb_strtolower("add_$page");
	//	(method_exists($this->$T)) ? $T() : null;


	}
	public function pay($page,$id)
	{
		if(strtoupper($page) =="STORE_DEBITS")
		{
			$this->pay_store_debits($id);
		}
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
		else if($page == "jobs")
		{
			$this->edit_jobs($id);
		}
		else if($page == "workers")
		{
			$this->update_workers($id);
		}
		else if($page == "store_debits")
		{
			$this->edit_store_debits($id);
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
		else if(strtoupper($page) == "ORDERS")
		{
			$this->unlink_orders($id);
		}
		else if(strtoupper($page)== "USED_ITEMS")
		{
				$this->unlink_used_items($id);
		}
		else if(strtoupper($page)== "JOBS")
		{
				$this->unlink_jobs($id);
		}
		else if(strtoupper($page)== "WORKERS")
		{
				$this->unlink_workers($id);
		}
		else if(strtoupper($page)== "WORKERS_DEBITS")
		{
				$this->unlink_workers_debits($id);
		}

		else if(strtoupper($page) == "STORE_DEBITS")
		{
			$this->unlink_store_debits($id);
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
	$this->form_validation->set_rules("debit_from_values" ,"   قيمة المديونية", "min_length[0]");
	if($this->form_validation->run())
		{

		$wid=$this->input->post("wid",TRUE);
		$item = $this->tables->get_wh_by_id($wid);
		$name = $item['ARNAME'] . ' - ' . $item['ENNAME'];
		$qty=$this->input->post("qty",TRUE);
		$price=$this->input->post("price",TRUE);
		$expdt=$this->input->post("expdt",TRUE);
		$tp=$this->input->post("tp",TRUE);
		$EXP_AMT = 0;
		$debit_form = json_decode($this->input->post("debit_from_values"));
		if($debit_form->amt > 0)
		{
			$AMT = $debit_form -> amt;
			$LENDER = $debit_form -> lender;
			$PAYDATE = $debit_form -> paydate;
			$DDESC = $debit_form-> ddesc;
			if($tp == $AMT)
			{
				$EXP_AMT = 0;
				$ok = $this->tables-> add_store($wid,$qty,$price,$tp,$expdt);
				$ok2 = $this->tables->add_store_debits($LENDER,$AMT,$DDESC,$PAYDATE);
				($ok && $ok2 ) ?  redirect("/Admin/store/all")  : redirect("/Admin/store/add");

				// no expenses to be add
			}else if($tp != $AMT  )
			{
				$EXP_AMT = $tp - $AMT;
				$ok = $this->tables-> add_store($wid,$qty,$price,$tp,$expdt);
				$ok2 = $this->tables->add_store_debits($LENDER,$AMT,$DDESC,$PAYDATE);
				$ok3 = $this->tables->add_expenses($name,4,$EXP_AMT,"تم اضافة مشتروات");
				($ok && $ok2 && $ok3) ?  redirect("/Admin/store/all")  : redirect("/Admin/store/add");

			}


		}else{
			$EXP_AMT = $TP;
		}
		$ok = $this->tables-> add_store($wid,$qty,$price,$tp,$expdt);
				$this->tables->add_expenses($name,4,$tp,"تم اضافة مشتروات");
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
	//	echo output_parms();

	$this->form_validation->set_rules("NAME" ,"  ", "min_length[1]|required");
	$this->form_validation->set_rules("expt" ,"  ", "min_length[1]|required");
	$this->form_validation->set_rules("amt" ,"  ", "min_length[1]|required");
	if($this->form_validation->run())
		{

		$name=$this->input->post("NAME",TRUE);
		$expt=$this->input->post("expt",TRUE);
		$amt=$this->input->post("amt",TRUE);

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
	*	@@ ORDERS SECTION
	*
	*
	*
	*/#######################################################################################
	public function add_orders()
	{

		$this->form_validation->set_rules("JSCartData" ," ", "min_length[1]|required");
		if($this->form_validation->run()){
		$JSCartData=json_decode($this->input->post("JSCartData",TRUE));
		$total  =0;
		foreach($JSCartData as $cartItem)
			{
				//var_dump($cartItem)
				$name = $cartItem -> NAME;
				$id = $cartItem->ID;
				$price = $cartItem->PRICE;
				$qty = $cartItem->QTY;
				$tp  = $price * $qty;
				$total += $tp;
			}
		$OID = $this->tables->add_orders($total);
		$errors = 0;

		foreach($JSCartData as $cartItem)
			{

				$MID = $cartItem->ID;
				$PRICE = $cartItem->PRICE;
				$QTY = $cartItem->QTY;
				$TP  = $price * $qty;
				$ok = $this->tables->add_orderinfo($OID,$MID,$QTY,$PRICE,$TP);
				$mealData = $this->tables->get_meals_by_id($MID)[0];
				($mealData['WHID'] > -1 ) ? $this->tables->add_useditems($mealData['WHID'],$QTY) : null;
				$errors += ($ok) ?  0 : 1;

			}
			($errors == 0 ) ? redirect("/Admin/orders/info/$OID") : redirect("/Admin/orders/add/");
		}
		else{
			redirect("/Admin/orders/add/");
		}
	}
	public function unlink_orders($ID)
	{
		$ok = $this->tables->unlink_orders($ID);
		($ok) ?  redirect("/Admin/orders/all") : redirect("Admin/orders/unlink/$ID");
	}
	/*#######################################################################################
	*	@@ USED_ITEMS
	*
	*
	*
	*/#######################################################################################
	public function add_used_items()
	{

		$this->form_validation->set_rules("WHID" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("QTY" ,"  ", "min_length[1]|required");

		if($this->form_validation->run())
		{
			$WHID=$this->input->post("WHID",TRUE);
			$QTY=$this->input->post("QTY",TRUE);
			$ok = $this->MyTables->add_useditems($WHID,$QTY);
			($ok) ? redirect("/Admin/used_items/all") : redirect("/Admin/used_items/add");
		}else{
			redirect("/Admin/used_items/add");
		}
	}
	public function unlink_used_items($id)
	{
		if(isset($id) && strlen($id) >= 1)
		{
			$ok = $this->tables->unlink_used_items_by_id($id);
			($ok) ? redirect("/Admin/used_items/all" ) : redirect("/Admin/unlink/$id");
		}
	}
	/*#######################################################################################
	*	@@ JOBS SECTION
	*
	*
	*
	*/#######################################################################################
	public function add_jobs()
	{

		 $this->form_validation->set_rules("JTITLE" ," ", "min_length[1]|required");
		 $this->form_validation->set_rules("SALARY" ," ", "min_length[1]|required");
		 $this->form_validation->set_rules("PRI" ," ", "min_length[1]|required");
		 if($this->form_validation->run())
		 {
			 $JTITLE=$this->input->post("JTITLE",TRUE);
			 $SALARY=$this->input->post("SALARY",TRUE);
			 $PRI=$this->input->post("PRI",TRUE);
			 $ok =  $this->tables->add_jobs($JTITLE,$SALARY,$PRI);
			 ($ok ) ?  redirect("/Admin/jobs/all") : redirect("/Admin/jobs/add");
		 }

	}
	public function edit_jobs($id)
	{
		$this->form_validation->set_rules("JTITLE" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("SALARY" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("PRI" ,"  ", "min_length[1]|required");
		if($this->form_validation->run()){

			$JTITLE=$this->input->post("JTITLE",TRUE);
			$SALARY=$this->input->post("SALARY",TRUE);
			$PRI = $this->input->post("PRI",TRUE);
			$ok = $this->tables->update_jobs($id,$JTITLE,$PRI,$SALARY);
			($ok) ? redirect("/Admin/jobs/all") : redirect("/Admin/jobs/edit/$id");
		}
		redirect("/Admin/jobs/edit/$id");

	}
	public function unlink_jobs($id)
	{
		$ok = $this->tables->unlink_jobs($id);
		($ok) ? redirect("/Admin/jobs/all") : redirect("/Admin/jobs/unlink/$id");
	}
	/*#######################################################################################
	*	@@ WORKERS_ALL SECTION
	*
	*
	*
	*/#######################################################################################
	public function add_workers()
	{
		$this->form_validation->set_rules("NAME" ," ", "min_length[1]|required");
		 $this->form_validation->set_rules("TEL1" ," ", "min_length[1]|required");
		  $this->form_validation->set_rules("TEL2" ," ", "min_length[1]|required");
		  $this->form_validation->set_rules("JID" ," ", "min_length[1]|required");
		  if($this->form_validation->run()){
		   $NAME=$this->input->post("NAME",TRUE);
		   $TEL1=$this->input->post("TEL1",TRUE);
		   $TEL2=$this->input->post("TEL2",TRUE);
		   $JID = $this->input->post("JID",TRUE);
		   $ok = $this->tables->add_workers($NAME,$TEL1,$TEL2,$JID);

		   ($ok) ? redirect("/Admin/workers/all") : redirect("/Admin/workers/add");

	   }else{

	   }
	}
	public function update_workers($id)
	{
		$this->form_validation->set_rules("NAME" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("JID" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("TEL1" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("TEL2" ,"  ", "min_length[1]|required");
		if($this->form_validation->run())
		{
			$NAME=$this->input->post("NAME",TRUE);
			$JID=$this->input->post("JID",TRUE);
			$TEL1=$this->input->post("TEL1",TRUE);
			$TEL2=$this->input->post("TEL2",TRUE);
			$ok = $this->tables->update_workers($id,$NAME,$TEL1,$TEL2,$JID);
			($ok) ? redirect("/Admin/workers/all" ) : redirect("Admin/workers/edit/$id");
		}
		else{
			redirect("/Admin/workers/edit/$id");
		}
	}
	public function unlink_workers($id)
	{
		$ok = $this->tables->unlink_workers($id);
		($ok) ? redirect("/Admin/workers/all") : redirect("/Admin/workers/unlink/$id");
	}

	/*#######################################################################################
	*	@@ WORKERS_DEBITS SECTION
	*
	*
	*
	*/#######################################################################################
	public function add_workers_debits()
	{
			$this->form_validation->set_rules("WID" ," ", "min_length[1]|required");
			 $this->form_validation->set_rules("PRICE" ," ", "min_length[1]|required");
			 if($this->form_validation->run()){
			 $WID=$this->input->post("WID",TRUE);
			 $NAME =  $this->tables->get_workers_by_id($WID)[0]['NAME'];
			  $PRICE=$this->input->post("PRICE",TRUE);
			  $ok = $this->tables->add_workers_debits($WID,$PRICE);
			  $ok2 = ($ok) ?  $this->tables->add_expenses($NAME,1,$PRICE,"تم اضافة سلفية جديدة") : FALSE;
			  ($ok && $ok2) ? redirect("/Admin/workers_debits/all") : redirect("/Admin/workers_debit/add");
		 }else{
			 redirect("/Admin/workers_debits/add");
		 }
	}
	public function unlink_workers_debits($ID)
	{
		$ok  = $this->tables->unlink_workers_debits($ID);
		($ok ) ? redirect("/Admin/workers_debits/all") : redirect("/Admin/workers_debits/unlink/$ID");
	}
	/*#######################################################################################
	*	@@ STORE DEBITS SECTION
	*
	*
	*
	*/#######################################################################################
	public function add_store_debits()
	{
		  $this->form_validation->set_rules("LENDER" ," ", "min_length[1]|required");
		  $this->form_validation->set_rules("AMT" ," ", "min_length[1]|required");
		  $this->form_validation->set_rules("ddesc" ," ", "min_length[1]|required");
		  $this->form_validation->set_rules("paydate" ," ", "min_length[1]|required");

		  if($this->form_validation->run()){
		   $LENDER=$this->input->post("LENDER",TRUE);
		   $AMT=$this->input->post("AMT",TRUE);
		   $ddesc=$this->input->post("ddesc",TRUE);
		   $paydate=$this->input->post("paydate",TRUE);

		   //var_dump($_POST);
		   //die();
		  $ok =  $this->tables->add_store_debits($LENDER,$AMT,$ddesc,$paydate);
		  ($ok) ? redirect("/Admin/store_debits/all") : redirect("/Admin/store_debits/add");

	   }
	   redirect("/Admin/store_debits/add");
	}

	public function edit_store_debits($id)
	{

		$this->form_validation->set_rules("LENDER" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("AMT" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("DDESC" ,"  ", "min_length[1]|required");
		$this->form_validation->set_rules("PAYDATE" ,"  ", "min_length[1]|required");
		if($this->form_validation->run())
		{
			$OLDAMT = $this->tables->get_store_debits_by_id($id)[0]['AMT'];

			$LENDER=$this->input->post("LENDER",TRUE);
			$AMT=$this->input->post("AMT",TRUE);
			$DDESC=$this->input->post("DDESC",TRUE);
			$PAYDATE=$this->input->post("PAYDATE",TRUE);
			$NEWAMT = $OLDAMT - $AMT;
			$ok = $this->tables->update_store_debits($id,$LENDER,$AMT,$DDESC,$PAYDATE);
		//	$this->add_expenses($NAME,2,$AMT,"تم اغلاق المديوينة");
			$ok2 =$this->tables->add_expenses($LENDER,2,$NEWAMT,"تم سداد جزء من المديونية ");
			($ok&&$ok2) ? redirect("/Admin/store_debits/all") : redirect("/Admin/store_debits/edit/$id");
		}
		redirect("/Admin/store_debits/edit/$id");
	}
	public function unlink_store_debits($id)
	{
		$ok = $this->tables->unlink_store_debits($id);
		($ok) ? redirect("/Admin/store_debits/all") : redirect("/Admin/store_debits/unlink/$id");
	}
	public function pay_store_debits($id)
	{
			$ok = $this->tables->close_store_debits($id);
			($ok) ? redirect("/Admin/store_debits/all") : redirect("/Admin/store_debits/pay/$id");
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
