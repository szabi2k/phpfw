<?php

class fw_model
{
	protected $fw_request;
	function __construct(&$request)
	{
		$this->fw_request=&$request;
	}
	
	function __destruct()
	{
	}

}

/* End of file main.php */
/* Location: ./app_g1/controllers/main.php */
?>
