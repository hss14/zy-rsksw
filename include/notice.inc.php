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

?>

