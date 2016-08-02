<?php

require_once( $_SERVER['DOCUMENT_ROOT']. "/include/header.inc.php" );

/**
 * check validity of id number, return true or false
 */
function checkid( $id ) {
	if( ( strlen($id)!=18 ) || ( ! preg_match('/^[0-9]{17}[0-9xX]$/i', $id) ) )
		return false;
	return true;
}

/**
 * check validity of chinese name, return true or false
 */
function checkname( $name ) {
	if( ! preg_match('/^[\x{4e00}-\x{9fa5}]{2,6}$/u', $name) )
		return false;
	return true;
}


function checkgender( $gender) {
	if( ($gender!='男') && ($gender!='女') )
		throw new Exception("您没有选择性别！请重新填写表格！");
}

function checkpeople($people) {
	if( ! preg_match('/^[\x{4e00}-\x{9fa5}]{1,7}$/u', $people) )
		throw new Exception("您输入的民族信息不正确！请重新填写表格！");
}

function checkpolitics($politics) {
	if( ($politics != "01中共党员") && ($politics != "02中共预备党员") &&
	    ($politics != "03共青团员") && ($politics != "12无党派人士") && ($politics != "13群众") && 
	    ($politics != "04民革党员") && ($politics != "05民盟盟员") &&
	    ($politics != "06民建会员") && ($politics != "07民进会员") &&
	    ($politics != "08民工党党员") && ($politics != "09致公党党员") &&
	    ($politics != "10九三学社社员") && ($politics != "11台盟盟员")  )
		throw new Exception("您没有选择政治面貌！请重新填写表格！");
}

function checkmarriage($marriage) {
	if( ($marriage!="未婚") && ($marriage!="已婚") && ($marriage!="离异") && ($marriage!="丧偶") )
		throw new Exception("您没有选择婚姻状况！请重新填写表格！");
}

function checkcellphone($cellphone) {
	if( !preg_match('/^[0-9]{11}$/i', $cellphone) )
		throw new Exception("您输入的电话号码格式不正确！请重新填写表格！");
}

function checkemail($email) {
	if( ($email) && ( !preg_match('/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/i', $email) ) )
		throw new Exception("你输入的电子邮箱地址格式不正确！请重新填写表格！");
}

function checkpersonal( $gender, $people, $politics, $marriage, $cellphone, $email ) {
	checkgender($gender);
	checkpeople($people);
	checkpolitics($politics);
	checkmarriage($marriage);
	checkcellphone($cellphone);
	checkemail($email);
}

function check_educ($educ) {
	if( ($educ!="中专") && ($educ!="大专") && ($educ!="本科") && ($educ!="研究生") )
		return false;
	return true;
}

function check_year($year) {
	if( preg_match('/^[0-9]{4}$/i', $year) && ( strnatcmp($year,'1900') > 0 ) && ( strnatcmp($year,'2100') < 0 ) )
		return true;
	return false;
}

function check_month( $month ) {
	if( preg_match('/^[0-9]{2}$/i', $month) && ( strnatcmp($month,'00') > 0 ) && ( strnatcmp($month,'13') < 0 ) )
		return true;
	return false;
}

function check_chinese ($chinese) {
	if( ! preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $chinese) )
		return false;
	return true;
}

function check_computer_level_code($level_code) {
	if( ($level_code!="0001") && ($level_code!="0010") && ($level_code!="0100")  )
		return false;
	return true;
}

function check_computer_form( $shenbao_educ, $shenbao_grad_year, $shenbao_grad_month, $shenbao_major, $shenbao_for_major, $company, $position, $company_year, $company_month, $level_code ) {
	if( !check_educ($shenbao_educ) )		throw new Exception("您没有选择 申报学历 ！请重新填写表格！");
	if( !check_year($shenbao_grad_year) ) 		throw new Exception("您填写的 申报学历毕业时间 年份 格式不正确！请重新填写表格！");
	if( !check_month($shenbao_grad_month) )		throw new Exception("您没有选择 申报学历毕业时间 月份 ！请重新填写表格！");
	if( !check_chinese($shenbao_major) )		throw new Exception("您填写的 申报学历专业 含有非中文字符，格式不正确！请重新填写表格！");
	if( !check_chinese($shenbao_for_major) )	throw new Exception("您填写的 申报资格专业名称 含有非中文字符，格式不正确！请重新填写表格！");
	if( !check_chinese($company) )			throw new Exception("您填写的 工作单位 含有非中文字符，格式不正确！请重新填写表格！");
	if( !check_chinese($position) )			throw new Exception("您填写的 现任专业技术职务 含有非中文字符，格式不正确！请重新填写表格！");
	if( !check_year($company_year) ) 		throw new Exception("您填写的 任职时间 年份 格式不正确！请重新填写表格！");
	if( !check_month($company_month) )		throw new Exception("您填写的 任职时间 月份 格式不正确！请重新填写表格！");
	if( !check_computer_level_code($level_code) ) 	throw new Exception("您没有选择报考级别！请重新填写表格！");
}


?>
