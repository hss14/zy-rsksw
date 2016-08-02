<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
	session_start();
	$personal = new PageZyrsksw();

	$personal->DisplayHead();
	//$personal->DisplayMenu( $personal->buttons );
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
		$gender = trim( $_POST['gender'] );
		$people = trim( $_POST['people'] );
		$politics = trim( $_POST['politics'] );
		$marriage = trim( $_POST['marriage'] );
		$cellphone = trim( $_POST['cellphone'] );
		$email = trim( $_POST['email'] );

		if( (!$gender) || (!$people) || (!$politics) || (!$marriage) || (!$cellphone)  ) {
			personal_form("/enroll/personal.php");
		} else {
			try {
				checkpersonal($gender, $people, $politics, $marriage, $cellphone, $email);
				$db = dbconnect();
				
				$query = "update personal set gender='".$gender."', people='".$people."', politics='"
					 .$politics."', marriage='".$marriage."',cellphone='".  $cellphone."' ";
				if($email)
					$query .= ", email='".$email."' ";
				$query .= "where id='".$id."'";

				$result = $db->query($query);
				if( (!$result) || ( $db->affected_rows != 1 ) ) {
					echo $db->affected_rows;
					throw new Exception("暂时无法将您的个人信息添加到数据库。请您稍后再试。 ");
				}
				$db->close();
?>
		<p><br/><br/>个人信息填写成功！<br/><br/></p>
		<p>下面您可以开始报名相应考试了：<br/><br/></p>
		<ul>
			<br/> <br/> <br/>
			<li><a href='/enroll/computer_test/notice.php'><span class="a_href">&gt;&gt; 专业技术人员计算机应用能力考试报名入口</span></a></li>
			<br/> <br/> <br/>
			<li><a href='/enroll/recruit_test/notice.php'><span class="a_href">&gt;&gt; 招聘考试入口</span></a></li>
			<br/> <br/> <br/>
			<li><a href='/enroll/level_test/notice.php'><span class="a_href">&gt;&gt; 水平能力测试入口</span></a></li>
			<br/> <br/> <br/>
		</ul>		
<?php
			} //end of try
			catch (Exception $e) {
				echo "\t\t<p class='RedFont'>".$e->getMessage()."</p><br/><br/><br/>\n";
				personal_form("/enroll/personal.php");
			} //end of catch
		} // end of else to if !$gender || ...
	} // end of if isset _SESSION
?>

		</div> <!-- end of div class contation -->
	</div> <!-- end of div class div900c -->

<?php
	$personal->Displayfooter();
?>
