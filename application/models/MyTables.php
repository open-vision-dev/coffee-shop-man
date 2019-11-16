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
			public function add_expenses($name,$expt,$amt,$info=NULL)
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
			public function add_orders($AMT)
			{

				$parms = array(
					"OID" => NULL,
					"AMT" => $AMT
					,"DT" => date("Y-m-d h:i:s"),
					"RMD" => FALSE
			 );
			 $ok  =	 $this->db->insert("ORDERS",$parms);
			 return ($ok == true)	 ? $this->db->insert_id() : FALSE;
			}
			public function add_orderinfo($OID,$MID,$QTY,$PRICE,$TP)
			{

				$parms = array(
					"ID" => NULL,
					"OID" => $OID,
					"MID" => $MID ,
					"QTY" => $QTY,
					"PRICE" => $PRICE,
					"TP" => $TP,
					"DT" => date("Y-m-d h:i:s"),

			 );
			 return	 $this->db->insert("ORDERINFO",$parms);
			}
			public function add_useditems($WHID,$QTY)
			{
				$parms = array(
					"ID"=>NULL,
					"WHID" => esc($WHID) ,
					"QTY" => esc($QTY),
					"DT"=>date("Y-m-d h:i:s")
				);
				return $this->db->insert("USED_ITEMS",$parms);
			}
			public function add_jobs($NAME,$SALARY,$PRI=1)
			{
				$parms = array(
					"JID" => NULL ,
					"SALARY"=> $SALARY,
					"JTITLE" => $NAME ,
					"PRI" => $PRI ,
					"RMD" => FALSE
				);
				return $this->db->insert("JOBS",$parms);
			}
			public function add_workers($NAME,$TEL1,$TEL2,$JOB_ID)
			{
				$parms = array(
					"ID"=>NULL,
					"JOB_ID" => $JOB_ID ,
					"NAME" => $NAME,
					"TEL"=> $TEL1,
				 	"TEL2" => $TEL2 ,

					"RMD" => FALSE
				);
				$ok =  $this->db->insert("WORKERS",$parms);
				return ($ok) ? $this->db->insert_id() : null;
			}
			public function add_workers_debits($WID,$AMT)
			{
				$parms = array(
					"WID"=>$WID,
					"AMT"=>$AMT,

					"DT"=> date("Y-m-d h:i:s")
				);
				$ok =  $this->db->insert("WORKERS_DEBITS",$parms);
			 return ($ok == true)	 ? $this->db->insert_id() : FALSE;
			}
			public function add_store_debits($LENDER,$AMT,$DDESC,$PAYDATE)
			{
				$parms = array(
					"ID"=>NULL,
					"LENDER"=>$LENDER,
					"AMT" => $AMT ,
					"DDESC" => $DDESC,
					"PAYDATE" => $PAYDATE,
					"PAID" => FALSE ,
					"DT" => date("Y-m-d h:i:s"),
					"PAIDDT" => NULL,
					"RMD"=>FALSE

				);
				$ok =  $this->db->insert("STORE_DEBITS",$parms);
				return $ok;
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
					"id"=> $this->db->escape_str($id)
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
		public function  get_workers_by_job_id($id)
		{
			return $this->db->get_where(
				"WORKERS",
				array(
					"JOB_ID"=> $this->db->escape_str($id) ,

				)
			)->result_array();
		}
		public function  get_workers_by_id($id)
		{
			return $this->db->get_where(
				"WORKERS",
				array(
					"ID"=> $this->db->escape_str($id) ,

				)
			)->result_array();
		}
		public function get_workers_debits_by_id($id)
		{
			return $this->db->get_where(
				"WORKERS_DEBITS",
				array(
					"ID"=> $this->db->escape_str($id) ,

				)
			)->result_array();
		}

		public function get_store_debits_by_id($id)
		{
		$data= 	$this->db->get_where(
				"STORE_DEBITS",
				array(
					"ID"=> $this->db->escape_str($id) ,

				)
			)->result_array();

		return  $data;
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

				"LENDER"=> esc($lender),
				"AMT" =>  esc ($amt),
				"DDESC" =>  esc ($ddesc),
				"PAYDATE" =>  esc ($paydate),
			);
			$this->db->where('ID',$id);
			$ok =  $this->db->update("STORE_DEBITS",$parms);

			return $ok;
		}
		public function close_store_debits($id)
		{
			$id = $this->db->escape_str($id);

			$parms = array(

				"ID" => $id ,
				"PAID" => TRUE ,
				"PAIDDT" => date("Y-m-d h:i:s")
			);
			$this->db->where('ID',$id);
			$ok =  $this->db->update("STORE_DEBITS",$parms);

			$NAME  = $this->get_store_debits_by_id($id)[0]['LENDER'];
			$AMT  = $this->get_store_debits_by_id($id)[0]['AMT'];
			$DESC = $this->get_store_debits_by_id($id)[0]['DDESC'];
			$ok2 = $this->add_expenses($NAME,2,$AMT,"تم اغلاق المديوينة");

			return $ok && $ok2 ;
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
				"TEL" => esc($T1)  ,
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
			$this->db->where("ID",$id);
			return $this->db->delete("USED_ITEMS");
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
			$this->db->where("OID",esc($OID));
		return 	$this->db->update("ORDERS",$parms);

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

			$ok =  $this->db->delete("WORKERS_DEBITS");

			return $ok;
		}
		public function unlink_store_debits($ID)
		{
			$this->db->where("ID",esc($ID));
			$parms = array("RMD"=>TRUE);
			return $this->db->update("STORE_DEBITS",$parms);
		}
		public function unlink_unused_items($ID)
		{
			$this->db->where("ID",esc($ID));
			return $this->db->delete-("USED_ITEMS");
		}
		###########################################################################################################
		// @@MISC
		public function get_jobs_count($id)
		{
			$parms = array(
				"JOB_ID" => $id
			);
			$results = $this->db->get_where("WORKERS",$parms)->result_array();
			return ($results != null ) ? count($results) : 0;
		}
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
	public function get_used_items_by_interval($start,$end)
	{
			$A = $this->db->escape_str($start);
			$B = $this->db->escape_str($end);
			$queryString = <<<SQL
				SELECT  USED_ITEMS.ID,WH.PIC,USED_ITEMS.WHID,USED_ITEMS.QTY,USED_ITEMS.DT,WH.ARNAME,WH.ENNAME
		 	FROM `USED_ITEMS`
		 	 INNER JOIN  `WH`
			  ON `WH`.`ID` = `USED_ITEMS`.`WHID`
			  WHERE `DT`
			  BETWEEN '$A' AND '$B'

			  AND `RMD` = 0
			  ORDER BY `CAT`


SQL;
			$result = $this->db->query($queryString);
			return 	$result->result_array();

	}
	public function get_used_items_by_interval_whid($start,$end,$whid)
	{
			$A = $this->db->escape_str($start);
			$B = $this->db->escape_str($end);
			$whid = esc($whid);
			$queryString = <<<SQL
				SELECT 	`USED_ITEMS`.`ID` AS USID,*
		 	   FROM `USED_ITEMS`
        	 	INNER JOIN  `WH`
			  ON `WH`.`ID` = `USED_ITEMS`.`WHID`
			  WHERE `DT`
			  BETWEEN '$A' AND '$B'
			  AND `RMD` = 0
			  AND `WHID` = '$whid'
			  ORDER BY `CAT`
SQL;
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
	public function get_distinct_store_whid()
	{
		$query = "SELECT DISTINCT(STORE.WID)AS ID,`ARNAME`,`ENNAME`  FROM `STORE` INNER JOIN `WH` ON `STORE`.`WID` = `WH`.`ID`  ";
		return $this->db->query($query)->result_array();
	}
	public function get_used_item_wh_count($WHID)
	{
		$WHID = esc($WHID);
		$query = "SELECT count(ID) FROM `USED_ITEMS` WHERE WHID = '$WHID' AND RMD = 0";
		return $this->db->query($query)->result_array();
	}
	public function get_workers_debits_interval($id,$start,$end)
	{
				$id = $this->db->escape_str($id);
				$A = $this->db->escape_str($start);
				$B = $this->db->escape_str($end);
				$queryString = <<<SQL
				SELECT SUM(`AMT`) AS TOTAL FROM `WORKERS_DEBITS`
				WHERE DT
				  BETWEEN '$A' AND '$B'

				  AND `WID` = $id


SQL;
				$result = $this->db->query($queryString);
				return 	$result->result_array();

	}
	public function get_workers_debits_interval_info($id,$start,$end)
	{
				$id = $this->db->escape_str($id);
				$A = $this->db->escape_str($start);
				$B = $this->db->escape_str($end);
				$queryString = <<<SQL
				SELECT * FROM `WORKERS_DEBITS`
				WHERE `DT`
				  BETWEEN '$A' AND '$B'

				  AND `WID` = $id


SQL;
				$result = $this->db->query($queryString);

				return 	$result->result_array();

	}
	public function get_store_debits_interval_info($start,$end)
	{
				$A = $this->db->escape_str($start);
				$B = $this->db->escape_str($end);
				$queryString = <<<SQL
				SELECT * FROM `STORE_DEBITS`
				WHERE `DT`
				  BETWEEN '$A' AND '$B'
				  AND `RMD` != TRUE




SQL;
				$result = $this->db->query($queryString);

				return 	$result->result_array();

	}
	public function get_workers_debits_interval_info_noid($start,$end)
	{

				$A = $this->db->escape_str($start);
				$B = $this->db->escape_str($end);
				$queryString = <<<SQL
				SELECT * FROM `WORKERS_DEBITS`
				WHERE DT
				  BETWEEN '$A' AND '$B'


SQL;
				$result = $this->db->query($queryString);
				return 	$result->result_array();

	}
	public function get_store_listing_data()
	{
		$items = $this->get_all_wh();
		$wh_content = array();
		foreach($items as $I)
		{
			$ID = $I['ID'];
			$name = $I['ARNAME'] .'-'. $I['ENNAME'];
			$name = "<a href='Admin/wh/view/$ID' >$name</a>";
			$qty = $this->get_store_wh_qty_count($ID)[0]['TOTAL'];
			$qty = ($qty == NULL) ? 0 : $qty;
			$used =$this-> get_used_item_wh_qty_count($ID)['0']['TOTAL'];
			$used = ($used == NULL) ? 0 : $used;
			$avail = $qty - $used;
			$avail = ($avail < 0) ? 0 : $avail;
			$pic = $I['PIC'];
			array_push($wh_content,array(
				'name'=>$name,
				'qty'=>$qty  ,
				'pic'=>$pic ,
				'avail'=>$avail,
				'used'=>$used,

			));
		}
		return $wh_content;
	}
	public function get_store_wh_qty_count($id)
	{
		$id = $this->db->escape_str($id);

		$queryString = <<<SQL
		SELECT SUM(`QTY`)+0 AS TOTAL FROM `STORE`
		WHERE `WID` = $id


SQL;
		$result = $this->db->query($queryString);
		return 	$result->result_array();
	}
	public function get_used_item_wh_qty_count($id)
	{
		$id = $this->db->escape_str($id);

		$queryString = <<<SQL
		SELECT SUM(`QTY`)+0 AS TOTAL FROM `USED_ITEMS`
		WHERE `WHID` = $id


SQL;
		$result = $this->db->query($queryString);
		return 	$result->result_array();
	}
	public function get_income_interval($start,$end)
	{
		$start = $this->db->escape($start);
		$end = $this->db->escape($end);
		$queryString = <<<Q
			SELECT SUM(AMT)AS TOTAL
			FROM ORDERS
			WHERE DT BETWEEN
			$start
			and
			$end
			AND RMD = FALSE
Q;

	$result = $this->db->query($queryString);
	return 	$result->result_array();
	}
	public function get_expenses_sum_interval($start,$end)
	{
		$start = $this->db->escape($start);
		$end = $this->db->escape($end);
		$queryString = <<<Q
			SELECT SUM(AMT)
			AS TOTAL
			FROM EXPENSES
			WHERE DT BETWEEN
			$start
			AND
			$end
			AND RMD = FALSE
Q;
	$result = $this->db->query($queryString);
	return 	$result->result_array();
	}

	public function get_unpaid_debits_intw($start,$end)
	{
			$start = $this->db->escape($start);
			$end = $this->db->escape($end);
			$queryString = <<<Q
				SELECT SUM(AMT)AS TOTAL
				FROM STORE_DEBITS
				WHERE
				RMD =0
				AND PAID=0
				AND DT BETWEEN
				$start
				and
				$end

Q;
		$result = $this->db->query($queryString);
		return 	$result->result_array();
	}
	public function get_expenses_listing_pie_chart_data($start,$end)
	{
		$dataset =array(
			"labels" => array() ,
			"data" => array() ,
			"backgroundColor" => array()
		);
		$info = $this->get_expenses_listing($start,$end);
		foreach($info as $A)
		{
			array_push($dataset['labels'],$A['NAME']);
			array_push($dataset['data'],$A['PERCENT']);
		//	srand(md5(time()));
			$c1 =rand(0,255);
			$c2 =rand(0,255);
			$c3 =rand(0,255);

			$color = "rgb( $c1, $c2 , $c3)";
			array_push($dataset['backgroundColor'],$color);
		}
		$labels_txt = json_encode($dataset['labels']);
		$data_txt = json_encode($dataset['data']);
		$bg_txt = json_encode($dataset['backgroundColor']);
		$raw = <<<XML
		data : {
			labels : $labels_txt  ,
			dataset:[{
			data: $data_txt ,
			backgroundColor:$bg_txt ,
			  }],
			}

XML;
		return json_encode($dataset);
	}
	public function get_expenses_listing($start,$end)
	{
	//	$start = $this->db->escape_str($start);
	//$end = $this->db->escape_str($end);
		$exp_total = $this->get_expenses_sum_interval($start,$end)[0]['TOTAL'];
		$A = $this->get_all_expt();
		$listing = array();
		foreach($A as $B)
		{
			$NAME = $B['NAME'];
			$ID = $B['ID'];
			$TOTAL = $this->get_expenses_by_expt_interval($start,$end,$ID);
			$TOTAL = $TOTAL[0]['TOTAL'] + 0;

			$PERCENT =  ($exp_total <= 1 ) ? 0  :round((($TOTAL )/ $exp_total)*100,2);
			$data = array(
				"ID" => $ID,
				"NAME"=>$NAME ,
				"TOTAL" => $TOTAL ,
				"PERCENT" => $PERCENT
			);
			array_push($listing,$data);
		}
	//	var_dump("<pre>",$listing,"<pre>");
	//	die();
		return $listing;
	}
	public function get_expenses_by_expt_interval($start,$end,$expt)
	{
		$start = $this->db->escape($start);
		$end = $this->db->escape($end);
	//	$expt = $this->db->escape($expt);
		$queryString = <<<Q
			SELECT SUM(AMT)
			AS TOTAL
			FROM EXPENSES
			WHERE RMD = FALSE
			AND EXPT = $expt
			AND  DT BETWEEN
			$start
			AND
			$end


Q;
	$result = $this->db->query($queryString);
//	var_dump("<pre>",$this->db);
//	die();
	return $result->result_array();

	}
	public  function get_order_listing($start,$end)
	{
		$info = $this->get_all_meals();
		$result = array();
		foreach($info as $M)
		{
			$MID = $M['MID'];
			$NAME = $M['NAME'];
			$PRICE = $M['PRICE'];
			$D = $this->get_orderinfo_sum($MID,$start,$end)[0];
			$QTY = $D['TOTAL'] + 0;
			$TP_PRICE = $D['TOTAL_TP'] + 0;
			$data = array(
				"ID" => $MID,
			"NAME" => $NAME ,
			"PRICE" => $PRICE ,
			"QTY" => $QTY ,
			"TP"	=> $TP_PRICE
			);
			array_push($result,$data);
		}
		return $result;
	}
	public function get_orderinfo_sum($MID,$start,$end)
	{
		$start = $this->db->escape_str($start);
		$end = $this->db->escape_str($end);
		$mid = $this->db->escape_str($end);
		$queryString = <<<Q
		SELECT SUM(QTY) AS TOTAL,SUM(TP) AS TOTAL_TP
		FROM ORDERINFO
		WHERE
		MID = $MID AND
		DT BETWEEN '$start' and '$end'
Q;
	$result = $this->db->query($queryString);
	return 	$result->result_array();

	}
	public function get_paid_debits_sum_interval($start,$end)
	{
		$start = $this->db->escape($start);
		$end = $this->db->escape($end);
		$queryString = <<<Q
		SELECT SUM(AMT) AS TOTAL
		FROM STORE_DEBITS
		 WHERE PAID = 1
		 and RMD = 0
		 AND DT BETWEEN $start and $end
Q;
	$result = $this->db->query($queryString);
	return 	$result->result_array();
	}




}
?>
