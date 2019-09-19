<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class MyTables extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
			//$this->load->library('session','sess');
		}


		//      @@ ADDERS    ##################################################################################
		public function add_wh($ARNAME,$ENNAME,$WUNIT,$WUNITSIZE,$EXPIRING,$PIC,$CAT)
		{
			$ARNAME=$this->db->escape_str($ARNAME);
			$ENNAME=$this->db->escape_str($ENNAME);
			$WUNIT=$this->db->escape_str($WUNIT);
			$WUNITSIZE=$this->db->escape_str($WUNITSIZE);
			$EXPIRING=$this->db->escape_str($EXPIRING);
			$PIC=$this->db->escape_str($PIC);
			$CAT=$this->db->escape_str($CAT);
			$DATA = array(
				"ARNAME"=>$ARNAME,
				"ENNAME"=>$ENNAME,
				"WUNIT"=>$WUNIT,
				"WUNITSIZE"=>$WUNITSIZE,
				"Expiring"=>$EXPIRING,
				"PIC"=>$PIC ,
				"CAT"=>$CAT ,

				"RMD" => FALSE
			);

			$ok=$this->db->insert("WH",$DATA);
		return	($ok != false ) ?   $this->db->insert_id() : FALSE;
		}
		public function add_wh_cat($NAME)
		{
			$NAME = $this->db->escape_str($NAME);
			$data=array("NAME"=>$NAME,"RMD"=>FALSE);
			$ok = $this->db->insert("WH_CAT",$data);

			return $ok;
		}
		public function add_store($WID,$QTY,$PRICE,$TP,$EXPDT)
		{

			$parms = array(
				"ID" => NULL,
				"WID" => $WID ,
				"QTY" =>$QTY ,
				"PRICE" => $PRICE ,
				"TP" => $TP ,
				"EXPDT" => $EXPDT ,
				"DT" => date("Y-m-d h:i:s") ,
				"RMD" => FALSE
		 );
		 return	 $this->db->insert("STORE",$parms);

		}
		public function add_expt(
			$name,
			$pri
			)
			{
			$name = $this->db->escape_str($name);
			$pri = $this->db->escape_Str($pri);
			$parms = array(
				"ID" => NULL,
				"NAME" => $name,
				"PRI" => $pri

			);
			return $this->db->insert("EXPT",$parms);
			}
			public function add_expenses($name,$expt,$amt)
			{
				$parms = array(
					"ID" => NULL,
					"NAME" => $this->db->escape_str($name) ,
					"EXPT" => $this->db->escape_str($expt) ,
					"AMT" => $this->db->escape_str($amt) ,
					"DT"=> date("Y-m-d h:i:s") 	,
					"RMD" => FALSE,
					"INFO"=>NULL

				);
				var_dump($parms);
				$ok =  $this->db->insert(
						"EXPENSES" ,
						$parms
				);
				return ($ok == true)	 ? $this->db->insert_id() : FALSE;

			}
			public function add_meals($MTYPE,$NAME,$PIC,$PRICE,$WHID)
			{
				$parms = array(
					"MID" => NULL,
					"MTYPE" => $this->db->escape_str($MTYPE) ,
					"NAME" => $this->db->escape_str($NAME) ,
					"PIC" => $this->db->escape_str($PIC) ,
					"PRICE"=> $this->db->escape_str($PRICE)	,
					"WHID" => $this->db->escape_str($WHID) ,
					"RMD" => FALSE


				);

				//var_dump($parms);
				$ok =  $this->db->insert(
						"MEALS" ,
						$parms
				);
				return ($ok == true)	 ? $this->db->insert_id() : FALSE;

			}
		//  @@GETTERS  - @all ###############################################################################
		public function get_all_wh()
		{
			$parms = array(
				"RMD" => FALSE
			);
			$query = $this->db->get_where('WH',$parms);
			return $query->result_array();
		}
		public function get_all_wh_cat()
		{
			$parms = array('RMD ' => FALSE);
			$query = $this->db->get_where('WH_CAT',$parms);
			;
			return $query->result_array();
		}
		public function get_all_store()
		{
			$parms = array("RMD"=>FALSE);
			$query = $this->db->get_where("STORE",$parms);
			return $query->result_array();
		}
		public function get_all_expt()
		{
			$result = $this->db->get('EXPT');
			return $result->result_array();
		}
		public function get_all_expenses()
		{
			$params = array("RMD"=>FALSE);
			$result = $this->db->get_where('EXPENSES',$params);
			return $result->result_array();
		}
		public function get_all_meals()
		{
			$params = array("RMD"=>FALSE);
			$result = $this->db->get_where('MEALS',$params);
			return $result->result_array();
		}
		public function get_all_orders()
		{
			$params = array("RMD"=>FALSE);
			$result = $this->db->get_where('ORDERS',$params);
			return $result->result_array();
		}
		public function get_all_orders_info()
		{
			$params = array("RMD"=>FALSE);
			$result = $this->db->get_where('ORDERSINFO',$params);
			return $result->result_array();
		}
		public function get_all_jobs()
		{
			$params = array("RMD"=>FALSE);
			$result = $this->db->get_where('JOBS',$params);
			return $result->result_array();
		}
		public function get_all_workers()
		{
			$params = array("RMD"=>FALSE);
			$result = $this->db->get_where('WORKERS',$params);
			return $result->result_array();
		}
		public function get_all_store_debits()
		{
			$params = array("RMD"=>FALSE);
			$result = $this->db->get_where('STORE_DEBITS',$params);
			return $result->result_array();
		}
		public function get_all_workers_debits()
		{
			$params = array("RMD"=>FALSE);
			$result = $this->db->get_where('WORKERS_DEBITS',$params);
			return $result->result_array();
		}
		public function get_all_used_items()
		{
			$params = array("RMD"=>FALSE);
			$result = $this->db->get_where('USED_ITEMS',$params);
			return $result->result_array();
		}
		public function get_all_meal_types()
			{
				return $this->db->get("MEAL_TYPES")->result_array();
			}

		//@@GETTERS  - @BY-ID ##################################################################################
		public function get_wh_by_id($ID)
		{
			$parms=array(
			"ID" => $this->db->escape_str($ID) ,
			"RMD" => 0
			);
			$query = $this->db->get_where('WH',$parms);
			$result = $query ->result_array();
			return   (count($result) > 0)  ?  $result[0] : null;

		}
		public function  get_wh_by_cat_id($CAT){
			$parms = array(
					"CAT" => $CAT,
					"RMD" => 0

			);
			return $this->db->get_where("WH",$parms)->result_array();
		}

		public function get_wh_cat_by_id($ID)
		{
			$parms=array(
			"ID" => $this->db->escape_str($ID) ,
				"RMD" => 0
			);
			$query = $this->db->get_where('WH_CAT',$parms);
			$result = $query ->result_array();
			return   (count($result) > 0)  ?  $result[0] : null;

		}
		public function get_store_by_wid($WID)
		{
				$parms = array(
					"WID" => $WID
				);
				$result = $this->db->get_where("STORE")->result_array();
				return $result;
		}
		public function get_store_by_id($ID)
		{
			$parms = array(
				"ID"=>$ID ,

			);
			$query = $this->db->get_where("STORE",$parms);
			return $query->result_array();
		}
		public function get_unused_items_by_wid($WID)
		{
			$parms = array(
				"WHID" => $this->db->escape_str($WID)
			);
			$count = $this->db->get_where("USED_ITEMS",$parms)->num_rows();
			return $count;
		}
		public function get_expt_by_id($id)
		{
			return $this->db->get_where(
				"EXPT",
				array(
					"ID"=> $this->db->escape_str($id)
				)
			)->result_array();
		}
		public function get_expenses_by_id($id)
		{
			return $this->db->get_where(
				"EXPENSES",
				array(
					"ID"=> $this->db->escape_str($id)
				)
			)->result_array();
		}

		public function get_expenses_by_expt($expt)
		{
			return $this->db->get_where(
				"EXPENSES",
				array(
					"EXPT"=> $this->db->escape_str($expt)
				)
			)->result_array();
		}
		public function get_meals_by_id($id)
		{
			return $this->db->get_where(
				"MEALS",
				array(
					"MID"=> $this->db->escape_str($id)
				)
			)->result_array();
		}
		public function get_orders_by_id($id)
		{
			return $this->db->get_where(
				"ORDERS",
				array(
					"OID"=> $this->db->escape_str($id) ,

				)
			)->result_array();
		}
		public function get_order_info_by_id($id)
		{
			return $this->db->get_where(
				"ORDERINFO",
				array(
					"OID"=> $this->db->escape_str($id) ,

				)
			)->result_array();
		}
		public function get_meal_types_by_id($ID)
		{
			return $this->db->get_where(
				"MEAL_TYPES",
				array(
					"ID" => esc($ID)
				)
				)->result_array();
		}
		public function get_jobs_by_id($id)
		{
			return $this->db->get_where(
				"JOBS",
				array(
					"JID"=> $this->db->escape_str($id) ,

				)
			)->result_array();
		}
		public function get_workers_debits_by_id($id)
		{
			return $this->db->get_where(
				"ID",
				array(
					"ID"=> $this->db->escape_str($id) ,

				)
			)->result_array();
		}

		public function get_store_debits_by_id($id)
		{
			return $this->db->get_where(
				"STORE_DEBITS",
				array(
					"ID"=> $this->db->escape_str($id) ,

				)
			)->result_array();
		}
		public function get_used_items_by_wid($id)
		{
			return $this->db->get_where(
				"USED_ITEMS",
				array(
					"ID"=> $this->db->escape_str($id) ,

				)
			)->result_array();
		}


		//@@UPDATES#############################################################################################
		public function update_wh_cat($ID,$NAME)
		{
			$id = $this->db->escape_str($id);
			$name=$this->db->escape_str($name);
			$this->db->where("ID",$ID);

			$data=array(
			"NAME"=>$NAME
			);
			return $this->db->update("WH_CAT",$data);
		}
		public function update_wh($ID,$ENNAME,$ARNAME,$WUNIT,$WUNITSIZE,$EXPIRING,$CATID)
		{
			$ID = $this->db->escape_str($ID);
			$ENNAME=$this->db->escape_str($ENNAME);
			$ARNAME=$this->db->escape_str($ARNAME);
			$WUNIT=$this->db->escape_str($WUNIT);
			$WUNITSIZE=$this->db->escape_str($WUNITSIZE);
			$EXPIRING=$this->db->escape_str($EXPIRING);
			$CATID=$this->db->escape_str($CATID);
			$this->db->where("ID",$ID);
			$data=array(
			"ARNAME"=>$ARNAME,
			"ENNAME"=>$ENNAME,
			"WUNIT"=>$WUNIT,
			"WUNITSIZE"=>$WUNITSIZE,
			"EXPIRING"=>$EXPIRING ,
			"CAT" => $CATID
			);
			return $this->db->update("WH",$data);
		}
		public function update_store($ID,$QTY,$PRICE,$TP,$EXPDT)
		{
			$ID = $this->db->escape_str($ID);
		//	$WID = $this->db->escape_str($WID);
			$QTY = $this->db->escape_str($QTY);
			$PRICE = $this->db->escape_str($PRICE);
			$TP = $this->db->escape_str($TP);
			$EXPDT = $this->db->escape_str($EXPDT);
		//	$DT = $this->db->escape_str($DT);
		//	$RMD = $this->db->escape_str($RMD);
			$this->db->where("ID",$ID);
			$data= array(


				"QTY"=>$QTY,
				"PRICE"=>$PRICE,
				"TP"=>$TP,
				"EXPDT"=>$EXPDT
			);
			return $this->db->update("STORE",$data);
		}
		public function update_expt($id,$name,$pri)
		{
			$id = $this->db->escape_str($id);
			$name = $this->db->escape_str($name);
			$pri = $this->db->escape_str($pri);
			$parms = array(
					"NAME" => $name ,
					"PRI" => $pri

			);
			$this->db->where("id",$id);
			return $this->db->update("EXPT",$parms);
		}

		public function update_expenses($id,$name,$expt,$amt)
		{
			$id = $this->db->escape_str($id);
		//	print($id); die();

			$parms = array(
				"NAME" => $name ,
				"EXPT" => $expt ,
				"AMT" => $amt
			);
			$this->db->where('ID',$id);
			$ok =  $this->db->update("EXPENSES",
			array(
				"NAME" => $name ,
				"EXPT" => $expt ,
				"AMT" => $amt
			)
			);
			return $ok;
		}
		public function update_meals($id,$MTYPE,$MNAME,$PRICE,$WHID)
		{
			$id = $this->db->escape_str($id);
			$MTYPE = $this->db->escape_str($MTYPE);
			$MNAME = $this->db->escape_str($MNAME);
			$PRICE = $this->db->escape_str($PRICE);
			$WHID = $this->db->escape_str($WHID);
			$parms = array(
				"MTYPE" =>$MTYPE ,
				"NAME" => $MNAME ,
				"PRICE" => $PRICE ,
				"WHID" => $WHID,

			);
			$this->db->where('MID',$id);

			$ok =  $this->db->update("MEALS",$parms	);
			return $ok;
		}

		public function update_meals_pic($id,$PIC)
		{
			$id = $this->db->escape_str($id);

			$parms = array(
				"PIC" =>$PIC
			);
			$this->db->where('MID',$id);
			$ok =  $this->db->update("MEALS",$parms
			);
			return $ok;
		}
		public function update_orders($id,$AMT)
		{
			$id = $this->db->escape_str($id);
			$amt = $this->db->escape_str($AMT);
			$parms = array(
			"AMT" => $amt
			);
			$this->db->where('OID',$id);
			$ok =  $this->db->update("ORDERS",$parms);
			return $ok;
		}
		public function update_orderinfo($id,$oid,$mid,$qty,$price,$tp)
		{
			$id = $this->db->escape_str($id);
			$oid = $this->db->escape_str($oid);
			$mid = $this->db->escape_str($mid);
			$qty = $this->db->escape_str($qty);
			$price = $this->db->escape_str($price);
			$tp = $this->db->escape_str($tp);
			$parms = array(
				"MID" => $mid,
				"QTY" => $qty,
				"TP" => $tp,
				"PRICE" => $price

			);
			$this->db->where('ID',array("id"=>$id,"oid"=>$oid));
			$ok =  $this->db->update("ORDERINFO",$parms);
			return $ok;
		}
		public function update_store_debits($id,$lender,$amt,$ddesc,$paydate)
		{
			$id = $this->db->escape_str($id);

			$parms = array(

				"LENDER"=> esc($LENDER),
				"AMT" =>  esc ($amt),
				"DDESC" =>  esc ($ddesc),
				"PAYDATE" =>  esc ($paydate),
			);
			$this->db->where('ID',$id);
			$ok =  $this->db->update("STORE_DEBITS",$parms);

			return $ok;
		}
		public function update_jobs($JID,$JTITLE,$PRI,$SALARY)
		{
			$JID = $this->db->escape_str($JID);

			$parms = array(
				"JID"  => esc($JID),
				"JTITLE" => esc($JTITLE) ,
				"PRI"	=> esc($PRI),
				"SALARY"	=> esc($SALARY)
			);
			$this->db->where("JID",$JID);
			$ok =  $this->db->update("JOBS",$parms);

			return $ok;
		}
		public function update_workers($ID,$NAME,$T1,$T2,$JOB_ID)
		{
			$ID = esc($ID);
			$parms = array(
				"NAME" => esc($NAME)  ,
				"TEL1" => esc($T1)  ,
				"TEL2" => esc($T2)  ,
				"JOB_ID" => esc($JOB_ID)  ,

			);
			$this->db->where('ID',$ID);
			$ok =  $this->db->update("WORKERS",$parms);
			return $ok;
		}
		public function update_workers_debits($ID,$WID,$AMT)
		{
			$ID = esc($ID);
			$WID = esc($WID);
			$parms = array(
				"AMT" => esc($AMT)
			);
			$this->db->where('ID',array("ID"=>$ID,"WID"=>$WID));
			$ok =  $this->db->update("WORKERS",$parms);
			return $ok;
		}/*
		public function update_store_debits($ID,$LENDER,$AMT,$DDESC,$PAYDATES)
		{
				$ID = esc($ID);
				$parms = array(
					"LENDER" => esc($LENDER) ,
					"AMT" => esc($AMT) ,
					"DDESC" => esc($DDESC) ,
					"PAYDATES" => esc($PAYDATE)
				);
			$this->db->where("ID",$ID);
				return $this->db->update("STORE_DEBITS",$parms);
		}*/

		########################################################################################################
		//@@UNLINK

		public function unlink_wh($id)
		{
			$this->db->where("ID",$id);
		return 	$this->db->delete("WH");

		}
		public function unlink_wh_cat($id)
		{
			$this->db->where("ID",$id);
		//	$this->db->delete("WH_CAT");
		   $parms = array('RMD' => TRUE );
			return $this->db->update("WH_CAT",$parms);
		}
		public function unlink_store_by_wid($id)
		{
			$this->db->where("WID",$id);
			return $this->db->delete("STORE");
		}
	/*	public function unlink_store_by_id($ID)
		{
			$this->db->where("ID",$id);
			return $this->db->delete("STORE");
		}
		*/
		public function unlink_used_items_by_id($id){
			$this->db->where("WHID",$id);
			$this->db->delete("USED_ITEMS");
		}
		public function unlink_store_by_id($id){
			$this->db->where("ID",$id);
		return	$this->db->update("STORE",
				array(
					"RMD" => TRUE
				)
			);

		}
		public function unlink_expt($id)
		{
			return	$this->db->delete("EXPT",array(
					"ID"=>$id
				));
		}
		public function unlink_expenses($id)
		{
			$id = $this->db->escape_str($id);
			$this->db->where("ID",$id);
			return	$this->db->update("EXPENSES",
				array(
					"RMD" => TRUE
				)
			);
		}
		public function unlink_meals($ID)
		{
			$parms = array(
				"RMD"=>true
			);
			$this->db->where("MID",esc($ID));
			return $this->db->update("MEALS",$parms);
		}
		public function unlink_orders($OID)
		{
			$parms = array(
				"RMD"=>true
			);
			$this->db->where("OID",esc($ID));
			return $this->db->update("ORDERS",$parms);
		}
		public function unlink_order_info($ID)
		{
			$this->db->where("ID",esc($ID));
			return $this->db->delete("ORDERINFO");
		}
		public function unlink_jobs($ID)
		{
			$parms = array(
				"RMD"=>true
			);
			$this->db->where("JID",esc($ID));
			return $this->db->update("JOBS",$parms);
		}
		public function unlink_workers($ID)
		{
			$parms = array(
				"RMD"=>true
			);
			$this->db->where("ID",esc($ID));
			return $this->db->update("WORKERS",$parms);
		}
		public function unlink_workers_debits($ID)
		{
			$this->db->where("ID",esc($ID));
			return $this->db->delete-("WORKERS_DEBITS");
		}
		public function unlink_store_debits($ID)
		{
			$this->db->where("ID",esc($ID));
			return $this->db->delete-("STORE_DEBITS");
		}
		public function unlink_unused_items($ID)
		{
			$this->db->where("ID",esc($ID));
			return $this->db->delete-("USED_ITEMS");
		}
		###########################################################################################################
		// @@MISC
		public function auth_action($pwd){
			$id = $this->session->id;
			$data = array(
					"PWD" => hash_hmac("sha512",$pwd,"C-X-C",false),
					"ID"=>$id
			);
		////	var_dump($data);
			////die();
			$result = $this->db->get_where("WH");
			if($result->num_rows() < 1){
				return false;
			}else{
				return true;
			}

		}

		public function get_store_count_by_wid($WID)
		{
			$parms = array(
				"WID" => $this->db->escape_str($WID)
			);
			$count = $this->db->get_where("STORE",$parms)->num_rows();
			return $count;
		}
		public function get_wh_count_by_cat($CAT)
		{
			$parms = array(
				"CAT" => $this->db->escape_str($CAT)
			);
			$count = $this->db->get_where("WH",$parms)->num_rows();
			return $count;
		}
		public function set_debit_paid($ID)
		{
			$ID = esc($ID);
			$params = array(
				"PAID" => TRUE ,
				"PAIDDT" => date("Y-m-d h:i:s")
			);
			$this->where("ID",$ID);
			return $this->update("STORE_DEBITS",$parms);
		}
		public function get_timeleft($DT)
		{

			//$now = new time();
		}

	#########################################################################################################
	# @@@ SEARCH FUNCTIONS
	public function get_expenses_by_interval($start,$end)
	{
			$A = $this->db->escape_str($start);
			$B = $this->db->escape_str($end);
			$queryString = "SELECT * FROM EXPENSES WHERE DT BETWEEN '$A' AND '$B' AND RMD = 0";
			$result = $this->db->query($queryString);
			return $result->result_array();

	}
	public function get_orders_by_interval($start,$end)
	{
			$A = $this->db->escape_str($start);
			$B = $this->db->escape_str($end);
			$queryString = "SELECT * FROM ORDERS   WHERE DT BETWEEN '$A' AND '$B' AND RMD = 0";
			$result = $this->db->query($queryString);
			return 	$result->result_array();


	}
	public function get_orders_counts($OID)
	{
		$data = $this->get_order_info_by_id($OID);
		$total = 0;
		foreach($data as $A)
		{
			$total += $A['QTY'];
		}
		return $total;
	}


	}

?>
