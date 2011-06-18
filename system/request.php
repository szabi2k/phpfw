<?

class fw_request
{
	protected $uri_original;
	protected $uri_routed;
	
	function __construct(){}
	
	function pre_route(){}
	function route()
	{
		if(!$conf['enable_routing']) return;

		include("$PHPFW_APPDIR/config/route.php");
		

	}
	function post_route(){}



}

?>
