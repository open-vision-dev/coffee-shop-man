<?PHP
class WORKERS_DEBITS extends CI_Model
{
    public function __consutruct()
    {
            parent::__consutruct();
            $this->load->model("MyTables","tables");
    }
    public function render_add_debits()
    {
        $W = $this->tables->get_all_workers();
        $W_LIST = "<select name='WID' class='form-control '>";
        foreach($W as $WK)
        {
            $NAME = $WK['NAME'];
            $ID = $WK['ID'];
            $W_LIST .= "<option value='$ID'>$NAME</option>";
        }
        $W_LIST .= "</select>";
        $VIEW =<<<XML
        <style>
            div.input-group {
            margin-bottom:1.5rem;
            }

        </style>
        <form method='POST' action='/Input/add/workers_debits/'>
        <div class='input-group'>
                <div class='input-group-append'>
                    <div class='input-group-text'>
                            NAME
                    </div>
                </div>
                $W_LIST

        </div>
        <div class='input-group'>
                <div class='input-group-append'>
                    <div class='input-group-text'>
                            PRICE
                    </div>
                </div>
                <input type='number' class='form-control' name='PRICE' />

        </div>
        <input type='submit' class='form-control btn-lg btn-success my-3 mb-3' value='continue'/>
    </form>
XML;
        return $VIEW;
    }
    public function render_all_debits($start=null,$end=null)
    {
        $start=($start == null) ? date("Y-m-")."1" : $start;
        $end=($end == null) ? date("Y-m-")."31" : $end;
        $NO = 0;
        $all_debits =$this->tables-> get_workers_debits_interval_info_noid($start,$end);
        $debits_table = "<table class='table table-striped' id='dataTable'><thead><td>No</td><td>NAME</td><td>AMT</td><td>Date</td><td></td></thead><tbody>";
        foreach($all_debits as $D)
        {
            $NO++;
            $XID = $D['WID'];
            $DID = $D['ID'];
            $NAME = $this->tables->get_workers_by_id($D['WID'])[0]['NAME'];
            $AMT = $D['AMT'];
            $DT = $D['DT'];
            $debits_table .= <<<LLL
            <tr>
                <td>$NO</td>
                <td><a href='/Admin/workers/info/$XID'>$NAME</a></td>
                <td>$AMT</td>
                <td>$DT</td>
                    <td><a  class='btn btn-danger' href='/Admin/workers_debits/unlink/$DID'>Remove</a></td>
            </tr>
LLL;
        }
        $debits_table.= "</table>";
        $VIEW =<<<XML
        <form method="POST" action="/Admin/workers_debits/all">
        <div>
        <div class='row'>
        <style>
        div.row div {
            margin-bottom:1.1rem;
        }
        </style>

                <div class='col-md-6'>
                    from
                    <input type='date' class='form-control' name='start' />
                </div>
                <div class='col-md-6'>
                    to
                    <input type='date' class='form-control' name='end'/>
                </div>
                <div class='col-md-12'>
                    <input type='submit' class='form-control btn btn-lg btn-success fa fa-search ' value='search' />
                </div>


        </div><!-- end row !-->
        <div >
            <p class='h4 text-danger text-center'>
                يتم عرض النتائج للفترة من
                <br />
                <span class='badge badge-lg badge-primary'>$start </span>
                <br />
                الي

                <span class='badge bdage-lg badge-primary'>$end </span>
            </p>
            $debits_table
        </div>
    </div><!-- end main div !-->
</form>

XML;
        return $VIEW;
    }
    public function render_unlink_debits($ID)
    {

        $D = $this->tables-> get_workers_debits_by_id($ID)[0];
        $NAME = $this->tables->get_workers_by_id($D['WID'])[0]['NAME'];
        $DT = $D['DT'];
        $AMT  = $D['AMT'];
        return <<<XML
        <p class='text-center h4 text-danger'>هل انت متأكد من انك تود حذف بيانات هذه المديونية/سلفية ؟</p>
        <table class='table table-striped'>
            <tbody>
                <tr>
                    <td>$NAME</td>
                    <td>$AMT</td>
                    <td>$DT<td>
                </tr>
            </tbody>
        </table>
        <br />
        <a href='/Input/unlink/workers_debits/$ID' class='btn btn-danger mb-3 form-control ' >
            continue
        </a>
        <a href='/Admin/workers/all' class='btn btn-success form-control'>
            undo
        </a>
XML;
    }
}
?>
