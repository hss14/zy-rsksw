<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.inc.php" );

/**
 * throw 3 kinds of exceptions if failed 
 * return 1 if register succeed
 * return 2 if found user in db
 * parameter @id,@name validity already checked 
 */
function register( $id, $name ) {
	$conn = dbconnect();	
	$result = $conn->query( "select id, name from personal where id='".$id."'" );
	if( !$result ) {
		throw new Exception ("抱歉，暂时无法执行数据库查询，请稍后再试");
	}

	if ( $result->num_rows == 0 ) {  // new user, insert into db
		$result = $conn->query ("insert into personal(id, name) values ('".$id."', '".$name."' )");
		if( !$result ) {
			throw new Exception("抱歉，暂时无法将您的数据注册到数据库，请稍后再试");
		}
		return 1;
	} else {
		// check if id and name are both right, if so, log user in
		$row = $result->fetch_assoc();
		if( $name == $row['name'] )
			return 2;
		else
			throw new Exception("您的身份信息 与 您首次注册时填写的信息不符！登录失败！\n
						是否是登陆信息填写错误？请重试。\n
						如果您此前首次注册时信息填写错误，需本人持身份证件到本单位联系后台技术人员更正信息。\n");
	}
}





?>
