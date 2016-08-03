<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.inc.php" );

function print_td( $content='&nbsp;', $colspan=1, $rowspan=1 ) {
	if( $colspan == 1 ) {
		if( $rowspan == 1 ) 
			echo "\t\t\t\t<td>".$content."</td>\n";
		else
			echo "\t\t\t\t<td rowspan='".$rowspan."'>".$content."</td>\n";
	} else {
		if( $rowspan == 1 ) 
			echo "\t\t\t\t<td colspan='".$colspan."' >".$content."</td>\n";
		else
			echo "\t\t\t\t<td colspan='".$colspan."' rowspan='".$rowspan."'>".$content."</td>\n";
	}
}

/**
 * echo a text type input form table row <tr>..</tr> in a form
 */
function echo_text_form_tr ( $str, $name, $maxlength, $comment=NULL, $multi_rows = 0, $necessary = 1 ) {
	$cols = 40;
	$rows = (int)$maxlength/$cols + 1;
	echo "\t\t\t\t<tr><td></td><td></td></tr>\n";
	echo "\t\t\t\t<tr>\n";
	if( $necessary ) {
		echo "\t\t\t\t\t<td><span class='Red'>*</span>".$str."</td>\n";
	} else {
		echo "\t\t\t\t\t<td>&nbsp;".$str."</td>\n";
	}
	if( $multi_rows) {
		echo "\t\t\t\t\t<td><textarea name='".$name."' rows='".$rows."' cols='".$cols."' maxlength='".$maxlength."'></td>\n";
	} else {
		echo "\t\t\t\t\t<td><input type='text' name=".$name." maxlength='".$maxlength."'/></td>\n";
		// cols default =20 if not specified
		// minlength
	}
	echo "\t\t\t\t<tr>\n";
	if( $comment != NULL ) {
		echo "\t\t\t\t<tr><td>&nbsp;</td><td><small>".$comment."</small></td></tr>\n";
	}
}

function echo_submit_button( $value ) {
?>
				<tr><td></td><td></td></tr>
				<tr><td></td><td></td></tr>
				<tr>
					<td colspan="2" align="center">
<?php
	echo "<input type='submit' value=".$value." style='font-size:15px'/></td>\n";
	echo "\t\t\t\t</tr>\n";
}

function echo_select_tr($str, $name, $array, $necessary=1) {
	echo "\t\t\t\t<tr><td></td><td></td></tr>\n";
	echo "\t\t\t\t<tr>\n";
	if( $necessary ) {
		echo "\t\t\t\t\t<td><span class='Red'>*</span>".$str."</td>\n";
	} else {
		echo "\t\t\t\t\t<td>&nbsp;".$str."</td>\n";
	}
	echo "\t\t\t\t\t<td><select name='".$name."'>\n";
	foreach ( $array as $show => $value ) {
		echo "\t\t\t\t\t\t<option value='".$value."'>".$show."</option>\n";
	}
	echo "\t\t\t\t\t</select></td>\n";
	echo "\t\t\t\t</tr>\n";
}


function echo_date($str, $year_name, $month_name, $necessary=1 ) {
	global $MONTH;
	echo "\t\t\t\t<tr><td></td><td></td></tr>\n";
	echo "\t\t\t\t<tr>\n";
	if( $necessary ){
		echo "\t\t\t\t\t<td><span class='Red'>*</span>".$str."</td>\n";
	} else {
		echo "\t\t\t\t\t<td>&nbsp;".$str."</td>\n";
	}
	echo "\t\t\t\t\t<td>\n".
		"\t\t\t\t\t\t<input type='text' name='".$year_name."' size='4' maxlength='4'/>年(填写4位数字)&nbsp;&nbsp;\n".
		"\t\t\t\t\t\t<select name='".$month_name."'>\n";
	for( $i=0; $i<12;  $i++ ) {
		echo "\t\t\t\t\t\t\t<option value='".$MONTH[$i]."'>".$MONTH[$i]."</option>\n";
	}
	echo "\t\t\t\t\t\t</select>月\n"."\t\t\t\t\t</td>\n"."\t\t\t\t</tr>\n";
}


function login_form() {
?>
		<p><br/><br/>请输入您的身份证号码与姓名。</p>
		<p>您的身份证号码与姓名将作为您网上报名和查分的唯一凭证，请务必正确填写，否则责任自负</p>
		<p class="RedFont"><br/><br/>注意：带 * 的为必填项<br/><br/></p>
		<form method="post" action="enroll_menu.php">
			<table class="form_table" border="0" cellpadding="15" cellspacing="15">
<?php
			echo_text_form_tr( '身份证号码', 'id1', 18 );
			echo_text_form_tr( '姓名', 'name1', 6 );
			echo_text_form_tr( '请再次输入您的身份证号码', 'id2', 18 );
			echo_text_form_tr( '请再次输入您的姓名', 'name2', 6 );
			echo_submit_button( '登录' );
?>
			</table>
		</form>

		<p><br/><br/></br>返回<a href="/index.php"><span class="a_href">首页</span></a></p>
<?php
}

function personal_form( $form_action ) {
		$politics_array = array ( '中共党员' => '01中共党员',
					'中共预备党员' => '02中共预备党员',
					'共青团员' => '03共青团员',
					'民革党员' => '04民革党员',
					'民盟盟员' => '05民盟盟员',
					'民建会员' => '06民建会员',
					'民进会员' => '07民进会员',
					'农工党党员' => '08农工党党员',
					'致公党党员' => '09致公党党员',
					'九三学社社员' => '10九三学社社员',
					'台盟盟员' => '11台盟盟员',
					'无党派人士' => '12无党派人士',
					'群众' => '13群众/普通居民'
					);

		echo "\t\t<br/><h3>填写个人信息</h3><br/>\n";
		echo "\t\t<form action='".$form_action."' method='post'>\n";
?>
		<p class="RedFont"><br/><br/>注意：标有*的为必填项目<br/><br/></p>
		<table class="form_table" border="0" cellpadding="15" cellspacing="15"><tr>
<?php
		echo_select_tr( '性别：', 'gender', array( '男'=>'男', '女'=>'女'  ) );
		echo_text_form_tr( '民族：', 'people', 7);
		echo_select_tr( '政治面貌：', 'politics', $politics_array );
		echo_select_tr( '婚姻状况：', 'marriage', array( '未婚'=>'未婚', '已婚'=>'已婚', '离异'=>'离异', '丧偶'=>'丧偶' ) );
		echo_text_form_tr( '手机号码：', 'cellphone', 11 );
		echo_text_form_tr( '电子邮箱：', 'email', 254, NULL, 0, 0 );
		echo_submit_button( '确认信息并提交' );
?>
		</table>
		</form>
<?php
}

function cmpt_form()
{
	global $MONTH;
	global $EDUC;
	global $CPT_LEVEL;
?>
		<form action='/enroll/computer_test/computer_form.php' method='post'>
		<p class="RedFont"><br/><br/>注意：标有*的为必填项目<br/><br/></p>
		<table class="form_table" border="0" cellpadding="15" cellspacing="15">
<?php
		echo_select_tr( '申报学历：', 'shenbao_educ', $EDUC);
		echo_date( '申报学历毕业时间：', 'shenbao_grad_year', 'shenbao_grad_month' ); 
		echo_text_form_tr( '申报学历专业：', 'shenbao_major', 20 );
		echo_text_form_tr( '申报资格专业名称：', 'shenbao_for_major', 20 );
		echo_text_form_tr( '工作单位：', 'company', 20 );
		echo_text_form_tr( '现任专业技术职务：', 'position', 20 );
		echo_date( '开始任职时间：', 'company_year', 'company_month' );
		echo_select_tr( '报考级别：', 'level_code', $CPT_LEVEL);
		echo_submit_button('确认信息并提交');
?>
		</table>
		</form>

<?php
}


function recruit_form()
{
	global $MONTH;
?>
		<form action='/enroll/recruit_test/recruit_form.php' method='post'>
		<p class="RedFont"><br/><br/>注意：标有*的为必填项目<br/><br/></p>
		<table class="form_table" border="0" cellpadding="15" cellspacing="15">
<?php
		echo_text_form_tr( '拟报考岗位：', 'level_code', 4, '填写4位岗位代码', 0, 1 );
		
		echo_select_tr( '第一学历：', 'first_educ', $EDUC);
		echo_date( '第一学历毕业时间：', 'first_grad_year', 'first_grad_month' );
		echo_text_form_tr('第一学历毕业院校：', 'first_school', 20, '', 0, 1);
		echo_text_form_tr('第一学历专业：', 'first_major', 20, '',0, 1);
		
		echo_select_tr( '最高学历：', 'best_educ', $EDUC);
		echo_date( '最高学历毕业时间：', 'best_grad_year', 'best_grad_month' );
		echo_text_form_tr('最高学历毕业院校：', 'best_school', 20, '', 0, 1);
		echo_text_form_tr('最高学历专业：', 'best_major', 20, '',0, 1);

		echo_text_form_tr('最高学历毕业院校', 'best_school', 20, '', 0, 1);
		echo_text_form_tr('最高学历专业', 'best_major', 20, '',0, 1);

		echo_text_form_tr('资格证状况', 'certificate', 100, '不超过100字', 1, 1);
		echo_text_form_tr('普通话状况', 'mandarin', 20, '不超过20字',0, 1);
		echo_text_form_tr('英语状况', 'english', 20, '不超过20字', 0, 1);
		echo_text_form_tr('计算机状况', 'computer', 20, '不超过20字', 0, 1);
		echo_text_form_tr('主要学习、工作<br/>简历和奖惩情况', 'resume', 300, '不超过300字', 1, 1);
		echo_text_form_tr('身高(厘米)', 'height', 3, '填写3位数字', 0, 1);
		echo_text_form_tr('体重(千克)', 'weight', 2, '填写2位数字', 0, 1);
		echo_text_form_tr('兴趣特长', 'hobby', 20, '不超过20字', 0, 1);
		echo_text_form_tr('家庭地址', 'addr', 20, '不超过20字', 0, 1);
		echo_text_form_tr('邮政编码', 'postcode', 6, '', 0, 1);
?>
		</table>

		<br/><br/><hr><br/><br/>
		<p><strong>家庭主要成员情况：</strong></p><br/>
		<p><small>应如实填写每一位家庭主要成员的情况。最多可填写3位。每位家庭成员，须填写全部5条信息，无相关信息应填“无”，否则无效。</small></p><br/>
		<table class="form_table" border="0" cellpadding="15" cellspacing="15">

			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php
		echo_text_form_tr('姓名', 'family1_name', 6, '', 0, 0);
		echo_text_form_tr('与本人关系', 'family1_relation', 5, '', 0, 0);
		echo_text_form_tr('年龄', 'family1_age', 3, '填写数字', 0, 0);
		echo_text_form_tr('所在单位', 'family1_company', 20, '', 0, 0);
		echo_text_form_tr('职务或职称', 'family1_position', 20, '', 0, 0);
?>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php
		echo_text_form_tr('姓名', 'family2_name', 6, '', 0, 0);
		echo_text_form_tr('与本人关系', 'family2_relation', 5, '', 0, 0);
		echo_text_form_tr('年龄', 'family2_age', 3, '填写数字', 0, 0);
		echo_text_form_tr('所在单位', 'family2_company', 20, '', 0, 0);
		echo_text_form_tr('职务或职称', 'family2_position', 20, '', 0, 0);
?>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php
		echo_text_form_tr('姓名', 'family3_name', 6, '', 0, 0);
		echo_text_form_tr('与本人关系', 'family3_relation', 5, '', 0, 0);
		echo_text_form_tr('年龄', 'family3_age', 3, '填写数字', 0, 0);
		echo_text_form_tr('所在单位', 'family3_company', 20, '', 0, 0);
		echo_text_form_tr('职务或职称', 'family3_position', 20, '', 0, 0);
		echo "\t\t\t<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
		echo_submit_button('确认信息并提交');
?>
		</table>
		</form>

<?php
}



?>
