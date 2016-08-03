<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
	session_start();
	$cpt_index = new PageZyrsksw();

	$cpt_index->DisplayHead();
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
<?php
		try {
			print_enroll_index( $id, $_SESSION['exam'] );
		}
		catch (Exception $e) {
			echo "\t\t<br/><br/><p class='RedFont'>".$e->getMessage()."<br/>请您稍后再试。</p>\n";
			echo "\t\t<br/><br/><a href='/enroll/enroll_menu.php'>&gt;&gt;返回报名界面首页</a>";
		}
	} //end of if isset $_SESSION
?>
		</div> <!-- end of div class contation -->
	</div> <!-- end of div class div900c -->

<?php
	$cpt_index->Displayfooter();
?>
