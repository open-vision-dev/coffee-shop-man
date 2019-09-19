<?php
defined("BASEPATH") OR exit("No Script Transpassing allowed");
class EXPT extends CI_Model{
  public function __construct()
  {
    $this->load->model("MyTables","tables");
  }

public function render_expt_add(){
  $VIEW = <<<A
  <div class=''>
      <form method="POST" action="/Input/expt/add">
      <div class='input-group'>
          <input type='number' name='LVL' />
          <div class='input-group-append'>
          <span class='input-group-text fa fa-numbers'>&nsbp;&nsbp;&nsbp;&nsbp;</span>
          LEVEL/PRIORITY
          </div>
      </div>
      <div class='input-group'>
          <input type='text' name='NAME' />
          <div class='input-group-append'>
          <span class='input-group-text fa fa-numbers'>&nsbp;&nsbp;&nsbp;&nsbp;</span>
          NAME
          </div>
      </div>
      <input type='submit ' value='CONTINUE' class='btn btn-success form-control' />


      </form>
  </div>


A;
  return $VIEW;
  }
  public function render_expt(
      )
      {
          //$this->tables->
      }

}
?>
