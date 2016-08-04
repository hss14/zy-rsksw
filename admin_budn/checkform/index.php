<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
	session_start();
	$page = new PageAdmin();

	$page->beforetry();

	if( isset($_SESSION['admin_name']) ) {
		try {
?>
		<table id='index_table'>
			<tr>
				<th>表格种类</th>
				<th>当前状态</th>
			</tr>
<?php
			foreach( $EXAMS as $key => $array ) {
				$num = num2check( $array['db_table'] );
				echo "\t\t\t<tr>\n";
				echo "\t\t\t\t<td>".$array['chinese']."报名表</td>\n";
				if( $num ) {
					echo "\t\t\t\t<td><a href='/admin_budn/checkform/".$key.".php'><span class='a_href'>[".$num."个表格待审核]</span></a></td>\n";
				} else {
					echo "\t\t\t\t<td>当前无待审核表格</td>\n";
				}
				echo "\t\t\t</tr>\n";
			}
?>
		</table>

<?php
		}
		catch (Exception $e) {
			echo "\t\t<br/><br/><p class='RedFont'>".$e->getMessage()."<br/>请您稍后再试。</p>\n";
		}
	} //end of if isset $_SESSION

	$page->aftertry();
?>
