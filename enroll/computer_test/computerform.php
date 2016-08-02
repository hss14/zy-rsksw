<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
	session_start();
	$computer_form = new PageZyrsksw();

	$computer_form->DisplayHead();
?>

	<div class="div900c" >
		<div class="contation" >
<?php
	if( !isset($_SESSION['valid_user']) ) {
		echo "\t\t<h3>您还没有登录！</h3>\n";
		login_form();
	} else {
		$id = $_SESSION['valid_user'];
		echo "\t\t<p>身份证号码为".$id."的用户，欢迎您！</p>";
?>
		<p>如果该用户不是您，请<a href='/enroll/logout.php'>登出账户</a>并用本人身份信息登录！</p>
		<p><a href='/enroll/logout.php'><span class='a_href'>&gt;&gt; 登出账户</span></a><br/></p>
		<p><a href='/index.php'><span class='a_href'>&gt;&gt; 首页</span></a><br/><br/><br/></p>
		<hr>
<?php
		$shenbao_educ = trim( $_POST['shenbao_educ'] );
		$shenbao_grad_year = trim( $_POST['shenbao_grad_year'] );
		$shenbao_grad_month = trim( $_POST['shenbao_grad_month'] );
		$shenbao_major = trim( $_POST['shenbao_major'] );
		$shenbao_for_major = trim( $_POST['shenbao_for_major'] );
		$company = trim( $_POST['company'] );
		$position = trim( $_POST['position'] );
		$company_year = trim( $_POST['company_year'] );
		$company_month = trim( $_POST['company_month'] );
		$level_code = trim( $_POST['level_code'] );

		if( (!$shenbao_educ) || (!$shenbao_grad_year) || (!$shenbao_grad_month) || (!$shenbao_major) || (!$shenbao_for_major)
			|| (!$company) || (!$position) || (!$company_year) || (!$company_month) || (!$level_code) ) {
			cmpt_form();
		} else {
			try {
				check_computer_form( $shenbao_educ, $shenbao_grad_year, $shenbao_grad_month,
						     $shenbao_major, $shenbao_for_major, $company, $position,
						     $company_year, $company_month, $level_code );
				$db = dbconnect();
				
				$query = "insert into computer_test(id, shenbao_educ, shenbao_grad_date, shenbao_major,
					  shenbao_for_major, company, position, company_date, level_code ) values 
					  ('".$id."', '".$shenbao_educ."', '".$shenbao_grad_year.$shenbao_grad_month."', '".$shenbao_major
					  ."', '".$shenbao_for_major."', '".$company."', '".$position."', '".$company_year.$company_month
					  ."', '".$level_code."' )";

				$result = $db->query($query);
				if( (!$result) || ( $db->affected_rows != 1 ) )
					throw new Exception("暂时无法将您的计算机考试报名信息添加到数据库。请您稍后再试。 ");
				$db->close();
?>
		<p><br/><br/>计算机考试报名信息填写成功！<br/><br/></p>
		<p>请等待后台管理员进行人工审核。审核通过后，在指定时间内现场缴费成功即报名成功。具体要求详见报名须知。<br/><br/></p>
		<ul>
			<br/> <br/> <br/>
			<li><a href='/enroll/computer_test/viewform.php'><span class="a_href">&gt;&gt; 查看报名表</span></a></li>
			<br/> <br/> <br/>
			<li><a href=''><span class="a_href">&gt;&gt; 查看审核结果</span></a></li>
			<br/> <br/> <br/>
		</ul>		
<?php
			} //end of try
			catch (Exception $e) {
				echo "\t\t<p class='RedFont'>".$e->getMessage()."</p><br/><br/><br/>\n";
				cmpt_form();
			} //end of catch
		} // end of else to if !$... || ...
	} // end of if isset _SESSION
?>

		</div> <!-- end of div class contation -->
	</div> <!-- end of div class div900c -->

<?php
	$computer_form->Displayfooter();
?>
