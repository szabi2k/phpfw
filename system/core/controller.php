<?php

class fw_controller
{
	var $config;
	var $timenow;
	var $vars_session;
	var $sessiondata;
	var $response_json;

	var $var_cookie;

	function __construct()
	{
		$var_cookie=$_COOKIE;
		$this->timenow=time();
		
		if($this->var_cookie['custom1']==$this->config['secret_cookie'])
				$this->config['is_admin_mode']=1;
		
		$this->config['staticpath']='/static_gamma';
		$this->config['iconpath']='/static_gamma/icons/icons';

		$this->config['icon_accept']='/static_gamma/icons/icons/accept.png';
		$this->config['icon_error']='/static_gamma/icons/icons/error.png';
	
		$this->config['city_current']= 11;
		
		
#		$this->template->set('staticpath', '/static_gamma');
#		$this->template->set('iconpath', '/static_gamma/icons/icons');
#		$this->template->set('indexpath',$this->config->item('index_page'));

#		$this->load->library('session');
#		$this->load->model('sessiondata');
#		$this->vars_session=$this->sessiondata->data_init();

//		$this->config['user_id',1);
		$response_json=array();
	}
	
	function __destruct()
	{
#		$this->sessiondata->data_flush();
	}
	function json_append()
	{
		$this->response_json[]=func_get_args();
	}
	function json_display()
	{
		echo json_encode($this->response_json);
	}
	function page_display($content_name)
	{
	
//		if(!$this->config->item('user_id'))
		if(!$this->session->userdata('user_id'))
			$this->template->load_guest($content_name);
		else 
		{
			$user_id=$this->session->userdata('user_id');
			
			$this->load->model('citydata');
			$mycitylist=$this->citydata->get_mycities($user_id);
			$this->template->set('mycitylist',$mycitylist);
//			if(!$this->session->userdata('city_id'))
// TODO: handle no current city
			$city_id=$this->config->item('city_current');

			$this->template->set('mycitydata',$this->citydata->get_citydata($city_id));
			
			$this->template->load_user2($content_name);
		}
	}
	function ajax_display($content_name)
	{
		if(!$this->session->userdata('user_id'))
			$this->template->load_guest($content_name);
		else 
		{
			$user_id=$this->session->userdata('user_id');
			$this->template->ajax_page($content_name);
		}
	}
	function disp_msg_line($div,$txt,$status) // status= accept|error
	{
		if($status=='accept')
		{
			$this->json_append('setinner',$div,"<img src='".$this->config->item('icon_accept')."'> $txt");
			$this->json_append('setclass',$div,"ui-state-highlight message_area");
		}
		
		if($status=='error')
		{
			$this->json_append('setinner',$div,"<img src='".$this->config->item('icon_error')."'> $txt");
			$this->json_append('setclass',$div,"ui-state-error message_area");
		}
	}
	function send_dialog($divid,$title,$content,$width=500,$height=400)
	{
		$this->json_append('modal_new',$title,$content,$width,$height,$divid);

	}

}

/* End of file main.php */
/* Location: ./app_g1/controllers/main.php */
?>