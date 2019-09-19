<?PHP
defined("BASEPATH") OR exit("No Script TransPassing! idiots");
class Orders extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MyTables','tables');
    }
    public function render_search_form()
    {
        $VIEW =<<<F
        <form method="POST" action="/Admin/orders/all/">
        <div class='row mb-4'>


            <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6  rounded-top '>
            <p for='date_start' class='text-center text-succes '>
            من
                </p>
            <input type='date' id='begin' name='start' placeholder='بداية البحث' required='required' class='form-control' />

            </div>
            <div class='col-xs-5 col-sm-5 col-md-5 '>
            <p for='date_start' class='text-center text-succes '>
            الي</p>
            <input type='date' id='end' placeholder='نهاية البحث' name='end' required='required' class='form-control'>

            </div>
            <input type='submit' value='بحث' class='my-2 btn btn-success form-control' />
            </form>
        </div>


F;
    return $VIEW;
    }
    public function render_hidden_orders_table($data)
    {


        $VIEW =<<<T
        <div class='modal hidden'>
            <table id='invoicetable'  borderd='5px ' class=''  style='border:10px ;' >
                <thead>
                    <td>Item</td>
                    <td>INFO</td>
                </thead>
                <tbody>
T;
    foreach($data as $A)
    {
        $C = count($data);
        @$NAME = $this->tables->get_meals_by_id($A['MID'])[0]['NAME'];
        $P = $A['PRICE'];
        $TP = $A['TP'];
        $QTY = $A['QTY'];
        $VIEW.= <<<thead
            <tr>
                <td>NAME :</td>
                <td>$NAME</td>
            </tr>
            <tr>
                <td>COUNT :</td>
                <td>$C</td>
            </tr>
            <tr>
                <Td>PRICE :</td>
                <td>$P</td>
            </tr>
            <tr>
                <Td>TOTAL :</td>
                <td>$TP</td>
            </tr>
            <tr>
                <Td>QTY :</td>
                <td>$QTY</td>
            </tr>

thead;
    }
    $VIEW.= "</tbody></table></div>";
    return $VIEW;
    }
    public function render_orders_info($ID)
    {
        $data = $this->tables->get_order_info_by_id($ID);
        $VIEW = <<< TABLE
        <div>
        <a href='#' onclick='printJS("invoicetable","html")' class='btn btn-success form-control mb-3'>
        طباعة الفاتورة
        </a>
        <table class='table table-striped' id='dataTables'>
            <thead>
                    <td>ID</td>
                    <td>NAME</td>
                    <td>QTY</td>
                    <td>PRICE</td>
                    <td>Total Price</td>

            </thead>
TABLE;
        foreach($data as $A){
            $ID = $A['ID'];
            @$NAME = $this->tables->get_meals_by_id($A['MID'])[0]['NAME'];
            $QTY = $A['QTY'];
            $PRICE = $A['PRICE'];
            $TP = $A['TP'];
            $VIEW .=<<<TABLES
                <tr>
                    <td>$ID</td>
                    <td class='text-success'>$NAME</td>
                    <td class='text-info'>$QTY</td>
                    <td class='text-danger'>$PRICE</td>
                    <td class='text-danger'>$TP</td>
                </tr>
TABLES;
        }
       $VIEW .= "</tbody></table></div>";
       $VIEW .= $this->render_hidden_orders_table($data);
       return $VIEW;
    }
    public function render_orders_all($parm1,$parm2)
    {
        $VIEW =$this->render_Search_form();
        $parm1= ($parm2 == null) ? date("Y-m-d h:i:s",time()-(3600*24*2)): $parm1;
        $parm2= ($parm2 == null) ? date("Y-m-d h:i:s") : $parm2;
        $data = $this->tables->get_orders_by_interval($parm1,$parm2);
        $VIEW .= $this->pretty_orders_table($data);
        return $VIEW;

    }
    public function render_orders_print()
    {

    }
    public function render_orders_add()
    {
        $data = $this->tables->get_all_meals();
        foreach($data as $meow)
        {
            
        }
        $VIEW =  <<<XML
        <div class=''>
                <span >
                        Hello World
                </span>
        </div>
XML;
        return $VIEW;
    }
    public function pretty_orders_table($data)
    {
        $VIEW = <<<TABLE
        <div>
        <table class='table table-striped' id='dataTables'>
            <thead>
                <td>ID</td>

                <td>ITEMS Count</td>
                <Td>TOTAL</td>
                <td>DATE</td>
                <td>Options</td>
            </thead>
            <tbody>
TABLE;
        foreach($data as $item){
            $TOTAL = $item['AMT'];
            $ID = $item['OID'];
            $COUNT = $this->tables->get_orders_counts($ID);
            $DT  = $item['DT'];
            $OPT = <<<MENU
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                خيارات
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="/Admin/orders/info/$ID/">التفاصيل</a>
              <a class="dropdown-item" href="/Admin/orders/print/$ID/">طباعة</a>
                <a class="dropdown-item" href="/Admin/orders/edit/$ID/">تعديل</a>
                <a class="dropdown-item" href="/Admin/orders/unlink/$ID/">حذف</a>
              </div>
            </div>
MENU;
        $VIEW.= <<<PRETTY
            <tr>
                <td>$ID</td>
                <td>$COUNT</td>
                <td>$TOTAL</td>
                <td>$OPT</td>
                <td>$DT</td>

            </tr>
PRETTY;
        }
        $VIEW.="</table></div>";
        return $VIEW;
    }

}


?>
