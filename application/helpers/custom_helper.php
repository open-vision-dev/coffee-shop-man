<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	function lvl_based_redirect($me)
	{
		if($me->session->userdata('lvl') > 1 )
			{
				$me->load->view("admin");
			}
			else if ( $this->session->userdata("lvl") < 1 )
			{
				$me->load->view("client");

			}

	}
	function esc($data)
	{
		$me=&get_instance();
		return $me->db->escape_str($data);
	}
	function site_link ()
	{
		$obj = &get_instance();
		$url = $obj->config->item('base_url') ;//. '/index.php/';
		return $url;

	}
	function site_link_to($page)
	{
		return site_link() . "$page";
	}
	function site_link_to_many($data)
	{
		$result = array();
		foreach($data as $item)
		{
			array_push($data,site_link_to($item));
		}
		return $result;
	}
	function login_check()
	{
		$obj = &get_instance();
		if(!$obj->session->has_userdata("lvl"))
		{
			redirect($obj->config->item('base_url') .'//Auth/login');
		}

	}
	function output_parms($method="POST")
	{

		$data = (strtoupper($method) == 'POST')  ? $_POST : $_GET;
		$VIEW = "";
		foreach($data as $name => $val)
		{
					$VIEW .= '$this->form_validation->set_rules("' .  $name . '" ,"  ", "min_length[1]|required");'."\n";
		}
		foreach($data as $name => $val)
		{
					$VIEW .= "\$$name=".'$this->input->'.mb_strtolower($method). "(\"$name\",TRUE);\n";
		}
		return $VIEW;
	}
	function image_upload_to_hex_thumb($form_id,$w=150,$h=150)
	{
		$app = &get_instance();
		$config['upload_path']=$_SERVER['CONTEXT_DOCUMENT_ROOT'].'/tmp/';
	 $config['allowed_types']='gif|jpg|png|';
	 $config['max_size']=1024*1024*3.5;
	 $app->upload->initialize($config);
		if($app->upload->do_upload($form_id))
		{
			$types = array(
				"image/png"=>"png",
				"image/jpeg"=>"jpeg"
			);
			$IMG=$app->upload->data();
			$IMGPATH = $IMG['full_path'];
			$DESTPATH = $IMG['file_path'].$IMG['raw_name'].'_thumb'.$IMG['file_ext'];
			$IMGTYPE = $IMG['file_type'] ;
			$DESTIMG = $IMG['raw_name'].'_thumb'.$IMG['file_ext'];
			$config['source_image']=$IMGPATH;
			$config['create_thumb']=TRUE;
			$config['maintain_ratio']=TRUE;
			$config['width']=150;
			$config['heigth']=150;
			$app->image_lib->initialize($config);
			$tok=$app->image_lib->resize();
			if($tok){
				$txt=base64_encode(file_get_contents($DESTPATH));
				$cleanup = unlink($DESTPATH) && unlink($IMGPATH);
				if($cleanup)
				{
					 return "data:$IMGTYPE;base64,$txt";
				}
			}


			}
			return null;
		}
		function image_upload_to_hex($form_id)
		{
		 $config['upload_path']=$_SERVER['CONTEXT_DOCUMENT_ROOT'].'/tmp/';
		 $config['allowed_types']='gif|jpg|png|';
		 $config['max_size']=1024*1024*3.5;
		 $this->upload->initialize($config);
			if($this->upload->do_upload($form_id))
			{
				$IMG=$this->upload->data();
				$IMGPATH = $IMG['full_path'];
				$IMGTYPE = $IMG['file_type'] ;
				$txt=base64_encode(file_get_contents($IMGPATH));
				$cleanup =  unlink($IMGPATH);
					if($cleanup)
					{
						 return "data:$IMGTYPE;base64,$txt";
					}



				}
				return null;
		}
		function expenses_prev_month()
		{
			$month = (date("m") == 1) ? 12 : (date("m")-1);
			$year = date("Y");
			$day = 1;
			return $year ."-".$month . "-" .$day;
		}
		function expenses_current_month()
		{
			$year =date("Y");
			$month = date("m");
			$day = (in_array(date("m"),array(1,3,5,7,8,10,12))) ? 31 : 30;
			if((date("Y")%4 == 0 && $month == 2))
			{
				$day = 29;
			}else{
				$day = ($month == 2) ? 28 : $day;
			}
			return $year ."-".$month . "-" .$day;
		}
?>
