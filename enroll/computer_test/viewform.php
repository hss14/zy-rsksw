<?php

require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
session_start();

display_html_header();

if( !isset($_SESSION['valid_user']) ) {
	echo "\t\t<h3>您还没有登录！</h3>\n";
	echo "\t\t<p><br/><br/></br>&gt;&gt;返回<a href='/index.php'><span class='a_href'>首页</span></a></p>";
} else {
	$id = $_SESSION['valid_user'];
	try {
		$db = dbconnect();
		
		$query = "select name, gender,cellphone from personal where id='".$id."'"; 
		$result = $db->query($query);
		if( (!$result) || ( $result->num_rows != 1 ) )
			throw new Exception("暂时无法在数据库中查询到您的个人信息。请您稍后再试。 ");
		$person_assc = $result->fetch_assoc();
		$result->free();

		$query = "select * from computer_test where id='".$id."'"; 
		$result = $db->query($query);
		if( (!$result) || ( $result->num_rows != 1 ) )
			throw new Exception("暂时无法在数据库中查询到您的报名信息。请您稍后再试。 ");
		$cpt_assc = $result->fetch_assoc();
		$result->free();

		$query = "select exam_name, level_code, level_position, money from exams where exam_id='01' and level_code='".$cpt_assc['level_code']."'"; 
		$result = $db->query($query);
		if( (!$result) || ( $result->num_rows != 1 ) )
			throw new Exception("暂时无法在数据库中查询到计算机考试报名信息。请您稍后再试。 ");
		$exam_assc = $result->fetch_assoc();
		$result->free();

		$db->close();

		print_cmpt_table( $person_assc, $cpt_assc, $exam_assc );
	} //end of try
	catch (Exception $e) {
		echo "\t\t<p class='RedFont'>".$e->getMessage()."</p><br/><br/><br/>\n";
		echo "\t\t<p><br/><br/></br>&gt;&gt;返回<a href='/index.php'><span class='a_href'>首页</span></a></p>";
	} //end of catch
}


function print_cmpt_table( $person_assc, $cpt_assc, $exam_assc ) {
	global $CPTR_SUBJECTS;

	echo "<br/><br/><br/><h1 style='text-align:center;'>".$exam_assc['exam_name']."</h1><br/><br/><br/>";

	echo "\t\t<table class='print_table' cellspacing='0'>\n";
	echo "\t\t\t<tr>\n";
		print_td('姓名');
		print_td( $person_assc['name'] );
		print_td('性别');
		print_td( $person_assc['gender'] );
		print_td('&nbsp;', 1, 4);
	echo "\t\t\t</tr>\n"."\t\t\t<tr>\n";
		print_td('身份证号码');
		print_td( $cpt_assc['id'], 3);
	echo "\t\t\t</tr>\n"."\t\t\t<tr>\n";
		print_td('工作单位');
		print_td( $cpt_assc['company'], 3);
	echo "\t\t\t</tr>\n"."\t\t\t<tr>\n";
		print_td('申报学历');
		print_td( $cpt_assc['shenbao_educ']);
		print_td('申报学历<br/>毕业时间');
		print_td( $cpt_assc['shenbao_grad_date'] );
	echo "\t\t\t</tr>\n"."\t\t\t<tr>\n";
		print_td('申报学历专业');
		print_td( $cpt_assc['shenbao_major'], 2);
		print_td('申报资格<br/>专业名称');
		print_td( $cpt_assc['shenbao_for_major'] );
	echo "\t\t\t</tr>\n"."\t\t\t<tr>\n";
		print_td('现任专业<br/>技术职务');
		print_td( $cpt_assc['position'], 2);
		print_td('任职时间');
		print_td( $cpt_assc['company_date']);
	echo "\t\t\t</tr>\n"."\t\t\t<tr>\n";
		print_td('联系电话');
		print_td( $person_assc['cellphone'], 4);
	echo "\t\t\t</tr>\n"."\t\t\t<tr>\n";

		switch( $exam_assc['level_code'] ) {
			case '0001':	$nsubjects = 2;	$line = 3;	break;
			case '0010':	$nsubjects = 3;	$line = 3;	break;
			case '0100':	$nsubjects = 4;	$line = 4;	break;
		}

		print_td('报考科目', 1, $line );
		print_td( $CPTR_SUBJECTS[0] );
		print_td('报名费', 1, $line);
		print_td( $exam_assc['level_position'].$exam_assc['money']."元<br/>（含培训费、教材费、考试费）", 2, $line-1 );
	
		for( $i=2; $i<=$nsubjects; $i++ ) {
			echo "\t\t\t</tr>\n"."\t\t\t<tr>\n";
				print_td( $CPTR_SUBJECTS[$i-1] );
			if( ($i==$nsubjects) && ($i>2) )
				print_td( '补考费：61元/科', 2);
		}
		if( $i == 2) {
			echo "\t\t\t</tr>\n"."\t\t\t<tr>\n";
				print_td( '&nbsp;' );
				print_td( '补考费：61元/科', 2);
		}
	echo "\t\t\t</tr>\n"."\t\t</table>\n";
}
?>
