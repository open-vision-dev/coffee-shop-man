<?php

?>
      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy;  2019 Coffee App By Open-vision Technologies</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>


  <script src="<?php echo $this->config->item("base_url");?>/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo $this->config->item("base_url");?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo $this->config->item("base_url");?>vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- PRINT JS -->
  <script src="<?php echo $this->config->item("base_url");?>js/print.min.js"></script>


  <!-- Page level plugin JavaScript-->
  <script src="<?php echo $this->config->item("base_url");?>vendor/chart.js/Chart.min.js"></script>
  <script src="<?php echo $this->config->item("base_url");?>vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo $this->config->item("base_url");?>vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo $this->config->item("base_url");?>js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="<?php echo $this->config->item("base_url");?>js/demo/datatables-demo.js"></script>
  <sscript src="<?php echo $this->config->item("base_url");?>js/demo/chart-area-demo.js"></script>
  <script type='text/JavaScript'>

    $('#store_add_qty,#store_add_price').bind('keypup',function(){
        tp_calc();
    });
    $('#submitOrderForm').bind('click',function(){
        submit_order();
        console.log('submitted!')
    });
    </script>
    <script src='<?php
    ($page_name == "ORDERS_ADD")  ? print $this->config->item("base_url")."js/Admin/orders.js" : null;
     ?>'></script>
     <script type='text/javascript'>
     <?php
     if($page_name == "REPORTS_ALL")
     {
         $report_link = $_SESSION['PIE_CHART_REPORT_LINK'];
         echo <<<XML
         var JSOB = null;
         $(document).ready(function(){
            fetch_and_render();
         });
         function fetch_and_render()
         {
             $.getJSON('$report_link',function (xd){
             JSOB = xd;
             render_pie_chart(xd)
             });
         }
         function render_pie_chart(xd){
         var JSOB = xd;
         var xctx = document.getElementById('expenses_pie_chart').getContext('2d');
          var options = {
             responsive: true,
             title: {
               display: true,
               position: "top",
               text: "Pie Chart",
               fontSize: 18,
               fontColor: "#111"
             },
             legend: {
               display: true,
               position: "bottom",
               labels: {
                 fontColor: "#333",
                 fontSize: 16
               }
             }
           };
          var data1 = {

         	labels : JSOB.labels ,
         	datasets : [{
         	label:"bullshit" ,
         	data:JSOB.data,
         	backgroundColor : JSOB.backgroundColor ,
         	borderColor : JSOB.backgroundColor ,
         	borderWidth: [1, 1, 1, 1, 1]
         	}]

          };

          var init = {
         	type:'pie' ,
         	data: data1 ,
         	options : options

          };
          var pieChart = new Chart (xctx , init);
          }


XML;
     }
     ?>

     </script>
     <script type='text/javascript'>
        <?php if($page_name == 'REPORTS_ALL') {
            $mcd = $_SESSION['MAIN_CHART_DATA'];
            echo <<<XML
            var mcd = '$mcd';
            var mcdob = JSON.parse(mcd);
            var mainData = {
             type: 'line',
             data: {
               labels: mcdob.labels,
               datasets: [{
                 label: "Sessions",
                 lineTension: 0.3,
                 backgroundColor: "rgba(2,117,216,0.2)",
                 borderColor: "rgba(2,117,216,1)",
                 pointRadius: 5,
                 pointBackgroundColor: "rgba(2,117,216,1)",
                 pointBorderColor: "rgba(255,255,255,0.8)",
                 pointHoverRadius: 5,
                 pointHoverBackgroundColor: "rgba(2,117,216,1)",
                 pointHitRadius: 50,
                 pointBorderWidth: 2,
                 data: mcdob.data,
               }],
             }
             };
             var main_chart_ctx = document.getElementById('main_chart').getContext('2d');

             $(document).ready(function(){
             render_main_chart();
             $('#dataTable2').DataTable();
             });
             function render_main_chart(){
              var main_chart_js = new Chart(main_chart_ctx,mainData);
             };

XML;


        }
        ?>
     </script>
</body>

</html>
