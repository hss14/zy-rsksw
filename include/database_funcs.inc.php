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

function dbquery( $query, $returnone=0, $affectone=0 ) {
	$db = dbconnect();
	$result = $db->query( $query );
	if( !$result )
		throw new Exception( "查询数据库时出现了一些问题！请您稍后再试。" );
	if( $returnone && ($result->num_rows != 1)  )
		throw new Exception( "查询数据库的返回结果出错了！请您稍后再试。" );
	if( $affectone && ($db->affected_rows!=1) )
		throw new Exception ("修改数据库时出错了！请您稍后再试。");
	$db->close();
	return $result;
}


function num2check( $tablename, $should='done', $shouldnot='checkflag' ) {
	$db = dbconnect();
	$result = $db->query( "select count(*) from ".$tablename." where ".$shouldnot." =0 and ".$should." =1" );
	if( !$result ) {
		throw new Exception("暂时无法连接到数据库".$tablename."！请您稍后再进行审核工作。");
	}
	$count_array = $result->fetch_row();
	$num = $count_array[0];
	$result->free();
	$db->close();
	return $num;
}



?>
