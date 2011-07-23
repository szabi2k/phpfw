<?php

// registering autoloader
spl_autoload_register(function ($class_name)
{
	$class_name=preg_replace("/^fw_/","",$class_name);

	$possibilities = array(
			PHPFW_SYS_DIR."/core/$class_name.php",
			PHPFW_APP_DIR."/$class_name.php",
#			PHPFW_SYS_DIR."/$class_name.php",
			PHPFW_APP_DIR."/controllers/$class_name.php",
			PHPFW_APP_DIR."/models/$class_name.php",

//			PHPFW_SYS_DIR."/controllers/$class_name.php",
			$class_name.'.php');
	foreach ($possibilities as $file)
	{
		if (file_exists($file))
		{
			require_once($file);
			return true;
		}
	}
	return false;
});
// done registering autoloader

include(PHPFW_APP_DIR.'/config/config.php');


$rq=new fw_request();
$rq->process();
//if($config['enable_routing'])	list($run_controller,$run_function)=new router();


?>
