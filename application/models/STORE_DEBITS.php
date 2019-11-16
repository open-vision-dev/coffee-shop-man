<?PHP
class STORE_DEBITS  extends CI_Model
{
    public function __consutrct()
    {
        parent::__construct();
        $this->load->model("MyTables",'tables');
    }
    public function render_add_debits()
    {
        $VIEW =<<<XML
        <style>
            div.input-group {
            margin-bottom:1.05rem;
            }
        </style>
        <form method='POST' action='/Input/add/store_debits/'>
            <div>
            <div class='input-group'>
                    <div class='input-group-append'>
                            <div class='input-group-text'>
                                Lender Name
                            </div>
                    </div>
                    <input type='text' name='LENDER'  class='form-control ' />
            </div>

            <div class='input-group'>
                    <div class='input-group-append'>
                            <div class='input-group-text'>
                                مبلغ السداد
                            </div>
                    </div>
                    <input type='number' step='(any)' name='AMT' class='form-control ' />
            </div>
            <div class='input-group'>
                    <div class='input-group-append'>
                            <div class='input-group-text'>
                                Description
                            </div>
                    </div>
                    <textarea type='text'  name='ddesc' class='form-control ' ></textarea>
            </div>
            <div class='input-group'>
                    <div class='input-group-append'>
                            <div class='input-group-text'>
                                تاريخ السداد
                            </div>
                    </div>
                    <input type='date'  name='paydate' required='required' class='form-control ' />
            </div>
            <input type='submit' class='btn btn-success form-control my-3' />
        </div>

XML;
    return $VIEW;
    }

    public function render_all_debits($start=null,$end=null)
    {
        $start = ($start == null) ? date("Y-m-")."1" : $start;
        $end = ($end == null) ? date("Y-m-")."31" : $end;
        $debits_list  =  $this->tables->get_store_debits_interval_info($start,$end);
        //var_dump("<pre>",$debits_list,$this->tables->db);
        $debits_table = <<<DEBTABLE
        <table    id='dataTable' class='table table-striped'>
            <thead>
                <td>NO</td>
                <td>NAME</td>
                <td>AMT</td>
                <td>DDESC</td>
                <td>STATUS</td>
                <td>DT</td>
                <td>PAYDATE</td>
                <td> menu</td>

            </thead>

        <tbody>
DEBTABLE;
        $NO  = 0;
        foreach($debits_list as $D)
        {
            $NO++;
            $DID = $D['ID'];
            $AMT = $D['AMT'];
            $LENDER = $D['LENDER'];
            $DDESC = $D['DDESC'];
            $PAID = $D['PAID'];
            $PAIDDT = $D['PAIDDT'];
            $PAYDATE = $D['PAYDATE'];
            $STATUS = ($D['PAID'] == TRUE) ?  "تم الدفع ". "<br />"."<span class='badge badge-lg badge-info'>$PAIDDT</span>":"لم يتم الدفع";
            $DT = $D['DT'];
            $disable = ($PAID == TRUE) ?  "disabled='disabled'" : "";
            $menu = <<<MENU
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                الخيارات
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <a class="dropdown-item" href='/Admin/store_debits/pay/$DID' $disable >سداد</button>
                <a class="dropdown-item" href='/Admin/store_debits/update/$DID'>update</button>
                <a class="dropdown-item" href='/Admin/store_debits/unlink/$DID'>ازالة المديونية</button>
              </div>
            </div>
MENU;

            $debits_table .=<<<RWO
                <tr>
                    <td>$NO</td>
                    <td>$LENDER</td>
                    <td>$AMT</td>
                    <td>$DDESC</td>
                    <td>$STATUS</td>
                    <td>$DT</td>
                    <td>$PAYDATE</td>
                    <td  class='text-center'>
                    $menu
                    </td>
                </tr>

RWO;
        }
        $debits_table ."</tbody></table>";
        $VIEW =<<<XML
        <form method="POST" action="/Admin/store_debits/all">
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
    public function render_pay_debits($id)
    {
        $INFO = $this->tables->get_store_debits_by_id($id)[0];
        $PAYDATE = $INFO['PAYDATE'];
        $LENDER = $INFO['LENDER'];
        $PAID = $INFO['PAID'];
        $AMT = $INFO['AMT'];
        $DDESC = $INFO['DDESC'];
        $warning =($PAID) ?  "<p class='h4 text-center text-danger text-bold'>هذه المديونية تم سدادها</p>" : "";
        $disabled = ($PAID) ? "disabled='disabled'"  : "";
        $VIEW =<<<XML
        <style>
            div.input-group {
            margin-bottom:1.05rem;
            }
        </style>
            $warning
        <div>
                <form method='POST' action='/Input/pay/store_debits/$id'>
                    <div class='input-group'>
                            <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        Lender Name
                                    </div>
                            </div>
                            <input type='text' disabled='disabled' value='$LENDER' class='form-control ' />
                    </div>
                    <div class='input-group'>
                            <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        Amount
                                    </div>
                            </div>
                            <input type='text' disabled='disabled'value='$AMT' class='form-control ' />
                    </div>
                    <div class='input-group'>
                            <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        مبلغ السداد
                                    </div>
                            </div>
                            <input type='no' disabled='disabled' step='(any)' name='AMT' value='$AMT' class='form-control ' />
                    </div>
                    <div class='input-group'>
                            <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        Description
                                    </div>
                            </div>
                            <input type='text' disabled='disabled' value='$DDESC' class='form-control ' />
                    </div>
                    <div class='input-group'>
                            <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        التاريخ السابق كان
                                    </div>
                            </div>
                            <input type='text'  disabled='disabled' value='$PAYDATE' required='required' class='form-control ' />
                    </div>

                    <input type='submit' $disabled class='btn btn-lg form-control btn-success ' value='Send' />

                </form>

        </div>
XML;
    return $VIEW;
    }
    public function render_edit_debits($id)
    {
        $INFO = $this->tables->get_store_debits_by_id($id)[0];
        $PAYDATE = $INFO['PAYDATE'];
        $LENDER = $INFO['LENDER'];
        $AMT = $INFO['AMT'];
        $warning =($INFO['PAID']) ?  "<p class='h4 text-center text-danger text-bold'>هذه المديونية تم سدادها</p>" : "";
        $disabled = ($INFO['PAID']==TRUE) ? "disabled='disabled'" : "";
        $DDESC = $INFO['DDESC'];
        $VIEW =<<<XML
        <style>
            div.input-group {
            margin-bottom:1.05rem;
            }
        </style>
        <script type='text/javascript'>
            function calc_store_debit_left()
            {

            var paynow = parseFloat(\$('#paynow').val());
            var debit = parseFloat(\$('#amt').val());
            var left = debit - paynow;
            if(left > 0){
                $('#leftdisabled').val(left);
                $('#left').val(left);
                console.log(paynow)
                console.log(debit)
                console.log(left)
            }
            else if(left == 0)
            {
                var msg = "اذا كنت تريد سداد كامل فاختار سداد من الشاشة الرئيسية";
                window.alert(msg);
                $('#left').val('$AMT')
                $('#leftdisabled').val('$AMT')
                $('#paynow').val('0');
            }
            else if(left < 0 ){
                var msg = "المبلغ اكبر من المديوينة الحالية ";

                $('#left').val('$AMT')
                $('#leftdisabled').val('$AMT')
                $('#paynow').val('0');
                window.alert(msg);

            }
            }
        </script>
        <div>
            <div class='row'>

                    <div class='col-md-6'>
                        <div class='input-group'>
                                <input onblur='calc_store_debit_left();' type='number' class='form-control input-lg' id='paynow' placeholder='المبلغ المراد سداده' />
                                <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        المبلغ الحالي للسداد
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='input-group'>
                                <input type='number' disabled='disabled' class='form-control input-lg' value='$AMT' id='amt' placeholder='المبلغ المراد سداده' />
                                <div class='input-group-append'>
                                    <div class='input-group-text'>
                                    المبلغ المطلوب
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class='input-group'>
                                <input type='number' disabled='disabled' class='form-control input-lg' value='$AMT' id='leftdisabled' placeholder='المبلغ المراد سداده' />
                                <div class='input-group-append'>
                                    <div class='input-group-text'>
                                            المديونية الجديدة
                                </div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
        <div>
                $warning
                <form method='POST' action='/Input/edit/store_debits/$id'>
                    <div class='input-group'>
                            <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        Lender Name
                                    </div>
                            </div>
                            <input type='text' name='LENDER' value='$LENDER' class='form-control ' />
                    </div>
                    <div class='input-group'>
                            <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        Amount
                                    </div>
                            </div>
                            <input type='text' id='left' name='AMT' value='$AMT' class='form-control ' />
                    </div>
                    <div class='input-group'>
                            <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        Description
                                    </div>
                            </div>
                            <input type='text' name='DDESC' value='$DDESC' class='form-control ' />
                    </div>
                    <div class='input-group'>
                            <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        التاريخ السابق كان
                                    </div>
                            </div>
                            <input type='text'  disabled='disabled' value='$PAYDATE' required='required' class='form-control ' />
                    </div>
                    <div class='input-group'>
                            <div class='input-group-append'>
                                    <div class='input-group-text'>
                                        Pay Date
                                    </div>
                            </div>
                            <input type='date' name='PAYDATE' required='required' class='form-control ' />
                    </div>
                    <br />
                    <input type='submit' $disabled class='btn btn-lg form-control btn-success ' value='Send' />

                </form>

        </div>
XML;
    return $VIEW;
    }
    public function render_unlink_debits($id)
    {
        $INFO = $this->tables->get_store_debits_by_id($id)[0];
        $PAYDATE = $INFO['PAYDATE'];
        $LENDER = $INFO['LENDER'];
        $AMT = $INFO['AMT'];
        $DT = $INFO['DT'];


        $VIEW =<<<XML

        <div >
            <h1>
                هل انت تريد حذف بيانات هذه المديونية
            </h1>
            <table class='table table-dashed '>
                    <thead>
                        <td>Name</td>
                        <td>Info</td>
                    </thead>
                    <tbody>
                        <tr>
                            <Td>اسم الدائن</td>
                            <Td>$LENDER</td>
                        </tr>
                        <tr>
                            <Td>المبلغ</td>
                            <Td>$AMT</td>
                        </tr>
                        <tr>
                            <Td>التاريخ</td>
                            <Td>$DT</td>
                        </tr>
                        <tr>
                            <Td>تاريخ السداد</td>
                            <Td>$PAYDATE</td>
                        </tr>
                    </tbodya>
            </table>
            <a href='/Input/unlink/store_debits/$id' class='btn btn-success form-control mb-3 '>
                ازالة المديوينة
            </a>
            <a href='/Admin/store_debits/all' class='btn btn-danger form-control'>
                undo
            </a>
            تراجع
            </a >
        </div>
XML;
    return $VIEW;
}
}
?>
