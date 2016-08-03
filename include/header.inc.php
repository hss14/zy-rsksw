<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/include/template.inc.php');
// require_once($_SERVER['DOCUMENT_ROOT'].'/include/bulletin.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/notice.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/database_funcs.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/user_funcs.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/check_user_input.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/print_form.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/enroll_funcs.inc.php');

$MONTH = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );

$CPTR_SUBJECTS = array( 'WINDOWS XP', 'EXCEL 2003', 'WORD2003', 'INTERNET应用(XP版)' );

$EDUC = array ( '初中'=>'初中', '高中'=>'高中', '中专'=>'中专', '大专'=>'大专',
		'本科'=>'本科', '硕士'=>'硕士', '博士'=>'博士'
		);

$EXAMS = array ( 'computer' => array( 'db_table' => 'computer_test', 
				      'form' => '/enroll/computer_test/computer_form.php',
				      'printer' => '/enrol/computer_test/computer_printer.php',
				      'view' => '/enroll/computer_test/computer_view.php' ),

 		 'recruit' => array( 'db_table' => 'recruit_test', 
				      'form' => '/enroll/recruit_test/recruit_form.php',
				      'printer' => '/enrol/recruit_test/recruit_printer.php',
				      'view' => '/enroll/recruit_test/recruit_view.php' ),

 		 'level' => array( 'db_table' => 'level_test', 
				      'form' => '/enroll/level_test/level_form.php',
				      'printer' => '/enrol/level_test/level_printer.php',
				      'view' => '/enroll/level_test/level_view.php' ),

		);

$EXAM_ID = array( 'computer_test'	=> '01',
		  'recruit_test'	=> '02',
		  'level_test'		=> '03'
		);

$CPT_LEVEL = array( '初级'=>'0001',  '中级'=>'0010', '高级'=>'0100'  );

$CHINESE = array (	'id' 		=> '身份证号',
			'name' 		=> '姓名',
			'gender' 	=> '性别',
			'people'	=> '民族',
			'politics'	=> '政治面貌',
			'marriage'	=> '婚姻状况',
			'cellphone'	=> '手机号码',
			'email'		=> '电子邮箱',
			'shenbao_educ'	=> '申报学历',
			'shenbao_grad_date' => '申报学历毕业时间',
			'shenbao_for_major' => '申报资格专业名称',
			'shenbao_major'	=> '申报学历专业',
			'company'	=> '工作单位',
			'position'	=> '现任专业技术职务',
			'company_date'	=> '开始任职时间',
			'level_code'	=> '报考级别'
		);

?>
