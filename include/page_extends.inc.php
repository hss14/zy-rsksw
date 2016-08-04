<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
class PageNotice extends PageZyrsksw {

	public $nextpage;

	public function DisplayA() {
		$this->DisplayHead();
?>

	<div class="div900c" >
		<div class="contation" >

		<h3>报名须知</h3>
		
		<p class='RedFont'>请务必仔细阅读每一条要求！</p>
		
		<p>
<?php
	}

	public function DisplayB() {
?>
		</p>

		<div class = "button">
			<a href="/index.php">不同意，返回首页</a>
		</div>

		<div class = "button">
<?php
		echo "\t\t\t<a href='".$this->nextpage."'>&nbsp;我同意，下一步</a>\n";
?>
		</div>

		</div> <!-- end of div class contation -->
	</div> <!-- end of div class div900c -->

<?php
		$this->Displayfooter();
	}
}










class PageAdmin extends PageZyrsksw {

	protected $admin_name;

	function beforetry() {
		$this->DisplayHead();
		echo "\t<div class='div900c'>\n"."\t\t<div class='contation'>\n";

		if( !isset($_SESSION['admin_name']) ) {
			echo "\t\t<h3>您还没有登录！</h3>\n";
			admin_login_form();
		} else {
			$this->admin_name = $_SESSION['admin_name'];
			echo "\t\t<p>管理员 ".$this->admin_name."，欢迎您！</p>";
?>
		<p>如果您不是该管理员，请<a href='/admin_budn/logout.php'>登出账户</a>并用本人账户登录！</p>
		<p><a href='/admin_budn/logout.php'><span class='a_href'>&gt;&gt; 登出账户</span></a><br/></p>
		<p><a href='/index.php'><span class='a_href'>&gt;&gt; 返回首页</span></a><br/></p>
		<p><a href='/admin_budn/index_login.php'><span class='a_href'>&gt;&gt; 返回管理员界面首页</span></a><br/><br/></br></p>
<?php
		}
	}

	function aftertry() {
		echo "\t\t</div>\n"."\t</div>\n";	
		$this->Displayfooter();
	}

}



?>

