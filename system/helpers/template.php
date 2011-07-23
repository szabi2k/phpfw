<?php
    function template_get_contents($name,$vars)
    {
	if    (file_exists(PHPFW_APP_DIR."/templates/$name.php"))	$template_file=PHPFW_APP_DIR."/templates/$name.php";
	elseif(file_exists(PHPFW_SYS_DIR."/templates/$name.php"))	$template_file=PHPFW_SYS_DIR."/templates/$name.php";
	else return;

	ob_start();
	require ($template_file);
	$res=ob_get_contents();
	ob_end_clean();
	return $res;
    }
?>
