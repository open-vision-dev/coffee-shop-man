<?php
defined("BASEPATH") OR exit("no script transpassing ");
class WH extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("MyTables.php","tables");

	}
	public function format_wh_edit_form($ID)
		{
			$WH_DATA = $this->tables->get_wh_by_id($ID);

			$WH_CAT_DATA = $this->tables->get_all_wh_cat($ID);
			//var_dump($WH_CAT_DATA);
			$data =  array(
			"class" => "form-control text-center " ,
			"autocomplete" => "off" ,

			);
			$link =site_link_to("Input/index/edit/wh/$ID");
			$f=form_open($link);
		//echo $f;
			//die(site_link_to("Input/index/edit/wh/$ID");
			$select_box = '<div class="btn-group fill-100" data-toggle="" role="group" aria-label="Basic example">';
			foreach($WH_CAT_DATA as $WHCAT)
			{
				$checked = "";
				$NAME = $WHCAT['NAME'];
				$ID = $WHCAT['ID'];
				if($ID == $WH_DATA['CAT'])
				{
					$checked = "checked";
				}
				$select_box.= "<label class='btn btn-primary'><input required='required' name='CATID' $checked type='radio' value='$ID' />$NAME</label>";
			}
			$select_box.="</div>";
			$select_box2 = "<div class='btn-group fill-100' data-toggle='' role='group' aria-label='Basic example'>";
			//$opts = array ("","1");
			$optsVal = array ("YES","NO");
			$optsCounter=0;
			foreach($optsVal  as $txt)
			{
				$checked = "";
				//$txt = $optsVal[$i];
				if($optsCounter == $WH_DATA['EXPIRING'])
				{
					$checked = " checked";
				}
				$select_box2 .= "<label class='btn btn-primary'><input class='form-control' required='required' name='EXPIRING' $checked type='radio' value='$optsCounter' />$txt</label>";
				$optsCounter++;
			}
			$select_box.="</div>";
			$I=$WH_DATA;
			//var_dump($I);
			//die();
			$view="";
			//	var_dump($I);
			$ARNAME = $I['ARNAME'];
			$ENNAME = $I['ENNAME'];
			$WUNIT = $I['WUNIT'];
			$WUNITSIZE = $I['WUNITSIZE'];
			$EXPIRING = $I['EXPIRING'];
			$view.=<<<FORM
			$f

			<div class="input-group">

				<input id="AR-NAME"  value="$ARNAME" type="text" class="form-control" name="AR_NAME" placeholder="AR-NAME">
				<div class='input-group-append'>
				<span for='ar' class="input-group-text  btn btn-info"><i class="glyphicon glyphicon-user"> الاسم الانجليزي</i></span>

				</div>
			</div>
			<div class="input-group">
				<div class='input-group-prepend'>
				<span for='ar' class="input-group-text"><i class="glyphicon glyphicon-user">الاسم الانجليزي</i></span>

				</div>
				<input id="EN_NAME" value="$ENNAME" type="text" class="form-control" name="EN_NAME" placeholder="الاسم الانجليزي">

			</div>
			<div class="input-group">
				<div class='input-group-prepend'>
				<span for='ar' class="input-group-text"><i class="glyphicon glyphicon-user">وحدة القياس</i></span>

				</div>
				<input id="WUNIT" value="$WUNIT" type="text" class="form-control" name="WUNIT" placeholder="وحدة القياس">

			</div>
			<div class="input-group">
				<div class='input-group-prepend'>
				<span for='ar' class="input-group-text"><i class="glyphicon glyphicon-user">حجم/كمية الوحدة</i></span>

				</div>
				<input id="WUNIT_SIZE"  value="$WUNITSIZE" type="text" class="form-control" name="WUNIT_SIZE" placeholder="5 ،100 ، 3.5 الخ">

			</div>
			<div class="input-group">
				<div class='input-group-prepend'>
				<span for='ar' class="input-group-text"><i class="glyphicon glyphicon-user">انتهاء الصلاحية</i></span>

				</div>
				$select_box2

			</div>
			<div class="input-group">
				<div class='input-group-prepend'>
				<span for='ar' class="input-group-text"><i class="glyphicon glyphicon-user">التصنيف</i></span>

				</div>
				$select_box
				<input type='submit' class='btn btn-lg btn-success form-control text-center' value='تحديث' />
			</div>

			<style>
			.fill-100
			{

				width:100%;

			}


			</style>


FORM;


			$view.="</form>";

			return $view;
		}
		public function render_wh_listing()
		{
			$WH_DATA = $this->tables->get_store_listing_data();

			$VIEW = <<<VIEW
			<table class='table text-center' id='dataTable'>
			<thead>
				<td>PIC </td>
				<Td>Name</td>
				<Td>Qty</td>
				<Td>USED</td>
				<Td>Avail</td>
			</thead>
VIEW;
			foreach($WH_DATA as $TABLE)
			{
				$NAME = $TABLE['name'];
				$QTY = $TABLE['qty'];
				$USED = $TABLE['used'];
				$AVAIL = $TABLE['avail'];
				$PIC = $TABLE['pic'];
				$PIC = "<img src='$PIC' style='width:50px;height:40px'  / >";
				$VIEW .= <<<XML
				<tr>
					<td>$PIC</td>
					<Td>$NAME</td>
					<Td>$QTY</td>
					<Td>$USED</td>
					<Td>$AVAIL</td>
				</tr>
XML;
			}
			return $VIEW;
		}
		public function  render_wh_item_view($ID)
		{
			$WH_DATA = $this->tables->get_wh_by_id($ID);
			(is_null($WH_DATA) ) ?   exit("Some thing wrong happend") : null;
			$ARNAME = $WH_DATA['ARNAME'];
			$ENNAME = $WH_DATA['ENNAME'];
			$WUNIT = $WH_DATA['WUNIT'];
			$WUNITSIZE = $WH_DATA['WUNITSIZE'];
			$PIC = $WH_DATA['PIC'];
			$EXPIRING = ($WH_DATA['EXPIRING'] == 0)  ?  "Yes" : "No";

			$VIEW= <<<DATA
			<div class='row'>
			<div class='col-xs-12 col-md-6'>
				<img src='$PIC' class='image-responsive border-success' />
			</div>
			<div class='col-xs-12 col-md-6'>
				<div class='card'>
					<div class='card-header'>
						<h1 class='col-xs-6'>$ARNAME</h1>
						<h1 class='col-xs-6'>$ENNAME</h1>
					</div>
					<div class='card-body'
					Weight Unit : <span class='label label-succes'>$WUNIT </span>
					<br />
					Weight Size :<span class='label label-default'> $WUNITSIZE</span> <br />
					Expiring : <span class='label label-default'>$EXPIRING</span>
					</div>
					<div class='card-footer'>

					</div>
				</div>

			</div>
DATA;
			return $VIEW;
			}
			public function render_wh_item_add()
			{
				$WH_CAT_DATA = $this->tables->get_all_wh_cat();
				$CAT_SELECT_BOX = "<select class='form-control text-center' name='CAT'>";
				foreach($WH_CAT_DATA as $item){
					$NAME = $item['NAME'];
					$ID   = $item['ID'];
					$CAT_SELECT_BOX .=  "<option value='$ID'>$NAME</option>";
					}
				$CAT_SELECT_BOX .= "</select>";
				$VIEW = form_open_multipart(site_link_to("Input/add/wh"));
				$VIEW .= <<<ABC
				<div id='input-wh-add-form'>
						<div class='input-group mb-3'>

									<input type='text/javascript' class='form-control text-center' name='ARNAME' />
									<div class="input-group-prepend">
										<span class='input-group-text'>الاسم العربي </span>
									</div>
						</div>


						<div class='input-group mb-3'>

									<input type='text/javascript' class='form-control text-center' name='ENNAME' />
									<div class="input-group-prepend">
										<span class='input-group-text'>الاسم الانجليزي </span>
									</div>
						</div>


						<div class='input-group mb-3'>

									$CAT_SELECT_BOX
									<div class="input-group-prepend">
										<span class='input-group-text'>التصنيف</span>
									</div>
						</div>
						<div class='input-group mb-3'>

									<input type='file' class='form-control' name='PIC'  capture />
									<div class="input-group-prepend">
										<span class='input-group-text'>صورة المنتج</span>
									</div>
						</div>
						<div class='input-group mb-3'>

									<input type='text' class='form-control' name='WUNIT' required='required' placeholder='كرتونة،كيس،صندوق،كجم،جم،الخ' capture />
									<div class="input-group-prepend">
										<span class='input-group-text'>وحدة قياس الحجم</span>
									</div>
						</div>
						<div class='input-group mb-3'>

									<input type='text' class='form-control' name='WUNITSIZE' required='required' placeholder='كرتونة،كيس،صندوق،كجم،جم،الخ' capture />
									<div class="input-group-prepend">
										<span class='input-group-text'>الحجم</span>
									</div>
						</div>
						<div class='input-group mb-3'>
								<select class='form-control select ' name='EXPIRING'>
										<option value='0'>لا</option>
										<option value='1'>نعم</option>

								</select>

									<div class="input-group-prepend">
										<span class='input-group-text'>انتهاء الصلاحية</span>
									</div>
						</div>
						<input type='submit' class='btn btn-success btn-xlg form-control' name='submit' value='استمرار' />

				</div>

ABC;
				$VIEW .= "</form>";
				return $VIEW;
			}
			public function render_wh_change_thumb($ID)
			{
				$DATA = $this->tables->get_wh_by_id($ID);
				(is_null($DATA)) ?  redirect("/") :    null  ;           #TODO : this line needs reveision
				$ENNAME = $DATA['ENNAME'];
				$ARNAME = $DATA['ARNAME'];
				$WUNIT  = $DATA['WUNIT'];
				$PIC  = $DATA['PIC'];
				$WUNITSIZE  = $DATA['WUNITSIZE'];
				$EXPIRING = ($DATA['EXPIRING'] == 0) ? "غير قابل للانتهاء"  :  "قابل لانتهاء" ;

				$VIEW=<<<CBG
				<div class='container'>
					<div class='row text-center'>
							<div class='col-xs-12 col-md-6'>
								<img src='$PIC' />

							</div>
							<div class='col-xs-12 col-md-6'>
								<dl>
										<dt>
											NAME  : :
										</dt>
										<dd>
										$ENNAME  &amp; $ARNAME
										</dd>
										<dt>
											Unit  : :
										</dt>
										<dd>
										$WUNIT : $WUNITSIZE
										</dd>
										<dt>
										EXPIRING :
										</dt>
										<dd>
										$EXPIRING
										</dd>

								</dl>

							</div>
							</div>
							<div class='row'>
								<div class='col-xs-12 col-md-12'>
										<hr />
											<form method="POST" action="/index.php/Input/change_bg/wh/$ID/" enctype='multipart/form-data'>
											<div class='input-group'>
													<input type='file' class='form-control' name='PIC' required='required'  capture/>
													<div class='input-group-append'>
												<span class='input-group-text '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	<span class='fa fa-camera' ></span></span>
													</div>
											</div>
											<input type='submit' value='Continue' class='btn btn-info btn-lg form-control' />
												</form>
									</div>


					</div>

CBG;
			return $VIEW;
			}
			public function render_wh_item_unlink($ID)
			{
					/*
						TODO :
						1. check for exisiting store items from the same id if then show it
						2. if users confirms he wants to empty the store
						3. check his password then remove the wh item
					*/
				//	$store_count = $this->db->select_count("")

				$store_count =  $this->tables->get_store_count_by_wid($ID);
				$store_items = $this->tables->get_store_by_wid($ID);
				$store_list_view ="<div class='col-xs-12 col-md-12 card ' >\n<ul class='list-group list-group-flush text-center align-self-center'>";
				foreach($store_items as $i){
					$QTY = $i['QTY'];
					$PRICE = $i['TP'];
					$DT = $i['DT'];
					$store_list_view .= "<li class='list-group-item'>QTY <span class='badge badge-primary'>$QTY</span> PRICE : <span class='badge badge-danger fa fa-cash '>$PRICE</span> DATE: <span class='badge badge-warning fa fa-time'>$DT</span>";
				}
				$question_txt_no_items ="هذا الصنف لا يحوي علي سجلات داخل المخزن ";
				$question_txt_has_items ="هل انت متأكد من انك تريد ازالة الصنف؟ هذا الصنف موجود لديه السجلات التالية داخل المخزن سوف يتم حذفها معه";
				$store_list_view = ($store_count > 0) ?  $store_list_view : "";
				$question_txt = ($store_count > 0 ) ?  $question_txt_has_items :  $question_txt_no_items;
				$alert_class = ($store_count > 0 ) ? "alert alert-danger" : "alert  alert-info";
				$store_list_view.="</ul></div>";
				$input_link=form_open(site_link_to("Input/unlink/wh/$ID/"));
				$VIEW = <<<DIV
					$input_link
					<div class='row'>
							<div class='col-xs-12 col-md-12 text-center $alert_class' role='alert'>
										$question_txt
							</div>

								$store_list_view

							</div>
							<div>

									<div class='input-group' >


											<input type='password' name='pass' required='required' class='form-control text-center' placeholder='PASSWORD' />
												<div class='input-group-append'>
															<p class='input-group-text'>
																	<span class='fa fa-users'>
																&nbsp;	&nbsp;	&nbsp;	&nbsp;
																	</span>
																	تاكيد كلمة المرور
															</p>
													</div>
											</div><br /><br />
											<input type='submit' class='btn btn-warning form-control btn-lg fa fa-eraser ' value='حذف'/>
							</form>

					</div>
DIV;
					return $VIEW;
			}



}
