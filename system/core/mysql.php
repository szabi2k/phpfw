<?php
class fw_mysql
{
	protected $fw_mysql_handle;
	protected $fw_mysql_id;
	protected $fw_mysql_connected;
	
	function __construct($dbid)
	{
		
		$this->fw_mysql_handle=null;
		$this->fw_mysql_connected=0;
		$this->fw_mysql_id=$dbid;

		$this->connect2db(0);
	}
	
	function __destruct()
	{
		$this->fw_mysql_connected=0;
		mysql_close($this->fw_mysql_handle);
		$this->fw_mysql_handle=null;
	}

	function connect2db($query_follows=1)
	{
		if($this->fw_mysql_connected) return;
		
		include(PHPFW_APP_DIR.'/config/mysql.php');
		$dbinfo=$config['mysql'][$this->fw_mysql_id];

		if($dbinfo['delayed_connect']&&(!$query_follows)) return;
		
		$this->fw_mysql_handle = mysql_connect($dbinfo['server'], $dbinfo['dbuser'],$dbinfo['dbpass']) or die(mysql_error());
		mysql_select_db($dbinfo['dbname'],$this->fw_mysql_handle); 
		$this->fw_mysql_connected=1;
	}

    public function insert_sql($tblname,$assoc_values)
    {
    	$this->connect2db();
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
       	$this->connect2db();
	}
    public function delete_sql($tblname,$assoc_where)
    {
       	$this->connect2db();
	}

    public function select_sql($what,$from,$assoc_where)
    {
       	$this->connect2db();
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
