<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/include/header.inc.php");
	session_start();

	$logout_page = new PageZyrsksw();

	$old_user = $_SESSION['admin_name'];
	unset($_SESSION['admin_name']);
	$result_dsty = session_destroy();

	$logout_page->content = "\n\n<div class='div900c'><div class='contation' >\n";

	if( isset($old_user) ) {
		if( $result_dsty ) {
			$logout_page->content .= "<p class='RedFont'><br/><br/>登出成功。您可以放心离开了。</p>\n";
		} else {
			$logout_page->content .= "<p class='RedFont'><br/><br/>暂时无法将您登出。请您稍等片刻再试。</p>\n";
		}
	} else {
		$logout_page->content .= "<p class='RedFont'><br/><br/>您并未登录，因此无需登出。</p>\n";
	}

	$logout_page->content .= "<p><br/><br/></br>返回<a href='/index.php'><span class='a_href'>首页</span></a></p>\n"."</div></div>\n";

	$logout_page->Display();
?>
