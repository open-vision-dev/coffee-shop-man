<?php
defined("BASEPATH") OR exit("NO SCRIPT TRANSPASSING");
class Store extends CI_Model {

        public function __construct()
        {
            parent::__construct();
        $this->load->model("MyTables","tables");
        }
        public function render_store_list()
        {
                $DATA  = $this->tables->get_all_store();


                $VIEW =<<<FORM
            <div class=''>
                    <table class='table table-striped' id='dataTable' >
                    <thead>
                        <td>

                        </td>
                            <td>
                                <span class='label label-lg label-dark label-info'>
                                    ENNAME
                                </span>
                                :
                                <span class='label label-primary'>
                                    ARNAME
                                </span>
                            </td>
                            <td>
                                الكمية
                            </td>
                            <td>
                                السعر
                            </td>
                            <td>
                            الاجمالي
                            </td>
                            <td>
                            تاريح الانتهاء
                            </td>
                            <td>
                                تاريخ الاستلام
                            </td>
                            <td>
                                الخيارات
                            </td>

                    </thead>


FORM;
            foreach($DATA AS $A)
            {
                $ID = $A['ID'];
                $QTY = $A['QTY']+0.0;
                $PRICE = $A['PRICE'];
                $TP = $A['TP'];
                $EXPDT = $A['EXPDT'];
                $DT = $A['DT'];
                $WID = $A['WID'];
                $WH = $this->tables->get_wh_by_id($WID);
                $ENNAME= $WH['ENNAME'];
                $ARNAME= $WH['ARNAME'];
                $WUNIT= $WH['WUNIT'];
                $WUNITSIZE= $WH['WUNITSIZE'];
                $OPTIONS =<<<LMX
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                التفاصيل
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/Admin/store/edit/$ID">تعديل</a>
                <a class="dropdown-item" href="/Admin/store/unlink/$ID">خذف</a>

                <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                <a class="dropdown-item" href="#">Separated link</a>
              </div>
            </div>

LMX;
                $VIEW .= <<<XML
                <tr>
                    <td>
                    <span >$ID</span><span ><input type='checkbox' class='form-control' name='ID' value='$ID' data-wid='$WID' data-sid="$ID" /></span>
                    </td>
                    <td>
                        <strong class='h4'>
                            $ENNAME
                        </strong>
                        :
                        <strong class=' text-bold h4'>
                            $ARNAME
                        </strong>
                    </td>
                    <td>
                        $QTY
                    </td>
                    <td>
                    $PRICE
                    </td>
                    <td>
                    $TP
                    </td>
                    <td>
                    $EXPDT
                    </td>
                    <td>
                    $DT
                    </td>
                    <td>
                        $OPTIONS
                    </td>

                </tr>


XML;
            }
            $VIEW .="</tbody></table></div>";
            return $VIEW;
        }
        public function render_store_edit($id)
        {
            $A = $this->tables->get_store_by_id($id)[0];
            $QTY = $A['QTY'];
            $TP = $A['TP'];
            $PRICE = $A['PRICE'];
            $EXPDT  = $A['EXPDT'];
            $VIEW =<<<EDIT_FORM
            <form method="POST" action = "/Input/edit/store/1">
                <div>
                <!    -------------QTY----------------  !-->
                    <div class='input-group mb-2'  >
                        <input type='text' class='form-control' name='QTY'  required='required' value='$QTY'  />
                        <div class='input-group-append'>
                            <div class='input-group-text'>
                                QTY
                            </div>
                        </div>

                    </div>
                <!    --------------PRICE---------------  !-->
                    <div class='input-group mb-2'  >
                        <input type='text' class='form-control' name='PRICE'  required='required' value='$PRICE'  />
                        <div class='input-group-append'>
                            <div class='input-group-text'>
                                PRICE
                            </div>
                        </div>

                    </div>
                    <!    --------------Total PRCIE---------------  !-->
                    <div class='input-group mb-2'  >
                        <input type='text' class='form-control' name='TP' required='required' value='$TP'  />
                        <div class='input-group-append'>
                            <div class='input-group-text'>
                                TOTAL PRICE
                            </div>
                        </div>

                    </div>
                    <!    -------------EXP----------------  !-->
                    <div class='input-group mb-2'  >
                        <input type='text' class='form-control' name='EXPDT' value='$EXPDT'  />
                        <div class='input-group-append'>
                            <div class='input-group-text'>
                            EXPIRATION
                            </div>
                        </div>

                    </div>
                    <!    -----------------------------  !-->
                    <input type='submit' class='btn btn-lg form-control btn-dark' value='استمرار' />
                </div>
            </form>


EDIT_FORM;
            return $VIEW;
        }
        public function render_store_add()
        {
            $wh_list_box ="<select name='wid' class='select form-control text-center'>";
            $wh = $this->tables->get_all_wh();
            foreach($wh as $A){
                $V = $A['ID'];
                $N = $A['ENNAME']  . ":". $A['ARNAME'];
                $wh_list_box .= "<option value='$V'>$N</option>\n";
            }
            $wh_list_box.="</select>";
            $VIEW = <<<XMLV

            <form method='POST' action="/Input/add/store">
            <div>

                    <p class='h4 text-info bg-dark'>
                        اضافة كمية جديدة / شحنة جديدة
                    </p>
                    <div class='input-group'>
                            $wh_list_box
                            <div class='input-group-append'>

                                    <Div class='input-group-text'>
                                    المنتج
                                    </div>
                            </div>
                    </div>
                    <div class='input-group'>
                            <input type='number' required='required' onchange='tp_calc();' id='store_add_qty' name='qty' class='form-control input-lg' placeholder='1,2,3,4,5,50'   />

                            <div class='input-group-append'>

                                    <Div class='input-group-text'>
                                        الكمية
                                    </div>
                            </div>
                    </div>
                    <div class='input-group'>
                            <input type='number' required='required' step='any' onchange='tp_calc();' name='price' id='store_add_price' class='form-control input-lg' placeholder='10%,200$,500$,505.50$'   />

                            <div class='input-group-append'>
                                    <Div class='input-group-text'>
                                        سعر الوحدة
                                    </div>
                            </div>
                    </div>
                    <div class='input-group'>
                            <input type='text' required='required' step='any' onchange='tp_calc();' name='tp' id='store_add_tp' disabled class='form-control input-lg' placeholder='$$$$$'   />

                            <div class='input-group-append'>

                                    <Div class='input-group-text'>
                                        السعر كاملاً
                                    </div>
                            </div>
                    </div>
                    <div class='input-group'>
                            <input type='Date' required='required' name='expdt' class='form-control input-lg' placeholder='2020-05-23 10:55:33'   />

                            <div class='input-group-append'>

                                    <Div class='input-group-text'>
                                          الوقت و التاريخ
                                    </div>
                            </div>
                    </div>


                        <input type='submit' value='اضافة' class='btn btn-info  form-control' />

            </div>
            </form>


XMLV;
        return $VIEW;
        }
        public function render_store_unlink($id)
        {

            $A = $this->tables->get_store_by_id($id)[0];
            $WID = $A['WID'];
            $ENNAME = $this->tables->get_wh_by_id($WID)['ENNAME'];
            $ARNAME =  $this->tables->get_wh_by_id($WID)['ARNAME'];
            $PIC =  $this->tables->get_wh_by_id($WID)['PIC'];
            $QTY = $A['QTY'];
            $TP = $A['TP'];
            $PRICE = $A['PRICE'];
            $EXPDT  = $A['EXPDT'];
            $VIEW = <<<VIEW
            <form method="POST" action="/Input/unlink/store/$id">
                <div class='container'>
                    <div class='row'>
                        <div class='col-md-6 col-xs-12 col-sm-12'>
                        <table class='table table-striped'>
                            <tr>
                                <td>
                                    اسم العنصر
                                </td>

                                <td>
                                    $ENNAME:$ARNAME
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    الكمية
                                </td>

                                <td>
                                    $QTY
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    سعر الوحدة
                                </td>

                                <td>
                                    $PRICE
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    الاجمالي
                                </td>

                                <td>
                                    $TP
                                </td>

                            </tr>


                        </table>

                        </div>
                        <div class='col-md-6 col-xs-12 col-sm-12 bg-dark'>
                        <img src='$PIC' class='image-thumbnail rounded text-center bg-dark ' />

                        </div>

                    </div>
                    <div class='row text-center'>
                    <div class='col-md-12'>
                هل انت متاكد من انك تود حذف هذا العنصر من المخزن
                    </div>
                    </div>
                    <input type='submit' value='OK' class='btn btn-success form-control' />
                </div>
            </form>
VIEW;
            return $VIEW;
        }


}

?>
