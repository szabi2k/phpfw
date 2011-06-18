<?
class fw_mysql
{
	protected $fw_mysql_handle;
	
	function __construct($mysql_user,$mysql_password,$mysql_host='localhost')
	{
		$fw_mysql_handle = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die(mysql_error());
	}

    public function insert_sql($tblname,$assoc_values)
    {
    	$query="insert into $tblname set ";
    	foreach ($assoc_values as $k=>$v)
    	{
    		$query.="$k='".mysql_real_escape_string($v,$fw_mysql_handle)."',";
    	}
    	rtrim($query,',')
    	mysql_query($query,$fw_mysql_handle);
    }
    public function update_sql($tblname,$assoc_values,$assoc_where)
    {
	}
    public function delete_sql($tblname,$assoc_where)
    {
	}

    public function select_sql($what,$from,$assoc_where)
    {
    	$query="select $what from $from where ";
    	$flag=0;
    	foreach ($assoc_where as $k=>$v)
    	{
			if($flag) $query.=' and ';
			$flag=1;
    		$query.="$k='".mysql_real_escape_string($v,$fw_mysql_handle)."'";
    	}
		$res=mysql_query($query,$fw_mysql_handle);
    }
}
?>
