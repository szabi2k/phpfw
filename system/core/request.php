<?

class fw_request
{
	protected $uri_original;
	protected $uri_routed;
	protected $uri_segments;
	
	function __construct(){}
	
	function pre_route(){}
	function route()
	{
		global $PHPFW_APP_DIR;
		$this->uri_routed=$this->uri_original;
		include("$PHPFW_APP_DIR/config/route.php");
		
		// TODO: implement this	

	}
	function post_route(){}



	function process()
	{
		$this->uri_original=$_SERVER['PHP_SELF'];

		// it's pointless trying to sanitize a broken uri, 
		// if it's broken, or contains illegal characters we just simply quit
		if(preg_match('/[^a-zA-Z0-9\-_]/',$this->uri_original))
			return;
			// TODO implement here error_view display
		
		if($conf['enable_routing']==1)
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
			$runclass=$this->config['default_controller'];
	
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
