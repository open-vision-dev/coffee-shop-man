<?php
class REPORTS extends CI_Model
{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('MyTables','tables');
        }
        public function render_used_items_chart()
        {

        }
        public function render_orders_table($start,$end)
        {
            $A = $this->tables->get_order_listing($start,$end);
            $global_sum = 0;
            $VIEW =<<<XML
                <table class='table table-striped' id='dataTable2'>
                    <thead>
                        <td>ID</td>
                        <td>NAME</td>
                        <td>QTY</td>
                        <td>PRICE</td>
                        <td>TP</td>
                    </thead>
XML;
            foreach ($A as $B)
            {
                $ID = $B['ID'];
                $NAME = $B['NAME'];
                $QTY = $B['QTY'];
                $PRICE = $B['PRICE'];
                $TP = $B['TP'];
                $global_sum += $TP;
                $VIEW .=<<<XML
                <tr>
                    <td>$ID</td>
                    <td>$NAME</td>
                    <td>$QTY</td>
                    <td>$PRICE</td>
                    <td>$TP</td>
                </tr>
XML;

            }
            $VIEW .= "<tr>
                <td>-</td>
                <td>TOTAL SUM</td>
                <td>-</td>
                <td>-</td>
                <td>$global_sum</td>
            </tr>";
            $VIEW .= "</tbody></table>";
            return $VIEW;
        }
        public function render_pie_chart($start,$end)
        {
            $dataset = $this->tables->get_expenses_listing_pie_chart_data($start,$end);
            return $dataset;
        }
        public function render_main_chart($expenses,$net_earn,$paid_debits,$unpaid_debits)
        {
            $data = array(
                'labels'=>array('expenses','$net profit' , 'paid debits' , 'unpaid debits'),
                'data' => array($expenses,$net_earn,$paid_debits,$unpaid_debits)
            );
            return json_encode($data);
        }
        public function render_expenses_info_table($start,$end)
        {
                $data = $this->tables->get_expenses_listing($start,$end);
                $VIEW = <<<TABLE
                <br />
                <table id='dataTable' class='table table-striped '>
                    <thead>
                        <td>ID</td>
                        <td>NAME</td>
                        <td>TOTAL</td>
                        <td>PERCENTAGE</td>
                    </thead>
                <tbody>
TABLE;
                foreach($data as $A)
                {
                    $ID = $A['ID'];
                    $NAME = $A['NAME'];
                    $TOTAL = $A['TOTAL'];
                    $PERCENT = $A['PERCENT'];
                    $VIEW .=<<<XML
                    <tr>
                        <td>$ID</td>
                        <td>$NAME</td>
                        <td>$TOTAL</td>
                        <td>$PERCENT</td>
                    </tr>

XML;
                }
                $VIEW .= "</tbody></table> <br /> <hr />";
                return $VIEW;
        }
        public function  render_reports_all($start=null,$end=null)
        {
            $start = ($start == null )? date("Y-m")."-1" : $start;
            $end = ($end == null )? date("Y-m")."-31" : $end;
            $income = $this->tables->get_income_interval($start,$end)[0]['TOTAL']+0;
            $expenses_info_table = $this->render_expenses_info_table($start,$end);
            $expenses = $this->tables->get_expenses_sum_interval($start,$end)[0]['TOTAL']+0;
            $paid_debits = $this->tables->get_paid_debits_sum_interval($start,$end)[0]['TOTAL']+0;
            $unpaid_debits = $this->tables->get_unpaid_debits_intw($start,$end)[0]['TOTAL']+0;
            $net_earn = $income - $expenses - $unpaid_debits;
            $_SESSION['PIE_CHART_REPORT_LINK'] = "/AJAXFEED/expenses_pie_chart/$start/$end";
            $_SESSION['MAIN_CHART_DATA'] = $this->render_main_chart($expenses,$net_earn,$paid_debits,$unpaid_debits);
            $meals_tables = $this->render_orders_table($start,$end);
        //    $_SESSION['pie_chart'] =$this->render_pie_chart($start,$end);
            $VIEW =<<<XML
            <form  method="POST" action='/Admin/reports/all/'>
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

                </div><!-- end of row !-->

            <div class='card'>
                <div class='card-header'>
                    <h1 class='text-danger text-center'>
                    تقرير شامل
                    </h1>
                </div>
                <div class='card-body'>
                    <table class='table table-striped'>
                            <thead>
                            <tr>
                                <Td class='text-center'>
                                الفترة من
                                </td>
                                <Td class='text-center'>
                                الفترة الي
                                </td>

                            </thead>
                            <tbody>
                                    <tr>
                                        <Td class='text-center'>
                                        $start
                                        </td>
                                        <Td class='text-center'>
                                        $end
                                        </td>

                                    </tr>
                            </tbody>
                    </table>
                </div><!-- end of card-nody !-->

            </div><!-- end of card!-->


            <div class='row text-center'>
                        <div class='col-md-4'>
                            <div class='card bg-dark'>
                                    <div class='card-header'>

                                    </div>
                                    <div class='card-body'>
                                            <div class='card-title '>
                                                <p class='h1 text-light'>
                                                اجمالي المبيعات
                                            </p>
                                            </div>
                                            <div class='card-text text-bold h4 text-danger'>
                                                $income
                                            </div><!-- end of card-text !-->
                                    </div><!-- end of card-body !-->
                            </div><!-- end of card !-->
                        </div><!-- end of col-md-4 !-->
                        <div class='col-md-4'>
                            <div class='card bg-warning'>
                                    <div class='card-header'></div>
                                    <div class='card-body'>
                                            <div class='card-title'>
                                                <h1>اجمالي المصروفات</h1>
                                            </div>
                                            <div class='card-text text-bold h4 text-danger text-center'>
                                                $expenses
                                            </div><!-- end of card-text !-->
                                    </div><!-- end of card-body !-->
                            </div><!-- end of card !-->
                        </div><!-- end of col-md-4 !-->
                        <div class='col-md-4'>
                            <div class='card'>
                                    <div class='card-header'>
                                    </div>
                                    <div class='card-body'>
                                            <div class='card-title'>
                                                <p class='h1'>
                                                اجمالي الديونية
                                                </p>
                                            <div class='card-text text-danger text-bold h4 text-danger'>
                                                $unpaid_debits

                                            </div> <!-- end of card-text !-->
                                    </div><!-- end of card-body !-->
                             </div><!-- end of card !-->
                        </div><!-- end of col-md4 !-->

                    </div><!-- end of row  !-->
                </div>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='card bg-warning'>
                                <div class='card-header'></div>
                                <div class='card-body text-center'>
                                        <div class='card-title'>
                                            <p class='h1'>
                                                صافي الارباح
                                            <p>
                                        </div>
                                        <div class='card-text text-bold text-center h4 text-danger'>
                                            $net_earn
                                        </div> <!-- end of card-text !-->
                                </div><!-- end of card-body !-->
                        </div><!-- end of card !-->
                    </div><!-- end  of col-md-4 !-->

                    <canvas id="main_chart" width="500px" height="150px" class="chartjs-render-monitor" style=" width: 100%; height: 150px;"></canvas>
                    <canvas id="expenses_pie_chart" width="500px" height="150px" class="chartjs-render-monitor" style=" width: 100%; height: 500px;"></canvas>

                </div> <!-- end of row !-->
                $expenses_info_table
                <br />
                $meals_tables

            </div>
XML;
            return $VIEW;
        }
}
?>
