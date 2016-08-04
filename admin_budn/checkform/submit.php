<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
	session_start();

	$tablename = $EXAMS[ $_SESSION['table'] ]['db_table'];
	$id = $_SESSION['id'];
	unset( $_SESSION['id'] );

	$page = new PageAdmin();

	$page->beforetry();

	if( isset($_SESSION['admin_name']) ) {
		try {
			$checkflag = $_POST['checkflag'];
			$failstr = trim( $_POST['failstr'] );

			if( (!$checkflag) || ( ($checkflag!=1)&&($checkflag!=-1) ) || ( ($checkflag==-1)&&(!$failstr) )   )
				throw new Exception("您没有选择审核结果，或者选择了审核不通过但没有填写相应的原因。请重新审核！");

			if( ($checkflag==-1) && (!get_magic_quotes_gpc()) )
				$failstr = addslashes( $failstr );

			$query = "update ".$tablename." set checkflag=".(int)$checkflag;
			if( $checkflag == -1 )
				$query .= ", failstr='".$failstr."'";
			$query .= " where id='".$id."'";

			$result = dbquery($query,0,1);

			echo "\t\t<br/>\n"."\t\t<p><strong>提交成功！</strong></p><br/><br/>\n";
			echo "\t\t<p><a href='/admin_budn/checkform/".$_SESSION['table'].".php'><span class='a_href'>&gt;&gt; 继续审核下一条</span></a><br/><br/><br/></p>\n";
		}
		catch (Exception $e) {
			echo "\t\t<br/><br/><p class='RedFont'>".$e->getMessage()."</p>\n";
		}
	} //end of if isset $_SESSION

	$page->aftertry();
?>
