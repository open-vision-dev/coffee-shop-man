<?PHP
class Workers extends CI_Model
{
    public function __consutruct()
    {
        parent::__construct();
    }
    public function render_workers_all()
    {
        $W= $this->tables->get_all_workers();
        $VIEW = <<<LL
        <div>
            <table class='table table-striped'>
                <thead>
                    <td>ID</td>
                    <Td>NAME</td>
                    <td>JOB</td>
                    <td>TEL</td>
                    <td>TEL2</td>
                    <td>Options</td>
                </thead>
LL;
    foreach($W as $WK)
        {
            $NAME = $WK['NAME'];
            $TEL = $WK['TEL'];
            $TEL2 = $WK['TEL2'];
            $ID= $WK['ID'];
            $JOB = $this->tables->get_jobs_by_id($WK['JOB_ID'])[0]['JTITLE'];
            $Options = <<<LMA
            <div class="btn-group">
              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                الاعدادات
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/Admin/workers/edit/$ID">تعديل</a>
                <a class="dropdown-item" href="/Admin/workers/unlink/$ID">حذف الوظيفة</a>

                <div class="dropdown-divider"></div>

                <a class='dropdown-item' href='/Admin/workers/info/$ID'>المرتب و السلفيات</a>
              </div>
            </div
LMA;
            $VIEW .=<<<XMLA
            <tr>
                <td>$ID</td>
                <Td>$NAME</td>
                <td>$JOB</td>
                <td>$TEL</td>
                <td>$TEL2</td>
                <td>$Options</td>
            </tr>
XMLA;
        }
        $VIEW.= "</tbody></table></div>";
    return $VIEW;
    }
    public function render_workers_add()
    {
        $jobs = $this->tables->get_all_jobs();
        $jdata = "<select class='form-control input-lg select' name='JID' ></>";
        foreach($jobs as $j)
        {
            $JID = $j['JID'];
            $JTITLE = $j['JTITLE'];
            $jdata .= "<option value='$JID'>$JTITLE</option>";
        }
        $jdata.="</select>";
        $VIEW =<<<LMX
        <style>
        div.input-group
        {
            margin-bottom:0.5rem;
        }
        </style>
            <div >
                <form method='POST' action='/Input/add/workers'>
                <div class='input-group'>
                    <div class='input-group-append'>
                        <div class='input-group-text'>
                        الاسم
                        </div>
                    </div>
                    <input type='text' class='form-control' name='NAME'/>
                </div>
                <div class='input-group'>
                    <div class='input-group-append'>
                        <div class='input-group-text'>
                        الوظيفة
                        </div>

                    </div>
                $jdata
                </div>
                <div class='input-group'>
                    <div class='input-group-append'>
                        <div class='input-group-text'>
                        هاتف 1
                        </div>

                    </div>
                    <input type='text' class='form-control' name='TEL1'/>
                </div>
                <div class='input-group'>
                    <div class='input-group-append'>
                        <div class='input-group-text'>
                          هاتف2
                        </div>

                    </div>
                    <input type='text' class='form-control' name='TEL2'/>
                </div>
                <input type='submit' class='form-control btn-lg my-3 btn btn-success' value='اضافة' />
            </div>
            </form>
LMX;
        return $VIEW;
    }
    public function render_workers_unlink($id)
    {
        $wdata = $this->tables->get_workers_by_id($id)[0];
        $NAME = $wdata['NAME'];
        $tel = $wdata['TEL'];
        $tel2 = $wdata['TEL2'];
        #@TODO add job name to the table get_all_store
        $VIEW=<<<OOP
        <div >
        <p class='h4'>هل انت متاكد من انك تريد حذف هذا الموظف</p>
            <table class='table table-striped'>
                <tr>
                    <td>NAME</td>
                    <td>$NAME</td>
                </tr>
                <tr>
                    <td>TEL1</td>
                    <td>$tel</td>
                </tr>
                <tr>
                    <td>TEL2</td>
                    <td>$tel2</td>
                </tr>

            </table>
            <a href='/input/unlink/workers/$id' class='btn btn-lg form-control btn-warning mb-3'>
            استمرار
            </a>
            <a href='/Admin/workers/all' class='btn btn-lg form-control btn-info'>
            تراجع
            </a>

        </div>
OOP;
    return $VIEW;
    }
    public function render_workers_edit($id)
    {
        $wdata = $this->tables->get_workers_by_id($id)[0];
        $jobs = $this->tables->get_all_jobs();
        $jdata = "<select class='form-control input-lg select' name='JID' ></>";
        foreach($jobs as $j)
        {

            $JID = $j['JID'];
            $JTITLE = $j['JTITLE'];
            $match = $JID == $wdata['JOB_ID'];
            $jdata  .= ($match) ?   "<option selected='selected' value='$JID'>$JTITLE</option>" : "<option value='$JID'>$JTITLE</option>";
        }
        $jdata.="</select>";
    //    var_dump($wdata);
        $name = $wdata['NAME'];
        $tel = $wdata['TEL'];
        $tel2 = $wdata['TEL2'];
        $VIEW =<<<LOREM
        <form method='POST' action='/Input/edit/workers/$id'>
        <div class='input-group'>
            <div class='input-group-append'>
                <div class='input-group-text'>
                الاسم
                </div>
            </div>
            <input type='text' class='form-control' value='$name' name='NAME'/>
        </div>
        <div class='input-group'>
            <div class='input-group-append'>
                <div class='input-group-text'>
                الوظيفة
                </div>

            </div>
        $jdata
        </div>
        <div class='input-group'>
            <div class='input-group-append'>
                <div class='input-group-text'>
                هاتف 1
                </div>

            </div>
            <input type='text' class='form-control' value='$tel' name='TEL1'/>
        </div>
        <div class='input-group'>
            <div class='input-group-append'>
                <div class='input-group-text'>
                  هاتف2
                </div>

            </div>
            <input type='text' class='form-control' value='$tel2' name='TEL2'/>
        </div>
        <input type='submit' class='form-control btn-lg my-3 btn btn-success' value='تحديث' />
    </div>
    </form>
    <style>
    div.input-group
    {
        margin-bottom:1.5rem;
    }
    </style>
LOREM;
return $VIEW;
    }
    public function render_workers_info($id,$start=null,$end=null)
    {
        $start =  ($start == null ) ? date("Y-m-d ",(time()-(3600*24*2))) : $start;
        $end = ($end == null) ?  date("Y-m-d",time()+(3600*24*7)) : $end;
        $WINFO = $this->tables->get_workers_by_id($id)[0];
        $SALARY = $this->tables->get_jobs_by_id($WINFO['JOB_ID'])[0]['SALARY'];
        $JOB = $this->tables->get_jobs_by_id($WINFO['JOB_ID'])[0]['JTITLE'];
        $DEBITS = $this->tables->get_workers_debits_interval($id,$start,$end)[0]['TOTAL'];
        $DEBITS = ($DEBITS == NULL ) ? 0 : $DEBITS;

        $CHANGE = $SALARY - $DEBITS;
        $NAME = $WINFO['NAME'];
        $DEBITS_LIST = $this->tables->get_workers_debits_interval_info($id,$start,$end);
        $DEBITS_TABLE = "<table id='dataTable' class='table table-striped mb-3 my-3'><thead><td>AMT</td><td>Date</td></thead><tbody>";

            foreach($DEBITS_LIST as $XDEBITS)
            {
                $AMT = $XDEBITS['AMT'];
                $DT = $XDEBITS['DT'];
                $DEBITS_TABLE .= "<tr><td>$AMT</td><td>$DT</td></tr>";

            }
            $DEBITS_TABLE .= "</tbody></table>";


        $VIEW =<<<XML
        <form method='POST' action='/Admin/workers/info/$id' >
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

                <div >

                </div>
        </div><!-- end row !-->
    </form>
        </div>

        <div>
            <table class='table table-striped'>
                    <tr>
                        <td>ID</td>
                        <td>$id</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>$NAME</td>
                    </tr>
                    <tr>
                        <td>JOB</td>
                        <td>$JOB</td>
                    </tr>
                    <tr>
                        <td>Salary</td>
                        <td>$SALARY</td>
                    </tr>
                    <tr>
                        <td>DEBITS (<span class='badge badge-info'>$start</span>) to (<span class='badge badge-info'>$end</span>)</td>
                        <td>$DEBITS</td>
                    </tr>
                    <tr>
                        <td>CHANGE ($start) to ($end)</td>
                        <td>$CHANGE</td>

                    </tr>
            </table>
            <p class='h3 text-info text-center'>
                جدول السلفيات
            </p>
            $DEBITS_TABLE
        </div>
XML;
    return $VIEW;
    }

}
?>
