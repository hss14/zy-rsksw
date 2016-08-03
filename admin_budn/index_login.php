<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
	session_start();
	$enroll = new PageZyrsksw();

	$enroll->DisplayHead();
	$enroll->DisplayMenu( $enroll->buttons );
?>

	<div class="div900c">
		<div class="contation" >

<?php
	$id1 = trim( $_POST['id1'] );
	$id2 = trim( $_POST['id2'] );
	$name1 = trim( $_POST['name1'] );
	$name2 = trim( $_POST['name2'] );

	if( !isset($_SESSION['valid_user']) ) {
		if( (!$name1) || (!$id1) || (!$name2) || (!$id2) )
		{
			echo "\t\t<h3>请先登录！</h3>\n";
			login_form();
		} else {
			try {
				if( ($id1 != $id2) || ($name1 != $name2) ) {
					throw new Exception("您两次输入的信息不一致！请重新输入！");
				} else if( !checkid($id1) || !checkname($name1) ) {
					throw new Exception("您输入的身份证号码或者姓名信息无效！请重新输入！");
				} else {
					$register_result = register( $id1, $name1 );
					if( $register_result == 1 ) { // register succeed
						$_SESSION['valid_user'] = $id1;					
					}
					else if( $register_result == 2) { //login succeed
						$_SESSION['valid_user'] = $id1;					
					}
				}	
			} //end of try
			catch(Exception $e) {
				echo "\t\t<h3>登陆失败！请重新登陆！</h3>\n";
				echo "\t\t<br/><br/><p class='RedFont'>".$e->getMessage()."</p>\n";
				login_form();
			} //end of catch
		} // end of else
	} 
	
	if( isset($_SESSION['valid_user']) ) {

		echo "\t\t<h3>报名入口</h3>\n";
		echo "<br/><br/><br/><p>欢迎您！用户 ".$_SESSION['valid_user']." ！</p>\n";

?>
		<p class="RedFont"><br/><br/>使用完毕后（尤其在公用电脑上登陆时）请务必<a href='/enroll/logout.php'><span class="a_href">登出账户</span></a>！以防个人信息被他人篡改！<br/></br></p>

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
	}
?>
		</div> <!-- end of div class contation -->
	</div> <!-- end of div class div900c -->

<?php
	$enroll->Displayfooter();
?>
