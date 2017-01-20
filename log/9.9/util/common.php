<?php
	define('D_BUG', '0');
	date_default_timezone_set("PRC");
	//时间
	$mtime = explode(' ', microtime());
	$_SGLOBAL['timestamp'] = $mtime[1];
	include_once("config.php");
	include_once("class_mysql.php");
	include_once("function_common.php");
	include_once("HttpClient.class.php");
	$_SGLOBAL['inajax'] = empty($_GET['inajax'])?0:intval($_GET['inajax']);
 
	//用户中心数据库
	function dbconnect() {
		global $_SGLOBAL, $_SC;
		if(empty($_SGLOBAL['db'])) {
			$_SGLOBAL['db'] = new dbstuff;
			$_SGLOBAL['db']->charset = $_SC['dbcharset'];
			$_SGLOBAL['db']->connect($_SC['dbhost'], $_SC['dbuser'], $_SC['dbpw'], $_SC['dbname'], $_SC['pconnect']);
		}
	}
	//vms库
	function dbvmsconnect() {
		global $_SGLOBAL, $_SC;
		if(empty($_SGLOBAL['dbvms'])) {
			$_SGLOBAL['dbvms'] = new dbstuff;
			$_SGLOBAL['dbvms']->charset = $_SC['dbcharset'];
			$_SGLOBAL['dbvms']->connect($_SC['dbhost'], $_SC['dbuser'], $_SC['dbpw'], $_SC['vmsname'], $_SC['pconnect']);
		}
	}
	//cms库
	function dbcmsconnect() {
		global $_SGLOBAL, $_SC;
		if(empty($_SGLOBAL['dbcms'])) {
			$_SGLOBAL['dbcms'] = new dbstuff;
			$_SGLOBAL['dbcms']->charset = $_SC['dbcharset'];
			$_SGLOBAL['dbcms']->connect($_SC['dbhost'], $_SC['dbuser'], $_SC['dbpw'], $_SC['cmsname'], $_SC['pconnect']);
		}
	}
	//uchome的数据库连接
	function dbuchomeconn() {
		global $_SGLOBAL, $_SC;
		if(empty($_SGLOBAL['dbuchome'])) {
			$_SGLOBAL['dbuchome'] = new dbstuff;
			$_SGLOBAL['dbuchome']->charset = $_SC['dbcharset'];
			$_SGLOBAL['dbuchome']->connect($_SC['dbhost'], $_SC['dbuser'], $_SC['dbpw'], $_SC['dbuchome'], $_SC['pconnect']);
		}
	}
	//统计库
	function dbtjconnect() {
		global $_SGLOBAL, $_SC;
		if(empty($_SGLOBAL['dbtj'])) {
			$_SGLOBAL['dbtj'] = new dbstuff;
			$_SGLOBAL['dbtj']->charset = $_SC['dbcharset'];
			$_SGLOBAL['dbtj']->connect($_SC['dbhost'], $_SC['dbuser'], $_SC['dbpw'], $_SC['tjname'], $_SC['pconnect']);
		}
	}

	//连接数据库
	dbconnect();

?>
