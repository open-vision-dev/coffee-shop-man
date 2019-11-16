<?PHP
    class USED_ITEMS extends CI_MODEL

{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('MyTables','tables');
        }
        public function render_used_items_all($start=null,$end=null,$item=null)
        {
            $start = ($start == null) ? date('Y-m-d',(time()-(3600*24))) : $start;
            $end   = ($end == null) ? date('Y-m-d ',time()+3600*24) : $end;
            $A = ($item == null) ? $this->tables->get_used_items_by_interval($start,$end) : $this->tables->get_used_items_by_interval_whid($start,$end,$item);
            $VIEW = <<<HEADER
            <form method="POST" action="/Admin/used_items/all/">
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
            <div>

                <table class='table table-dashed'>
                    <thead>
                    <td></td>
                    </thead>

                </table>
            </div>
            <div>
            يتم عرض النتائج من الفترة
            $start
            الي
            $end


            </div>
            <table class='table table-striped' id='dataTable'>
                <thead>
                    <td><input class='form-control' type='checkbox' id='used_items_all_markall' /></td>
                    <td>DATe</td>
                    <td>ID</td>
                    <td>NAME</td>
                    <td>PIC</td>
                    <td>QTY</td>
                    <td>REMOVE</td>

                </thead>
                <tbody>
HEADER;
            foreach($A as $B)
            {


                $NAME = $B['ARNAME'].' - '.$B['ENNAME'];
                $PIC = $B['PIC'];
                $ID = $B['ID'];
                $WHID = $B['WHID'];
                $QTY =$B['QTY'];
                $DT = $B['DT'];
                $VIEW .= <<<XML
                <tr >
                    <td><input class='form-control' type='checkbox' value='$ID' /></td>
                    <td>$DT</td>
                    <td>$ID</td>
                    <td>$NAME</td>

                    <td><img src='$PIC' /></td>
                    <td>$QTY</td>
                    <td><a href='/Admin/used_items/remove/$ID' class='btn btn-danger '>Remove</a></td>
                </tr>
XML;
            }
            $VIEW .= "</table>";

        return $VIEW;
        }

        public function render_used_items_add()
        {
            $store = $this->tables->get_distinct_store_whid();
            $sel="<select name='WHID' class='form-control select'>";
            foreach($store as $A)
            {
                $NAME = $A['ARNAME'] . $A['ENNAME'];
                $ID = $A['ID'];
                $sel .="<option value='$ID'>$NAME</option>";
            }
            $sel .="</select>";
            $VIEW =<<<RO
            <div >
                <form method="POST" action="/Input/add/used_items">
                <p class='h3 text-info text-center'>
                الاسم
                </p>
                $sel
                <p class='h4 text-info text-center'>
                الكمية
                </p>
                <input type='number' class='form-control text-center mb-3' name='QTY' />
                <input type='submit' class='btn btn-info form-control' />
                </form>
            </div>
RO;
            return $VIEW;
        }
        public function render_used_items_unlink($id)
        {
            return <<<VIEW
            <div>
                <h1>هل انت متاكد من انك تود حذف هذا العنصر</h1>
                <br />
                <a href='/Input/unlink/used_items/$id' class='btn btn-warning btn-lg form-control'>استمرار</a>
                <a href='/Admin/used_items/all' class='btn btn-success btn-lg my-3 mb-3 form-control'>تراجع</a>
            </div>

VIEW;
        }
        
        public function render_remove()
        {

        }
}
?>
