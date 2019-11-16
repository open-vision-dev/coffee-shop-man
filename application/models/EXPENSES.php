<?PHP
defined("BASEPATH") or exit("No Script TransPassing!");

    class EXPENSES extends CI_Model
    {
        public function __construct(
        )
        {
            parent::__construct();
            $this->load->model('MyTables','tables');
        }
        public function render_expenses_add
        (
        )
        {
            $expts = $this->tables->get_all_expt();
            $expt_list = "<select class='form-control' name='expt'>";
            foreach($expts as $expt)
            {
                $name = $expt['NAME'];
                $id = $expt['ID'];
                $expt_list .= "<option  value='$id'>".$name."</option>";
            }
            $expt_list.="</select>";
            $VIEW =<<<XMLA
            <form method="POST" action="/Input/add/expenses/">
            <div class='mb-4'>
                    <div class='input-group mb-2'>

                        <input type='text' required='required' name='NAME'  class='form-control'/>
                        <div class='input-group-append'>
                        <div class='input-group-text'>
                            الوصف/الاسم
                            </div>
                        </div>
                    </div>
                    <div class='input-group mb-2'>

                            $expt_list
                            <div class='input-group-append'>
                            <div class='input-group-text'>
                            EXP
                            </div>
                        </div>
                    </div>
                    <div class='input-group mb-2'>

                        <input type='number' step='0.10' required='required' name='amt'  class='form-control'/>
                        <div class='input-group-append'>
                        <div class='input-group-text'>
                            المبلغ
                            </div>
                        </div>
                    </div>


                    <input type='submit' value='اضافة' class='form-control btn btn-success ' />
            </div>

            </form>
XMLA;
        return $VIEW;
        }
        public function render_expenses_all
        ($parm1=null,$parm2=null)
        {

            $parm1= ($parm2 == null) ? expenses_prev_month() : $parm1;
            $parm2= ($parm2 == null) ? expenses_current_month() : $parm2;
            $result = $this->tables->get_expenses_by_interval($parm1,$parm2);
            $total = 0;
            $record_count=count($result);
            foreach($result as $A)
            {
                $total += $A['AMT'];
            }
            $custom_table = <<<TABLE
            <div class='card'>
                <div class='card-header'>
                    <h1 class='text-danger text-center'>
                    جملة المصروفات
                    </h1>
                </div>
                <div class='card-body'>
                <table class='table table-striped'>
                        <thead>
                        <tr>
                            <Td>
                            الفترة من
                            </td>
                            <Td>
                            الفترة الي
                            </td>
                            <Td>
                            عدد السجلات
                            </td>
                            <Td>
                            جملة المبلغ
                            </td>

                        </thead>
                        <tbody>
                                <tr>
                                    <Td>
                                    $parm1
                                    </td>
                                    <Td>
                                    $parm2
                                    </td>
                                    <Td>
                                    $record_count
                                    </td>
                                    <Td>
                                    $total
                                    </td>
                                </tr>
                        </tbody>
                </table>
                </div>
                <div class='card-footer'>
                <a href='/Admin/Reports/expenses/$parm1/$parm2' class='btn btn-primary form-control'>
                    عرض تقرير مفصل
                </a>
                </div>

            </div>
TABLE;
            $VIEW = <<<header
            <form  method="POST" action='/Admin/expenses/search/'>
            $custom_table
            <div class='row mb-4'>


                <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6  rounded-top '>
                <p for='date_start' class='text-center text-succes '>
                من
                    </p>
                <input type='date' id='date_start' name='start' placeholder='بداية البحث' required='required' class='form-control' />

                </div>
                <div class='col-xs-5 col-sm-5 col-md-5 '>
                <p for='date_start' class='text-center text-succes '>
                الي</p>
                <input type='date' id='date_end' placeholder='نهاية البحث' name='end' required='required' class='form-control'>

                </div>
                <input type='submit' value='بحث' class='my-2 btn btn-success form-control' />

            </div>
            </form>
            <table class='table table-striped' id='dataTable'>
                <thead>
                        <td>
                        الرقم
                        </td>
                        <Td>
                        الاسم
                        </td>
                        <td>
                        النوع
                        </td>
                        <td>
                        اليوم
                        </td>
                        <td>
                        التاريخ
                        </td>
                        <td>
                        الخيارات
                        </td>
                </thead>
                <tbody>

header;
            foreach($result as $A)
            {
                $ID  = $A['ID'];
                $NAME = $A['NAME'];
                @$EXPT = $this->tables->get_expt_by_id($A['EXPT'])[0]['NAME'];
                $AMT = $A['AMT'];
                $DT = $A['DT'];
                $OPT =<<<LINE
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    خيارات
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/Admin/expenses/edit/$ID/">تعديل</a>
                    <a class="dropdown-item" href="/Admin/expenses/unl  ink/$ID/">حذف</a>
                  </div>
                </div>

LINE;
                $VIEW .=<<<AMT
                <tr>
                    <td>
                    $ID
                    </td>
                    <Td>
                    $NAME
                    </td>
                    <td>
                    $EXPT
                    </td>
                    <td>
                    $AMT
                    </td>
                    <Td>
                    $DT
                    </td>
                    <td>
                    $OPT
                    </td>
                </tr>


AMT;
            }
            $VIEW.="</tbody></table>";



            return $VIEW;
        }
        public function render_expenses_edit($ID)
        {
            @$data = $this->tables->get_expenses_by_id($ID)[0];
            $expts = $this->tables->get_all_expt();
            $expt_list = "<select class='form-control' name='expt'>";
            $expt_id = $data['EXPT'];
            $name = $data['NAME'];
            $amt = $data['AMT'];
            foreach($expts as $expt)
            {

                $name = $expt['NAME'];
                $id = $expt['ID'];
                $selected = ($data['EXPT']  == $expt['ID']) ? "selected='selected'" : "";
                $expt_list .= "<option $selected value='$id'>".$name."</option>";
            }
            $expt_list.="</select>";
            $VIEW = <<<V
            <div>
            <form method="POST" action='/Input/edit/expenses/$ID/'
            <div class='input-group mb-3'>
                <input type='text' name='name' value='$name' required='required' class='form-control text-center' />
                <div class='input-group-addon'>
                    <div class='input-group-text'>
                    البيان
                    </div>
                </div>
            </div>

            <div class='input-group mb-3'>
                <input type='number' step="any" name='amt' value='$amt' required='required' class='form-control text-center' />
                <div class='input-group-addon'>
                    <div class='input-group-text'>
                    المبلغ
                    </div>
                </div>
            </div>
            <div class='input-group mb-3'>
                $expt_list
                <div class='input-group-addon'>
                    <div class='input-group-text'>
                    التصنيف
                    </div>
                </div>
            </div>
            <input type='submit' class='my-3 btn btn-info form-control text-center' value='تحديث' />
            </div>
            </form>
V;

        return $VIEW;
        }
        public function render_expenses_unlink($EXPENSES_ID)
        {
            @$data = $this->tables->get_expenses_by_id($EXPENSES_ID)[0];
            (count($data) < 1 || is_null($data)) ?  redirect("/Admin/expenses/all") :  NULL;
            $NAME = $data['NAME'];
            $AMT = $data['AMT'];
            $DT = $data['DT'];
            @$CAT = $this->tables->get_expt_by_id($data['EXPT'])[0]['NAME'];
            $TABLE = <<<TBL
            //coffee break;
            <table class='table table-striped'>
                <thead>
                        <td>
                        الرقم
                        </td>
                        <td>
                        البيان
                        </td>
                        <td>
            التكلفة
                        </td>
                        <td>
            التاريخ
                        </td>

                </thead>
                <tbody>
                <td>
            $EXPENSES_ID
                </td>
                <td>
                $NAME
                </td>
                <td>
                $AMT
                </td>
                <td>
                $DT
                </td>

                </tbody>
            </table>

TBL;
            $VIEW =<<<FORM

                <div >

                        <div class="card">
                          <div class="card-header">
                            هل انت متاكد من انك تريد حذف هذه البيانات
                          </div>
                          <div class="card-body">
                            $TABLE
                            </div>
                            <div class='card-footer'>
                                <a href='/Input/unlink/expenses/$EXPENSES_ID' class=' my-3 btn btn-danger form-control' >نعم </a>
                                <a href='/Admin/expenses/all' class='btn btn-info form-control my-3'>لا </a>
                            </div>
                        </div>
                </div>


FORM;
            return $VIEW;
        }
        public function render_expt_list()
        {
            $data = $this->tables->get_all_expt();
            $VIEW =<<<XML
            <table class='table table-striped' id='dataTable'>
                <thead>
                        <td>
                            الرقم
                        </td>
                        <td>
                            الاسم
                        </td>
                        <td>
                            الاولوية
                        </td>
                        <td>
                            الخيارات
                        </td>

                </thead>

XML;
            foreach($data as $A)
            {
                $ID = $A['ID'];
                $NAME = $A['NAME'];
                $PRI = $A['PRI'];
                $PRI = ($PRI == 1) ? "منخفضة"  : $PRI ;
                $PRI = ($PRI == 2) ? "متوسطة"  : $PRI ;
                $PRI = ($PRI == 3) ? "مرتفعة"  : $PRI ;
                $OPT =<<<LINE
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    خيارات
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/Admin/expt/edit/$ID">تعديل</a>
                    <a class="dropdown-item" href="/Admin/expt/unlink/$ID">حذف</a>
                  </div>
                </div>

LINE;
                $VIEW .=<<<ROW
                <tr>
                    <td>
                        $ID
                    </td>
                    <td>
                        $NAME
                    </td>
                    <td class='level'>
                        $PRI
                    </td>

                    <td>
                        $OPT
                    </td>
                </tr>
ROW;
            }
            $VIEW.="</table>";
            return $VIEW;
        }
        public function render_expt_add()
        {
            $VIEW=<<<FORM
            <div >
                <form method="POST" action="/Input/add/expt">
                    <div class='input-group mb-3'>
                            <input type='text' required='required' name='name'  class='form-control input-lg text-center' />
                            <div class='input-group-append'>
                                <span class='input-group-text '>
                                الاسم
                                </span>
                            </div>
                    </div>
                    <div class='input-group mb-3'>
                            <select ' required='required' name='pri'  class='form-control input-lg text-center' >
                                    <option value='1'>منخفضة</option>
                                    <option value='2'>متوسطة</option>
                                    <option value='3'>مرتفعة</option>


                            </select>
                            <div class='input-group-append'>
                                <span class='input-group-text '>
                            الاولوية
                                </span>
                            </div>
                    </div>
                    <input type='submit' value='اضافة' class='form-control btn btn-primary' />
                </form>

            </div>
FORM;
        return $VIEW;
        }
        public function render_expt_edit($ID)
        {
            $A = $this->tables->get_expt_by_id($ID);
            $A = ($A[0] != null) ? $A[0] : $A;
            $NAME = $A['NAME'];
            $PRI = $A['PRI'];
            $VIEW = <<<EXPT

            <div >
            <form method="POST" action="/Input/edit/expt/$ID" >
                    <div class='input-group mb-3'>
                            <input type='text' required='required' name='name' value='$NAME' class='form-control input-lg text-center' />
                            <div class='input-group-append'>
                                <span class='input-group-text '>
                                الاسم
                                </span>
                            </div>
                    </div>
                    <div class='input-group mb-3'>
                            <select ' required='required' name='pri' value='$PRI' class='form-control input-lg text-center' >
                                    <option value='1'>منخفضة</option>
                                    <option value='2'>متوسطة</option>
                                    <option value='3'>مرتفعة</option>


                            </select>
                            <div class='input-group-append'>
                                <span class='input-group-text '>
                            الاولوية
                                </span>
                            </div>
                    </div>
                    <input type='submit' value='تحديث' class='form-control btn btn-primary' />
            </form>
            </div>
EXPT;
            return $VIEW;
        }
        public function render_expt_unlink($id)
        {
            $VIEW= "";
            $items = $this->tables->get_expenses_by_expt($id);
            $small_table =<<<TB
                <div>
                <p>هذه العناصر مرتبطة بالعنصر الذي تود ان تحذفه</p>
                <table class='table table-striped text-center' id='' >

                    <thead>

                            <td>
                            EXPT
                            </td>
                            <td colspan='2' >
                            UNLINK
                            </td>

                    </thead>
TB;
        foreach($items as $A)
        {
            $NAME = $A['NAME'];
            $AMT = $A['AMT'];;
            $small_table.=<<<ROW
            <tr class='warning'>
                <td class='text-info'>
                $NAME
                <td>
                <td class='text-danger'>
                $AMT
                </td>
            </tr>

ROW;
        } // endforeach
        $small_table .= "</table></div>";
        @$exptname = $this->tables->get_expt_by_id($id)[0]['NAME'];
        @$exptpri = $this->tables->get_expt_by_id($id)[0]['PRI'];
        @$exptlinked = (count($items) > 0) ?  "نعم" : "لا";
        ($exptname == null && $exptpri == null) ? redirect("/Admin/expt/all") : null;
        $VIEW .= (count($items) > 0) ? $small_table : "";
        $VIEW .=<<<FORM
        <div >
            <table class='table table-striped'>
                    <thead>
                            <td>
                            الرقم
                            </td>
                            <td>
                            الاسم
                            </td>
                            <td>
                            الاولوية
                            </td>
                            <td>
                            عناصر مرتبطة
                            </td>
                    </thead>
                    <tbody>
                            <tr>
                                <td>
                                $id
                                </td>
                                <td>
                                $exptname
                                </td>
                                <td>
                                $exptpri
                                </td>
                                <td>
                                $exptlinked
                                </td>

                            </tr>
                    </tbody>
            </table>
            <p class='h3'>
            هل انت متأكد من انك تريد حذف هذا العنصر قد يؤدي هذه الي تشويش البيانات
            </p><hr />
            <a href='/Input/unlink/expt/$id' class='btn btn-danger form-control mb-3'>
                اكمال عملية الحذف
            </a>
            <a href='/Admin/expt/all/$id' class='btn btn-primary form-control'>
                الرجوع الي القائمةالرئيسية
            </a>

        </div>
FORM;
        return $VIEW;
        } // end function unlink_expt
    }

?>
