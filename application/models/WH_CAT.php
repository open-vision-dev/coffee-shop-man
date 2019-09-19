<?php
defined("BASEPATH") OR exit("No Script Transpassing allowed");
class WH_CAT extends CI_Model{
  public function __construct(){
    $this->load->model("MyTables","tables");
  }
  public function render_wh_cat_add(){
    $VIEW = <<<A
    <div >
        <form method="POST" action="/Input/add/wh_cat">

        <div class='input-group'>
            <input type='text' name='NAME' class='form-control text-center' />

            <div class='input-group-append mb-4 text-center'>
            <span class='input-group-text fa fa-numbers'>            الاسم
</span>
            </div>
        </div>
        <input type='submit'  class='btn btn-success form-control' />


        </form>
    </div>


A;
    return $VIEW;
    }
  public function render_wh_cat_update($id){
    $data = $this->tables->get_wh_cat_by_id($id);
    $NAME = $data['NAME'];
    $ID = $data['ID'];
      $VIEW = <<<VIEW
      <div class=''>
            <form action='/Input/edit/wh_cat/$id' method='POST'>

                <div class='input-group'>
                      <input type='text' class='form-control' name='NAME' value='$NAME' />
                      <div class='input-group-append'>
                            <div class='input-group-text'>
                                  <span class='fa fa-text'>&nbsp;&nbsp;</span>
                                  الاسم
                            </div>

                      </div>
                </div>
                  <input type='submit' class='mb-3 btn btn-success btn-lg form-control rounded'  />
            </form>

      </div>


VIEW;
return $VIEW;
  }
  public function render_wh_cat_all(){
  $data = $this->tables->get_all_wh_cat();
  //var_dump($data);

  $VIEW = <<<V
  <div class=' row '>
      <Div class='col-xs-12 col-md-12 '>
        <table class='table table-striped ' id='dataTable'>
              <thead class='table-success'>
                    <td>
                    الرقم
                    </td>
                    <td>
                     الاسم
                    </td>
                    <td>
                    السلع المسجلة
                    </td>
                    <td>
                     السلع في المخزن
                    </td>
                    <td>
                    <span class='fa fa-gear'</span>
                    </td>

              </thead>



V;
  foreach($data as $X){
    $ID = $X['ID'];
    $NAME = $X['NAME'];
    $PRIMARY_DEFS = $this->tables->get_wh_count_by_cat($ID);
    $STORE_COUNT = $this->tables->get_store_count_by_wid($ID);
    $OPT = <<<OPT
    <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Action
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/Admin/wh_cat/edit/$ID">Edit</a>
          <a class="dropdown-item" href="/Admin/wh_cat/unlink/$ID">REMOVE</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">ITEMS IN Definitions</a>
          <a class="dropdown-item" href="#">ITEMS IN Store</a>
        </div>
    </div>
OPT;
    $VIEW .=  "<tr><Td>". $ID ."</td>" ;
    $VIEW .=  "<Td>". $NAME ."</td>" ;
    $VIEW .=  "<Td>". $PRIMARY_DEFS ."</td>" ;
    $VIEW .=  "<Td>". $STORE_COUNT ."</td>" ;
    $VIEW .=  "<Td>". $OPT ."</td></tr>" ;
  }
  $VIEW.="</table></div></div>";
  return $VIEW;
  }
  public function render_wh_cat_view(){

  }
  public function render_wh_cat_unlink($ID){
      $COUNT = $this->tables->get_wh_count_by_cat($ID);
      $DATA = $this->tables->get_wh_by_cat_id($ID);
      $WHCNAME = $this->tables->get_wh_cat_by_id($ID)['NAME'];
     $VIEW=<<<M
     <div class='text-center code well well-info'>

     هل انت متاكد من انك تريد ازالة هذا الصنف
     <span >
     $WHCNAME
     </span>

M;
      $visible = "hidden";
      $msg ="";
      if($COUNT > 0){
          $visible="";
          $wh_list_view ="<div class='col-xs-12 col-md-12 card ' >\n<ul class='list-group list-group-flush text-center align-self-center'>";
          foreach($DATA as $I){
             $NAME = $I['ENNAME'];
             $ARNAME = $I['ARNAME'];
             $QTY = $this->tables->get_store_count_by_wid($I['ID']);

              $wh_list_view .= "<li class='list-group-item'><span class='badge badge-info'>$ARNAME</span> :<span class='badge badge-primary'>$NAME</span>  QTY:<span class='badge badge-success'>$QTY</span>";
          }

      $VIEW .=<<<ML


    <span class='$visible'>
       يوجد



$COUNT
عناصر      مرتبط معه
      </span>
      $wh_list_view

      </div>
ML;
  }
      $VIEW .=<<<NAME
      <div >
            <form method="POST" action="/Input/unlink/wh_cat/$ID/" >
            <p class='code text-center'>

            </p>
                  <div class='input-group'>

                        <div class='input-group-append'>
                            <div class='input-group-text'>
                            الاسم
                            </div>
                        </div>
                        <input type='text' class='form-control disabled' disabled value='$WHCNAME' />
                  </div>

                  <input value='موافق' type='submit' class='mt-3 btn btn-info form-control' />
                  <a href='/Admin/wh_cat/' t class='mt-3 btn btn-danger form-control'>تراجع </a>

            </form>
      </div>
NAME;
      return $VIEW;
  }
}


?>
