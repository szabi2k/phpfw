<?

// registering autoloader
spl_autoload_register(function ($class_name)
{
	global $PHPFW_SYS_DIR;
	global $PHPFW_APP_DIR;

	$class_name=preg_replace("/^fw_/","",$class_name);
	
    $possibilities = array("$PHPFW_SYS_DIR/$class_name.php","$PHPFW_APP_DIR/$class_name.php",$class_name.'.php');
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

global $PHPFW_APP_DIR;
include("$PHPFW_APP_DIR/config/config.php");


	

if($conf['enable_routing'])	($run_controller,$run_function)=new router();


?>
