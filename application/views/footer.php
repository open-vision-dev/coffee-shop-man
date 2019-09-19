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
    function tp_calc()
    {

        qty = $('#store_add_qty').val();
        price = $('#store_add_price').val();
        result = parseFloat(qty) * parseFloat(price);
        $('#store_add_tp').val(result);
        if(result != NaN && isFinite(result))
        {
            $('#store_add_tp').removeAttr('disabled');
        }
    }
  </script>
</body>

</html>
