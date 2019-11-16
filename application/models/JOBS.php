<?PHP
class JOBS extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("MyTables","tables");
    }

    public function render_jobs_all()
    {
        $jobs = $this->tables->get_all_jobs();
        $VIEW =<<< XMLT
        <div>
        <table class='table table-striped' >

            <thead>
                <td>ID</td>
                <td>NAME</td>
                <td>SALARY</td>
                <td>Priority</td>
                <td>Option</td>
            </thead>
            <tbody>
XMLT;
        foreach($jobs as  $job)
        {
            $ID = $job['JID'];
            $NAME = $job['JTITLE'];
            $PRI = $job['PRI'];
            $SALARY = $job['SALARY'];
            $OPTIONS = <<<LMX
            <div class="btn-group">
              <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                الاعدادات
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/Admin/jobs/update/$ID">تعديل</a>
                <a class="dropdown-item" href="/Admin/jobs/unlink/$ID">حذف الوظيفة</a>

                <div class="dropdown-divider"></div>

                <a class='dropdown-item' href='/Admin/jobs/info/$ID'>النفاصيل</a>
              </div>
            </div>

LMX;
            $VIEW .=<<< TBI
            <tr>
            <td>$ID</td>
            <td>$NAME</td>
            <td>$SALARY</td>
            <td>$PRI</td>
            <td>$OPTIONS</td>
            </tr>
TBI;
        }
        $VIEW .="</tbody></table></div>";

        return $VIEW;
    }
    public function render_job_update($id)
    {
        $job = $this->tables->get_jobs_by_id($id)[0];
        $JTITLE = $job['JTITLE'];
        $SALARY = $job['SALARY'];
        $PRI = $job['SALARY'];
        $VIEW =<<<LMX
        <style>
        div.input-group
        {
            padding-bottom:1rem;
        }
        </style>
        <form method='POST' action='/Input/edit/jobs/$id'>
        <div>
        <div class='input-group'>

                <div class='input-group-append'>
                    <div class='input-group-text'>
                        Name
                    </div>
                </div>
                <input type='text' value='$JTITLE' class='form-control text-center' name='JTITLE' />
        </div>
        <div class='input-group'>

                <div class='input-group-append'>
                    <div class='input-group-text'>
                        Salary
                    </div>
                </div>
                <input type='number' value='$SALARY' class='form-control text-center' name='SALARY' />
        </div>
        <div class='input-group'>

                <div class='input-group-append'>
                    <div class='input-group-text'>
                        Priority
                    </div>
                </div>
                <select  name='PRI' class='form-control text-center' name='SALARY' >
                    <option value='1'>Low  </option>
                    <option value='2'>Medium</option>
                    <option value='3'>Hight </option>
                </select>
        </div>
        </div>
        <input type='submit' class='btn btn-success form-control' value='
        استمرار
        '
          />

        </form>
LMX;
    #@TODO : SELECT rest every time this form loads and user has to set this value manually and might forget what it was e
    return $VIEW;
    }
    public function render_jobs_unlink($id)
    {
        $count = $this->tables->get_jobs_count($id);
        if($count > 0)
        {
            $workers = $this->tables->get_workers_by_job_id($id);
            $VIEW= <<<XMLA
            <div>
                <p class='h1 text-danger'>
                    تنبيه هذه الوظيفة تحتوي علي عدد من العمال وسوف يؤدي هذا الي اتلاف البيانات
                </p>
                <table class='table text-center'>
                    <thead>
                        <td>ID</td>
                        <td>NAME</td>
                        <td>TEL1</td>
                        <td>TEL2</td>
                    </thead>
XMLA;
        foreach($workers as $W)
        {
            $ID = $W['ID'];
            $NAME = $W['NAME'];
            $TEL1 = $W['TEL'];
            $TEL2 = $W['TEL2'];
            $VIEW.= <<<XXMLA
                <tr>
                <td>$ID</td>
                <td>$NAME</td>
                <td>$TEL1</td>
                <td>$TEL2</td>
                </tr>
XXMLA;
        }
        $VIEW.= "</tbody></table>
        <a href='/Admin/jobs/update/$id' class='btn form-control btn-success mb-3' >
        تحديث بيانات الوظيفة
        </a>
        <a href='/Admin/jobs/unlink/$id' class='btn  form-control btn-danger mb-3' >
        تراجع
        </a>

        </div>";
    }else{
        $VIEW = <<<LLLA
        <div>
            <p class='h1 text-success text-center mb-3 '>
                هل انت متأكد من انك تؤد حذف هذه الوظيفة

            </p>
            <a href='/Input/unlink/jobs/$id' class='btn form-control btn-info mb-3' >
            حذف
            </a>
            <a href='/Admin/jobs/update/$id' class='btn form-control btn-success mb-3' >
            تحديث بيانات الوظيفة
            </a>
            <a href='/Admin/jobs/unlink/$id' class='btn  form-control btn-danger mb-3' >
            تراجع
            </a>


        </div>

LLLA;
    }

        return $VIEW;
    }
    public function render_jobs_add()
    {
        $VIEW =<<<LMX
        <style>
        form div
        {
            margin-bottom: 1rem;
        }
        </style>
        <form method='POST' action='/Input/add/jobs/'>
        <div>
        <div class='input-group'>

                <div class='input-group-append'>
                    <div class='input-group-text'>
                        Name
                    </div>
                </div>
                <input type='text'  class='form-control text-center' name='JTITLE' />
        </div>
        <div class='input-group'>

                <div class='input-group-append'>
                    <div class='input-group-text'>
                        Salary
                    </div>
                </div>
                <input type='number'   class='form-control text-center' name='SALARY' />
        </div>
        <div class='input-group'>

                <div class='input-group-append'>
                    <div class='input-group-text'>
                        Priority
                    </div>
                </div>
                <select  name='PRI' class='form-control text-center'  >
                    <option value='1'>Low  </option>
                    <option value='2'>Medium</option>
                    <option value='3'>Hight </option>
                </select>
        </div>
        </div>
        <input type='submit' class='btn btn-success form-control' value='
        استمرار
        '
          />

        </form>
LMX;

    return $VIEW;
    }
}

?>
