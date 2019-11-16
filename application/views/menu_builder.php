<?php
$VIEW="";

switch($page_name)
{
case "WH-VIEW" :
case 'WH-EDIT':
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/">Home</a>
          </li>
          <li class="breadcrumb-item "><a href='/Admin/wh/'>قائمة المخزون
		  </a>
		  </li>
		  <li class="breadcrumb-item">
           <a href='/Admin/wh/add'>اضافة صنف</a>
          </li>
		  <li class="breadcrumb-item active">
            بيانات الصنف
          </li>
        </ol>


XML;
break;
case "WH-LIST":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/">Home</a>
          </li>
          <li class="breadcrumb-item active"><a href='/Admin/wh/all'>قائمة المخزون
		  </a>
		  </li>
		  <li class="breadcrumb-item">
           <a href='/Admin/wh/add'>اضافة صنف</a>
          </li>

        </ol>


XML;
break;
case "WH-ADD":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/">Home</a>
          </li>
          <li class="breadcrumb-item "><a href='/Admin/wh/'>قائمة المخزون
		  </a>
		  </li>
		  <li class="breadcrumb-item active">
          اضافة صنف
          </li>
		  <li class="breadcrumb-item ">
            بيانات الصنف
          </li>
        </ol>


XML;

break;
case "WH_CAT_UPDATE":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/">Home</a>
          </li>
          <li class="breadcrumb-item "><a href='/Admin/wh_cat/'>
            قائمة الاصناف

		  </a>
		  </li>
		  <li class="breadcrumb-item active">
          اضافة صنف
          </li>
		  <li class="breadcrumb-item ">
            تعديل بيانات الصنف
          </li>
        </ol>


XML;
break;
case "WH_CAT_ADD":

$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/">Home</a>
          </li>
          <li class="breadcrumb-item "><a href='/Admin/wh_cat/'>
            قائمة الاصناف

		  </a>
		  </li>
		  <li class="breadcrumb-item active">
        اضافة صنف جديد
          </li>
        </ol>


XML;
break;
case "WH_CAT_ALL":

$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/">Home</a>
          </li>
          <li class="breadcrumb-item active">
            قائمة الاصناف
		  </li>
		  <li class="breadcrumb-item ">
          <a href="/Admin/wh_cat/add">
        اضافة صنف جديد
</a>
          </li>

</ol>

XML;
break;
case "STORE-ALL":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/">Home</a>
          </li>
          <li class="breadcrumb-item active">
            قائمة الاصناف
		  </li>
		  <li class="breadcrumb-item ">
          <a href="/Admin/wh_cat/add">
        اضافة صنف جديد
</a>
          </li>

</ol>

XML;

break;
case "STORE-EDIT":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">Home</a>
          </li>
          <li class="breadcrumb-item ">
            <a href='/Admin/wh/all/'>
            قائمة المخزن
        </a>
		  </li>
		  <li class="breadcrumb-item active">

               تحديث بيانات منتج


          </li>

</ol>

XML;

break;
case "STORE_ADD":
$VIEW .= <<<XML

 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">Home</a>
          </li>
          <li class="breadcrumb-item active">

            قائمة المخزن
        </a>
		  </li>
		  <li class="breadcrumb-item active ">
              <a href='/Admin/store/add'>
              اضافة منتج جديد
          </a>
          </li>

</ol>

XML;

break;
case "STORE_LIST":
$VIEW .=<<<XML
<!-- Breadcrumbs-->
       <ol class="breadcrumb">
         <li class="breadcrumb-item">
           <a href="/Admin/wh/">Home</a>
         </li>
         <li class="breadcrumb-item active">

           قائمة المخزن
       </a>
         </li>
         <li class="breadcrumb-item ">
             <a href='/Admin/store/add'>
             اضافة منتج جديد
         </a>
         </li>

</ol>
XML;
break;
case "STORE_UNLNK":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">Home</a>
          </li>
          <li class="breadcrumb-item active">

            قائمة المخزن
        </a>
		  </li>
		  <li class="breadcrumb-item active">

ازالة بيانات منتج

          </li>

</ol>

XML;

break;
case "STORE_EDIT":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">Home</a>
          </li>
          <li class="breadcrumb-item ">
<a href='/Admin/store/all'>
            قائمة المخزن
        </a>
        </a>
		  </li>
		  <li class="breadcrumb-item active">

تعديل بيانات منتج

          </li>

</ol>

XML;

break;
case "EXPT_LIST":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>
          <li class="breadcrumb-item">
              <a href="/Admin/expenses/all">
                  المصروفات
              </a>

          </li>
          <li class="breadcrumb-item active">

        انواع المصروفات

		  </li>
		  <li class="breadcrumb-item active">
              <a href='/Admin/expt/add'>
            اضافة صنف جديد
              </a>
          </li>

</ol>

XML;

break;
case "EXPT_ADD":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>
          <li class="breadcrumb-item">
              <a href="/Admin/expenses/all">
                  المصروفات
              </a>

          </li>
          <li class="breadcrumb-item active">
             اضافة صنف جديد

		  </li>


</ol>

XML;

break;
case "EXPT_EDIT":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>
          <li class="breadcrumb-item">
              <a herf="/Admin/expenses/all">
                  المصروفات
              </a>

          </li>
          <li class="breadcrumb-item active">
        تحديث بيانات صنف

		  </li>


</ol>

XML;

break;
CASE "EXPT_UNLINK":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>
          <li class="breadcrumb-item">
              <a href="/Admin/expenses/all">
                  المصروفات
              </a>

          </li>
          <li class="breadcrumb-item active">
              حذف بيانات صنف

		  </li>


</ol>

XML;

break;
CASE "EXPENSES_LIST":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>
          <li class='breadcrumb-item'>
                <a href='/Admin/expt/all'>
                    اصناف المصروفات
                </a>
          </li>
          <li class="breadcrumb-item active">

                  المصروفات


          </li>
          <li class="breadcrumb-item ">
              <a href='/Admin/expenses/add'>
                  اضافة مصروفات جديدة
              </a>

		  </li>


</ol>

XML;

break;
CASE "EXPENSES_SEARCH":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>
          <li class='breadcrumb-item'>
                <a href='/Admin/expt/all'>
                    اصناف المصروفات
                </a>
          </li>
          <li class="breadcrumb-item ">
              <a href='/Admin/expenses/all'>
                  المصروفات
              </a>

          </li>
          <li class="breadcrumb-item active">

                    بحث المصروفات


		  </li>


</ol>

XML;

break;
CASE "EXPENSES_ADD":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>
          <li class='breadcrumb-item'>
                <a href='/Admin/expt/all'>
                    اصناف المصروفات
                </a>
          </li>
          <li class="breadcrumb-item ">

                  المصروفات


          </li>
          <li class="breadcrumb-item active">

                  اضافة مصروفات جديدة


		  </li>


</ol>

XML;

break;
CASE "EXPENSES_EDIT":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>
          <li class='breadcrumb-item'>
                <a href='/Admin/expt/all'>
                    اصناف المصروفات
                </a>
          </li>
          <li class="breadcrumb-item ">

                  المصروفات


          </li>
          <li class="breadcrumb-item active">
              تحديث المصروفات
		  </li>


</ol>

XML;

break;
CASE "EXPENSES_UNLINK":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>
          <li class='breadcrumb-item'>
                <a href='/Admin/expt/all'>
                    اصناف المصروفات
                </a>
          </li>
          <li class="breadcrumb-item ">

                  المصروفات


          </li>
          <li class="breadcrumb-item active">

              ازالة مصروفات

		  </li>


</ol>

XML;
break;
CASE "MEALS_ALL":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>

          <li class="breadcrumb-item active">

                قائمة الوجبات

		  </li>
          <li class='breadcrumb-item '>
                <a href='/Admin/meals/add'>
                    اضافة وجبات جديدة
                </a>
          </li>

</ol>

XML;
break;
CASE "MEALS_EDIT":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>

          <li class="breadcrumb-item ">
              <a href='/Admin/meals/all'>
                قائمة الوجبات
            </a>

		  </li>
          <li class="breadcrumb-item active">

                  تعديل بيانات الصنف


        </li>


</ol>

XML;
break;
CASE "MEALS_CHANGEBG":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>


          <li class="breadcrumb-item ">
              <a href='/Admin/meals/all'>
                قائمة الوجبات
            </a>

         </li>
          <li class="breadcrumb-item active">

                  تعديل صورة الصنف


        </li>


</ol>

XML;
break;
CASE "MEALS_UNLINK":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>


          <li class="breadcrumb-item ">
              <a href='/Admin/meals/all'>
                قائمة الوجبات
            </a>

         </li>
          <li class="breadcrumb-item active">

                 حذف بيانات صنف


        </li>


</ol>

XML;
CASE "ORDERS_ALL":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>

          <li class="breadcrumb-item ">
              <a href='/Admin/meals/all'>
                قائمة الوجبات
            </a>

		  </li>
          <li class="breadcrumb-item active">

                قائمة الطلبات


         </li>
          <li class='breadcrumb-item '>
                <a href='/Admin/orders/add'>
                    اضافة طلب جديد
                </a>
          </li>

</ol>

XML;
break;
CASE "ORDERS_INFO":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>

          <li class="breadcrumb-item ">
              <a href='/Admin/meals/all'>
                قائمة الوجبات
            </a>

		  </li>
          <li class="breadcrumb-item ">
              <A href='/Admin/orders/all'>
                قائمة الطلبات
            </a>


         </li>
          <li class='breadcrumb-item active'>

                    بيانات الطلب

          </li>

</ol>

XML;
break;
CASE "ORDERS_UNLINK":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>

          <li class="breadcrumb-item ">
              <a href='/Admin/meals/all'>
                قائمة الوجبات
            </a>

		  </li>
          <li class="breadcrumb-item ">
              <A href='/Admin/orders/all'>
                قائمة الطلبات
            </a>


         </li>
          <li class='breadcrumb-item active'>
                الغاء  الطلب

          </li>

</ol>

XML;
CASE "USED_ITEMS_ALL":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item active'>
            المواد المستخدمة

          </li>

          <li class="breadcrumb-item active">
              <a href='/Admin/used_items/add'>
                  اضافة بيانات
            </a>

        </li>
</ol>
XML;
break;
CASE "USED_ITEMS_ADD":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item active'>
            المواد المستخدمة

          </li>

          <li class="breadcrumb-item active">
              <a href='/Admin/used_items/add'>
                 اضافة جديدة
            </a>

        </li>
</ol>
XML;
break;
CASE "JOBS_ALL":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item active'>
              الوظائف المتوفرة

          </li>

          <li class="breadcrumb-item active">
              <a href='/Admin/jobs/add'>
         اضافة وظيفة
            </a>

        </li>
</ol>
XML;
break;
CASE "JOBS_UPDATE":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item '>
              <a href='/Admin/jobs/all' >
              الوظائف المتوفرة
          </a>

          </li>

          <li class="breadcrumb-item active">

        تحديث بيانات الوظيفة


        </li>
</ol>
XML;
break;
CASE "JOBS_UNLINK":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item '>
              <a href='/Admin/jobs/all' >
              الوظائف المتوفرة
          </a>

          </li>

          <li class="breadcrumb-item active">

        حذف بيانات الوظيفة


        </li>
</ol>
XML;
break;
CASE "JOBS_ADD":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item '>
              <a href='/Admin/jobs/all' >
              الوظائف المتوفرة
          </a>

          </li>

          <li class="breadcrumb-item active">
              اضافة بيانات جديدة
        </li>
</ol>
XML;
break;
CASE "WORKERS_ADD":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item '>
              <a href='/Admin/jobs/all' >
            الوظائف المتوفرة
          </a>

          </li>
          <li class='breadcrumb-item'>
              <a href='/Admin/workers/all'>
                     قائمة الموظفين
              </a>
          </li>

          <li class="breadcrumb-item active">
              اضافة موظف جديد
        </li>
</ol>
XML;
break;
CASE "WORKERS_EDIT":
$VIEW .= <<<XML
<!-- Breadcrumbs-->
       <ol class="breadcrumb">
         <li class="breadcrumb-item">
           <a href="/Admin/wh/">الرئيسية</a>
         </li>



         <li class='breadcrumb-item '>
             <a href='/Admin/jobs/all' >
           الوظائف المتوفرة
         </a>

         </li>
         <li class='breadcrumb-item'>
             <a href='/Admin/workers/all'>
                    قائمة الموظفين
             </a>
         </li>

         <li class="breadcrumb-item active">
             تحديث بيانات موظف
       </li>
</ol>
XML;
CASE "WORKERS_EDIT":
$VIEW .= <<<XML
<!-- Breadcrumbs-->
       <ol class="breadcrumb">
         <li class="breadcrumb-item">
           <a href="/Admin/wh/">الرئيسية</a>
         </li>



         <li class='breadcrumb-item '>
             <a href='/Admin/jobs/all' >
           الوظائف المتوفرة
         </a>

         </li>
         <li class='breadcrumb-item'>
             <a href='/Admin/workers/all'>
                    قائمة الموظفين
             </a>
         </li>

         <li class="breadcrumb-item active">
             بيانات سلفيات المرتب
       </li>
</ol>
XML;
break;
CASE "WORKERS_UNLINK":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item '>
              <a href='/Admin/jobs/all' >
              الوظائف المتوفرة
          </a>

          </li>
          <li class='breadcrumb-item '>
              <a href='/Admin/workers/all' >
              قائمة الموظفين
          </a>

          </li>

          <li class="breadcrumb-item active">
              حذف بيانات موظف
        </li>
</ol>
XML;
break;
CASE "WORKERS_ALL":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item '>
              <a href='/Admin/jobs/all' >
              الوظائف المتوفرة
          </a>

          </li>

          <li class="breadcrumb-item active">
              قائمة الموظفين
        </li>
        <li class="breadcrumb-item ">
            <a href='/Admin/workers/add'>
            اضافة موظف جديد
        </a>
      </li>
</ol>
XML;
break;
CASE "WORKERS_DEBITS_ALL":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item '>
              <a href='/Admin/jobs/all' >
              الوظائف المتوفرة
          </a>

          </li>



      <li class="breadcrumb-item active">
         قائمة مديونيات الموظفين
    </li>
    <li class="breadcrumb-item ">
        <a href='/Admin/workers_debits/add'>
            اضافة سلفية جديد

    </a>
  </li>
</ol>
XML;
break;
CASE "WORKERS_DEBITS_ADD":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item '>
              <a href='/Admin/jobs/all' >
              الوظائف المتوفرة
          </a>

          </li>


        <li class="breadcrumb-item ">
            <a href='/Admin/workers_debits/all'>

                 قائمة مديونيات الموظفين
        </a>
      </li>
      <li class="breadcrumb-item active">
            اضافة سلفية جيد
    </li>
</ol>
XML;
break;
CASE "WORKERS_DEBITS_UNLINK":
$VIEW .= <<<XML
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/Admin/wh/">الرئيسية</a>
          </li>



          <li class='breadcrumb-item '>
              <a href='/Admin/jobs/all' >
              الوظائف المتوفرة
          </a>

          </li>


        <li class="breadcrumb-item ">
            <a href='/Admin/workers_debits/all'>

                 قائمة مديونيات الموظفين
        </a>
      </li>
      <li class="breadcrumb-item active">
        أزالة بيانات سلفية
    </li>
</ol>
XML;
break;
CASE "STORE_DEBITS_ALL":
$VIEW .= <<< XML
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="/Admin/wh/">الرئيسية</a>
  </li>


<li class="breadcrumb-item active">


         قائمة مديونيات المحل

</li>
<li class="breadcrumb-item "  >
    <a href='/Admin/store_debits/add'>
اضافة مديونية جديدة
</a>
</li>
</ol>
XML;
break;
case "STORE_DEBITS_ADD":
$VIEW .= <<< XML
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="/Admin/wh/">الرئيسية</a>
  </li>


<li class="breadcrumb-item ">
        <a href='/Admin/store_debits/all'>
         قائمة مديونيات المحل
     </a>
</li>
<li class="breadcrumb-item active"  >

        اضافة مديونية جديدة

</li>
</ol>
XML;
break;
case "STORE_DEBITS_UNLINK":
$VIEW .=<<<XML
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="/Admin/wh/">الرئيسية</a>
  </li>


<li class="breadcrumb-item ">
        <a href='/Admin/store_debits/all'>
         قائمة مديونيات المحل
     </a>
</li>
<li class="breadcrumb-item active"  >

    حذف الغاء بيانات مديونية

</li>
</ol>
XML;
break;
case "STORE_DEBITS_UPDATE":
$VIEW .=<<<XML
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="/Admin/wh/">الرئيسية</a>
  </li>


<li class="breadcrumb-item ">
        <a href='/Admin/store_debits/all'>
         قائمة مديونيات المحل
     </a>
</li>
<li class="breadcrumb-item active"  >

    تحديث بيانات مديونية

</li>
</ol>
XML;
break;
case "STORE_DEBITS_PAY":
$VIEW .=<<<XML
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="/Admin/wh/">الرئيسية</a>
  </li>


<li class="breadcrumb-item ">
        <a href='/Admin/store_debits/all'>
         قائمة مديونيات المحل
     </a>
</li>
<li class="breadcrumb-item active"  >

    سداد  مديونية

</li>
</ol>
XML;
break;
CASE "REPORTS_ALL":
$VIEW .= <<<XML
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="/Admin/wh/">الرئيسية</a>
  </li>


<li class="breadcrumb-item ">

            التقرير الشامل

</li>
</ol>
XML;

break;
}

echo $VIEW;
?>
