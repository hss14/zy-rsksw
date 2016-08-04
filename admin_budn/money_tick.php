<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
	session_start();
	$page = new PageAdmin();

	$page->beforetry();

	if( isset($_SESSION['admin_name']) ) {
		try {
		}
		catch (Exception $e) {
			echo "\t\t<br/><br/><p class='RedFont'>".$e->getMessage()."<br/>请您稍后再试。</p>\n";
			echo "\t\t<br/><br/><a href='/admin_budn/index_login.php'>&gt;&gt;返回管理员界面首页</a>";
		}
	} //end of if isset $_SESSION

	$page->aftertry();
?>
