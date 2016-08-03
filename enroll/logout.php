<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/include/header.inc.php");
	session_start();

	$logout_page = new PageZyrsksw();

	$old_user = $_SESSION['valid_user'];
	unset($_SESSION['valid_user']);
	$result_dsty = session_destroy();

	if( isset($old_user) ) {
		if( $result_dsty ) {
			$logout_page->content = "<p class='RedFont'><br/><br/>登出成功。您可以放心离开了。</p>";
		} else {
			$logout_page->content = "<p class='RedFont'><br/><br/>暂时无法将您登出。请您稍等片刻再试。</p>";
		}
	} else {
		$logout_page->content = "<p class='RedFont'><br/><br/>您并未登录，因此无需登出。</p>";
	}

	$logout_page->content .= "<p><br/><br/></br>返回<a href='/index.php'><span class='a_href'>首页</span></a></p>";

	$logout_page->Display();
?>
