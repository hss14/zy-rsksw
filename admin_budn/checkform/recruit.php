<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
	session_start();
	$_SESSION['table'] = 'recruit';

	$filter = array( 'done', 'checkflag', 'failstr', 'money', 'windowsxp', 'excel2003', 'word2003', 'internet' );
	$tablename = $EXAMS[ $_SESSION['table'] ]['db_table'];
	global $CHINESE, $EXAM_ID;

	$page = new PageAdmin();

	$page->beforetry();

	if( isset($_SESSION['admin_name']) ) {
		try {
			$num = num2check( $tablename );
			if( !$num )
				throw new Exception("该类目中暂时没有待审核表格啦");
			echo "<p>（还有".$num."份表格待审核）</p><br/><br/>";
		
			$query = "select * from ".$tablename." where done=1 and checkflag=0 limit 1";
			$result = dbquery($query, 1);
			$assc = $result->fetch_assoc();

			$_SESSION['id'] = $assc['id'];

			echo "\t\t\t<table id='index_table'>\n";
			foreach ( $assc as $key => $value ) {
				if( in_array($key, $filter) )
					continue;
				echo "\t\t\t\t<tr>\n";
				echo "\t\t\t\t\t<td>".chinese($key)."</td>\n";

				if( $key=='level_code') {
					$query = "select level_position from exams where level_code='".$value."' and exam_id='".$EXAM_ID[$tablename]."'";
					$result = dbquery($query);
					$assc = $result->fetch_assoc();
					$value = $assc['level_position'];
				} else if( $value == NULL ) {
					$value = '[空]';
				}		
				echo "\t\t\t\t\t<td>".$value."</td>\n";
				echo "\t\t\t\t</tr>\n";
			}
			echo "\t\t\t</table><br/><br/><br/>\n";
?>
			<form action='/admin_budn/checkform/submit.php' method='post'>
				<table class='form_table' border='0' cellpadding='15' cellspacing='15'>
					<tr>
						<td><input type='radio' name='checkflag' value='1' /></td>
						<td>通过</td>
					</tr>
					<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
					<tr>
						<td><input type='radio' name='checkflag' value='-1' /></td>
						<td>不通过</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><textarea name='failstr' rows='3' cols='40' maxlength='100'></textarea><br/>
						    <small>审核通过无需填写。<br/>对考生填写错误之处给出简洁的修改说明即可。</small></td>
					</tr>
					<?php echo_submit_button('提交审核结果'); ?>
				</table>
			</form>
<?php
			$result->free();

		}
		catch (Exception $e) {
			echo "\t\t<br/><br/><p class='RedFont'>".$e->getMessage()."</p>\n";
		}
	} //end of if isset $_SESSION

	$page->aftertry();
?>
