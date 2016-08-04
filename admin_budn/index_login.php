<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
	session_start();
	$adminlogin = new PageZyrsksw();

	$adminlogin->DisplayHead();
	$adminlogin->DisplayMenu( $adminlogin->buttons );
?>

	<div class="div900c">
		<div class="contation" >

<?php
	$login_name = trim( $_POST['login_name'] );
	$nickname = trim( $_POST['nickname'] );
	$passwd = trim( $_POST['passwd'] );

	if( !isset($_SESSION['admin_name']) ) {
		if( (!$login_name) || (!$nickname) || (!$passwd)  )
		{
			echo "\t\t<h3>请先登录！</h3>\n";
			admin_login_form();
		} else {
			try {
				$db = dbconnect();
				$result = $db->query("select * from admin where login_name='".$login_name."' and nickname='".$nickname."' and passwd=sha1('".$passwd."')" );
				if( !$result )
					throw new Exception("连接管理员信息数据库时出现了一些问题。请您稍后再试。");
				if( $result->num_rows == 1) {
					$_SESSION['admin_name'] = $login_name;				
				} else {
					throw new Exception('您的验证信息不正确！');
				}
				$result->free();
				$db->close();

			} //end of try
			catch(Exception $e) {
				echo "\t\t<h3>登陆失败！请重新登陆！</h3>\n";
				echo "\t\t<br/><br/><p class='RedFont'>".$e->getMessage()."</p>\n";
				admin_login_form();
			} //end of catch
		} // end of else
	} 
	
	if( isset($_SESSION['admin_name']) ) {

		echo "\t\t<h3>系统后台首页</h3>\n";
		echo "<br/><br/><p>欢迎您！管理员 ".$_SESSION['admin_name']." ！</p>\n";

?>
		<p class="RedFont"><br/><br/>使用完毕后（尤其在公用电脑上登陆时）请务必<a href='/admin_budn/logout.php'><span class="a_href">登出账户</span></a>！以防他人使用管理员账户篡改后台数据！<br/></br></p>

		<ul>
			<br/> <br/> <br/>
			<li><a href='/admin_budn/checkform/index.php'><span class="a_href">&gt;&gt; 在线审核考生报名信息入口</span></a></li>
			<br/> <br/> <br/>
			<li><a href='/admin_budn/money_tick.php'><span class="a_href">&gt;&gt; 现场缴费等审核入口</span></a></li>
			<br/> <br/> <br/>
		</ul>		

<?php	
	}
?>
		</div> <!-- end of div class contation -->
	</div> <!-- end of div class div900c -->

<?php
	$adminlogin->Displayfooter();
?>
