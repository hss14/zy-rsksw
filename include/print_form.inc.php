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

function login_form() {
?>
		<p><br/><br/>请输入您的身份证号码与姓名。</p>
		<p>您的身份证号码与姓名将作为您网上报名和查分的唯一凭证，请务必正确填写，否则责任自负</p>
		<p class="RedFont"><br/><br/>注意：带 * 的为必填项<br/><br/></p>
		<form method="post" action="enroll_menu.php">
			<table class="form_table" border="0" cellpadding="15" cellspacing="15"><tr>
					<td><span class="Red">*</span>身份证号码：</td>
					<td><input type="text" name="id1" maxlength="18"/></td>
				</tr><tr>
					<td><span class="Red">*</span>姓名：</td>
					<td><input type="text" name="name1" maxlength="6"/></td>
				</tr><tr>
					<td><span class="Red">*</span>请再次输入您的身份证号码：</td>
					<td><input type="text" name="id2" maxlength="18"/></td>
				</tr><tr>
					<td><span class="Red">*</span>请再次输入您的姓名：</td>
					<td><input type="text" name="name2" maxlength="6"/></td>
				</tr><tr>
					<td colspan="2" align="center">
					<input type="submit" value="登录" style="font-size:15px"/></td>
				</tr>
			</table>
		</form>

		<p><br/><br/></br>返回<a href="/index.php"><span class="a_href">首页</span></a></p>
<?php
}

function personal_form( $form_action ) {
		echo "\t\t<br/><h3>填写个人信息</h3><br/>\n";
		echo "\t\t<form action='".$form_action."' method='post'>\n";
?>
		<p class="RedFont"><br/><br/>注意：标有*的为必填项目<br/><br/></p>
		<table class="form_table" border="0" cellpadding="15" cellspacing="15"><tr>
			<tr>
				<td><span class="Red">*</span>性别：</td>
				<td><select name="gender">
					<option value="男">男</option>
					<option value="女">女</option>
				</select></td>
			</tr>
			<tr>
				<td><span class="Red">*</span>民族：</td>
				<td><input type="text" name="people" maxlength="7"/></td>
			</tr>
			<tr>
				<td><span class="Red">*</span>政治面貌：</td>
				<td><select name="politics">
					<option value="01中共党员">中共党员</option>
					<option value="02中共预备党员">中共预备党员</option>
					<option value="03共青团员">共青团员</option>
					<option value="04民革党员">民革党员</option>
					<option value="05民盟盟员">民盟盟员</option>
					<option value="06民建会员">民建会员</option>
					<option value="07民进会员">民进会员</option>
					<option value="08农工党党员">农工党党员</option>
					<option value="09致公党党员">致公党党员</option>
					<option value="10九三学社社员">九三学社社员</option>
					<option value="11台盟盟员">台盟盟员</option>
					<option value="12无党派人士">无党派人士</option>
					<option value="13群众">群众/普通居民</option>
				</select></td>
			</tr>
			<tr>
				<td><span class="Red">*</span>婚姻状况：</td>
				<td><select name="marriage">
					<option value="未婚">未婚</option>
					<option value="已婚">已婚</option>
					<option value="离异">离异</option>
					<option value="丧偶">丧偶</option>
				</select></td>
			</tr>
			<tr>
				<td><span class="Red">*</span>手机号码：</td>
				<td><input type="text" name="cellphone" maxlength="11"/></td>
			</tr>
			<tr>
				<td>电子邮箱：</td>
				<td><input type="text" name="email" maxlength="254"/></td>
			</tr>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="center">
				<input type="submit" value="确认信息并提交" style="font-size:15px"/></td>
			</tr>
		</table>
		</form>
<?php
}

function cmpt_form()
{
	global $MONTH;
?>
		<form action='computerform.php' method='post'>
		<p class="RedFont"><br/><br/>注意：标有*的为必填项目<br/><br/></p>
		<table class="form_table" border="0" cellpadding="15" cellspacing="15"><tr>
			<tr>
				<td><span class="Red">*</span>申报学历：</td>
				<td><select name="shenbao_educ">
					<option value="中专">中专</option>
					<option value="大专">大专</option>
					<option value="本科">本科</option>
					<option value="研究生">研究生</option>
				</select></td>
			</tr>
			<tr>
				<td><span class="Red">*</span>申报学历毕业时间：</td>
				<td>
					<input type="text" name="shenbao_grad_year" size="4" maxlength="4"/>年(填写4位数字)&nbsp;&nbsp;
					<select name="shenbao_grad_month">
<?php
					for( $i=0; $i<12;  $i++ ) {
						echo "\t\t\t\t\t\t<option value='".$MONTH[$i]."'>".$MONTH[$i]."</option>\n";
					}
?>
					</select>月
				</td>
			</tr>
			<tr>
				<td><span class="Red">*</span>申报学历专业：</td>
				<td><input type="text" name="shenbao_major" maxlength="20"/></td>
			</tr>
			<tr>
				<td><span class="Red">*</span>申报资格专业名称：</td>
				<td><input type="text" name="shenbao_for_major" maxlength="20"/></td>
			</tr>
			<tr>
				<td><span class="Red">*</span>工作单位：</td>
				<td><input type="text" name="company" maxlength="20"/></td>
			</tr>
			<tr>
				<td><span class="Red">*</span>现任专业技术职务：</td>
				<td><input type="text" name="position" maxlength="20"/></td>
			</tr>
			<tr>
				<td><span class="Red">*</span>开始任职时间：</td>
				<td>
					<input type="text" name="company_year" maxlength="4" size="4"/>年(填写4位数字)&nbsp;&nbsp;
					<select name="company_month">
<?php
					for( $i=0; $i<12;  $i++ ) {
						echo "\t\t\t\t\t\t<option value='".$MONTH[$i]."'>".$MONTH[$i]."</option>\n";
					}
?>
					</select>月
				</td>
			</tr>
			<tr>
				<td><span class="Red">*</span>报考级别：</td>
				<td><select name="level_code">
					<option value="0001">初级</option>
					<option value="0010">中级</option>
					<option value="0100">高级</option>
				</select></td>
			</tr>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="center">
				<input type="submit" value="确认并提交" style="font-size:15px"/></td>
			</tr>
		</table>
		</form>

<?php
}



?>
