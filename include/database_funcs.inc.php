<?php

require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");

function dbconnect() {
/**
 * return database object if succeed
 * throw exception 'could not connect to mysql server' if failed
 */
	@ $db = new mysqli( 'localhost', 'server_zyrsksw', '0urgoal_n0zhuyan0war', 'zyrsksw');
	if( mysqli_connect_errno() ) {
		throw new Exception('暂时无法连接到数据库。请稍后再试。');
	} else {
		if( ! $db->set_charset( 'utf8') )
			throw new Exception("设置数据库字符格式时出现了问题。请您稍后再试。");
		return $db;
	}
}



?>
