<?

// registering autoloader
spl_autoload_register(function ($class_name)
{
	global $PHPFW_SYSDIR;
	$class_name=preg_replace("/^fw_/","",$class_name);
	
    $possibilities = array("$PHPFW_SYSDIR/$class_name.php",$class_name.'.php');
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

global $PHPFW_APPDIR;
include("$PHPFW_APPDIR/config/config.php");


	

if($conf['enable_routing'])	$fw_router=new router();


?>
