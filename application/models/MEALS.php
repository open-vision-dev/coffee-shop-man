<?PHP

    class MEALS extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('MyTables','tables');

        }
        public function render_meal_all()
        {
            $data = $this->tables->get_all_meals();
            $VIEW = <<<MV
            <table class='table table-striped' id='dataTable'>
                <thead>
                        <td>ID</td>
                        <td>التصنيف</td>
                        <td>الاسم</td>
                        <td>صورة</td>
                        <td>السعر</td>

                        <td>OPTION</td>
                </thead>
                <tbody>
MV;
            foreach($data as $A){
                $ID = $A['MID'];
                $NAME = $A['NAME'];
                @$MTYPE =$this->tables-> get_meal_types_by_id($A['MTYPE'])[0]['NAME'];
                $PIC = $A['MID'];
                $PIC =  "<img src='".$A['PIC'] ."' />";
                $PRICE = $A['PRICE'];
                $READY = ($A['WHID'] >-1)  ? "text-danger danger" : "";
                $OPTION = <<<VALUE
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    الخيارات
                    <span class='fa fa-gears'></span>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/Admin/meals/edit/$ID">تعديل</a>
                    <a class="dropdown-item" href="/Admin/meals/change_bg/$ID/">تغيير الصورة</a>
                    <a class="dropdown-item" href="/Admin/meals/unlink/$ID/">حذف</a>
                  </div>
                </div>
VALUE;
                $VIEW .=<<<LMX
                    <tr class='$READY'>
                        <td>$ID</td>
                        <td>$MTYPE</td>
                        <td>$NAME</td>
                        <td>$PIC</td>
                        <td>$PRICE</td>
                        <td>$OPTION</td>
                    </tr>
LMX;
            }
            $VIEW.="</tbody></table>";
            return $VIEW;
        }

        public function render_meal_add()
        {

            $mtypelist ="<select name='MTYPE' class='form-control select'>";
            $whlist ="<select name='WHID' class='form-control select'><option value='-1'>يحتاج الي تحضير</option>";
            $mtypes = $this->tables->get_all_meal_types();
            $wids = $this->tables->get_all_wh();
            foreach($mtypes as $A)
            {

                $NAME = $A['NAME'];
                $ID = $A['ID'];
                $mtypelist .= "<option value='$ID'>$NAME</option>";

            }
            $mtypelist.="</select>";
            foreach($wids as $A)
            {
                $NAME = $A['ENNAME'].':'.$A['ARNAME'];

                $ID = $A['ID'];
                $whlist .="<option value='$ID'>$NAME</option>";
            }
            $whlist .= "</select>";
            $VIEW =<<<F
            <form method='POST' action='/Input/add/meals' enctype="multipart/form-data" >
            <div>
                <div class="input-group mb-3">
                <input type='text' class='form-control ' name='NAME' required='required' />
                        <div class='input-group-addon'>

                            <div class='input-group-text'>
                            الاسم
                            </div>
                        </div>
                </div>
                <div class="input-group mb-3">
                $mtypelist

                        <div class='input-group-addon'>
                            <div class='input-group-text'>
                            الصنف
                            </div>
                        </div>
                </div>
                <div class="input-group mb-3">
                <input type='file' class='form-control ' name='PIC' required='required' capture />

                        <div class='input-group-addon'>
                            <div class='input-group-text'>
                                صورة
                            </div>
                        </div>
                </div>
                <div class="input-group mb-3">
                <input type='number' step='any' class='form-control ' name='PRICE' required='required' />

                        <div class='input-group-addon'>
                            <div class='input-group-text'>
                            السعر
                            </div>
                        </div>
                </div>
                <div class="input-group mb-3">
                        $whlist

                        <div class='input-group-addon'>
                            <div class='input-group-text'>
                                هل هذا الصنف يحتاج الي تحضير ام هو جاهز
                            </div>
                        </div>
                </div>
                <input type='submit' class='btn btn-success form-control' />
            </form>
            </div>
F;
            return $VIEW;
        }
        public function render_meal_edit($ID)
        {
            $mtypelist ="<select required='required' name='MTYPE' class='form-control select'>";
            $whlist ="<select required='required' name='WHID' class='form-control select'><option value='-1'>يحتاج الي تحضير</option>";
            $data = $this->tables->get_meals_by_id($ID)[0];
            $NAME = $data['NAME'];
            $MTYPE = $data['MTYPE'];
            $PRICE = $data['PRICE'];
            $WHID = $data['WHID'];
            $mtypes = $this->tables->get_all_meal_types();
            $wids = $this->tables->get_all_wh();
            foreach($mtypes as $A)
            {
                $selected = ($A['ID'] == $data['MTYPE']) ? "selected='selected'" : "";
                $TNAME = $A['NAME'];
                $TID = $A['ID'];
                $mtypelist .= "<option $selected value='$TID'>$TNAME</option>";

            }
            $mtypelist.="</select>";
            foreach($wids as $A)
            {
                $selected = ($A['ID'] == $data['WHID']) ? "selected='selected'" : "";
                $TNAME = $A['ENNAME'].':'.$A['ARNAME'];
                $TID = $A['ID'];
                $whlist .="<option $selected value='$TID'>$TNAME</option>";
            }
            $whlist .= "</select>";

            $VIEW=<<<XML
            <form method="POST" action="/Input/edit/meals/$ID">
            <div >

                    <div class='input-group mb-3'>
                            <input type='text' required='required' name='NAME' value='$NAME' class='form-control text-center' />
                            <div class='input-group-append'>
                                <div class='input-group-text'>
                                الاسم
                                </div>
                            </div>
                    </div>
                    <div class='input-group mb-3'>
                            $mtypelist
                            <div class='input-group-append'>
                                <div class='input-group-text'>
                                    النوع
                                </div>
                            </div>
                    </div>
                    <div class='input-group mb-3'>
                            <input type='number' required='required' step='any' name='PRICE' value='$PRICE' class='form-control text-center' />
                            <div class='input-group-append'>
                                <div class='input-group-text'>
                                    السعر
                                </div>
                            </div>
                    </div>
                    <div class='input-group mb-3'>
                            $whlist
                            <div class='input-group-append'>
                                <div class='input-group-text'>
                                    هل المنتج جاهز ام يحتاج لتحضير
                                </div>
                            </div>
                    </div>
                    <input type='submit'  class='form-control text-center btn btn-success' />
            </div>


            </form>
XML;
            return $VIEW;
        }
        public function render_change_bg($ID)
        {
            @$data = $this->tables->get_meals_by_id($ID)[0];
            $NAME = $data['NAME'];
            @$CAT = $this->tables->get_meal_types_by_id($data['MTYPE'])[0]['NAME'];
            $PRICE = $data['PRICE'];
            $TABLE =<<<TABLE
                <div>
                <table class='table table-striped'>
                        <thead>
                                <td>رقم العنصر</td>
                                <td>الاسم</td>
                                <td>الصنف</td>
                                <td>السعر</td>
                        </thead>
                        <tbody>
                                <tr>
                                        <Td>$ID</td>
                                        <Td>$NAME</td>
                                        <Td>$CAT</td>
                                        <Td>$PRICE</td>
                                </tr>
                        </tbody>
                </table>
                </div>
TABLE;
        $VIEW=<<<V
                $TABLE
                <form method="POST" action='/Input/change_bg/meals/$ID' enctype='multipart/form-data'>
                    <div class='input-group mb-3'>
                            <input type='file' class='form-control' name='PIC' capture required='required' />
                            <div class='input-group-append'>
                                <div class='input-group-text'>
                                    الصورة
                                </div>
                            </div>

                    </div>
                    <input type='submit' value='استمرار' class='btn btn-primary form-control' />
                </form>
V;
        return $VIEW;
        }
        public function render_meal_unlink($ID)
        {
            @$data = $this->tables->get_meals_by_id($ID)[0];
            $NAME = $data['NAME'];
            @$CAT = $this->tables->get_meal_types_by_id($data['MTYPE'])[0]['NAME'];
            $PRICE = $data['PRICE'];
            $TABLE =<<<TABLE

                <table class='table table-striped'>
                        <thead>
                                <td>رقم العنصر</td>
                                <td>الاسم</td>
                                <td>الصنف</td>
                                <td>السعر</td>
                        </thead>
                        <tbody>
                                <tr>
                                        <Td>$ID</td>
                                        <Td>$NAME</td>
                                        <Td>$CAT</td>
                                        <Td>$PRICE</td>
                                </tr>
                        </tbody>
                </table>

TABLE;
            $VIEW =<<<F
            <div class="card">
                <div class="card-header">
                تنبيه
                </div>
                <div class="card-body">
                <h5 class="card-title">
                    هل انت متأكد من انك تريد حذف هذا العنصر
                </h5>

                $TABLE
                </div>
                <div >
                    <a href='/Input/unlink/meals/$ID' class='btn btn-warning form-control mb-3'>
                    استمرار
                    </a>
                    <a href='/Admin/meals/all' class='btn btn-primary form-control'>
                    رجوع
                    </a><br />
                </div>
            </div>

        </div>

F;
        return $VIEW;
        }
    }

?>
