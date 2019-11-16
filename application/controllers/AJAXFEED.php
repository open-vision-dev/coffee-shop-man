<?php
    class AJAXFEED extends CI_Controller
        {
            public function __construct(){
                parent::__construct();
                $this->load->model("REPORTS");
            }
            public function expenses_pie_chart($start,$end)
            {
            header("Access-Control-Allow-Origin: *");
                $data = $this->REPORTS->render_pie_chart($start,$end);
                echo $data;
            }
        }

?>
