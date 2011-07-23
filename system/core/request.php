<?php

class fw_request
{
	protected $uri_original;
	protected $uri_routed;
	protected $uri_segments;

	protected $models_a;
	protected $db_a;
	
	function __construct(){}

	function get_model($name)
	{
		if(!defined($models_a[$name]))
		{
			require(PHPFW_APP_DIR."/models/$name.php");
			$models_a[$name]=new $name($this);
		}

		return $models_a[$name];
	}
	function get_db($dbid)
	{
		if(!defined($db_a[$dbid]))		$db_a[$dbid]=new fw_mysql($dbid);
		return $db_a[$dbid];
	}
	
	function pre_route(){}
	function route()
	{
		$this->uri_routed=$this->uri_original;
		require(PHPFW_APP_DIR."/config/router.php");
		
		// TODO: implement this	

	}
	function post_route(){}



	function process()
	{
		global $config;
		$this->uri_original=$_SERVER['PHP_SELF'];

		// it's pointless trying to sanitize a broken uri, 
		// if it's broken, or contains illegal characters we just simply quit
		if(preg_match('/[^a-zA-Z0-9\-_\/\.]/',$this->uri_original))
			{echo "error: ".$this->uri_original; return;}
			// TODO implement here error_view display
		
		if($config['enable_routing']==1)
		{
			$this->pre_route();
			$this->route();
			$this->post_route();
		}
		else
		{
			$this->uri_routed=$this->uri_original;
		}
		$this->build_segments();
		if(defined($this->uri_segments[0]))
			$runclass=$this->uri_segments[0];
		else
			$runclass=$config['default_controller'];
	
		if(defined($this->uri_segments[1]))
			$runfunc=$this->uri_segments[1];
		else
			$runfunc='index';
		
		$handler=new $runclass;
		$handler->$runfunc($this->uri_segments);
		
		
	
	
	}
	
	function build_segments()
	{
		$this->uri_segments=explode('/',$this->uri_routed);
	}


}

?>
