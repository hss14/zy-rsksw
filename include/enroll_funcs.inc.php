<?php

/**
 * return string for echoing according to status $done, $checkflag, database string $failstr
 */
function print_status( $done, $checkflag, $failstr='') {
	if( !$done ) {
		return "未完成";
	} else if( $checkflag == 0 ) {
		return "已完成， 等待后台审核中";
	} else if ($checkflag == 1) {
		return "已完成，审核已通过";
	} else {
		return "审核未通过，请点击左侧修改按钮，修改后重新提交。未通过原因：".$failstr;
	}
}


/**
 * echo the whole <tr></tr> part of the first two rows to html page 
 */
function print_edit_tr ( $statement, $edit_url, $display_url, $done = 0, $checkflag = 0, $failstr='', $premise = 1  ) {

	echo "\t\t\t<tr>\n"."\t\t\t\t<td>".$statement."</span>&nbsp;&nbsp;";

	if( !$premise ){
		echo "[进入]&nbsp;&nbsp;[查看]</td>\n";
		echo "\t\t\t\t<td>未完成：先完成上一步才可进行此步骤</td>\n"."\t\t\t</tr>\n";
		return;
	}
	if( !$done ) {
		echo "<a href='".$edit_url."'><span class='a_href'>[进入]</span></a>&nbsp;&nbsp;[查看]</td>\n";
	} else if ($checkflag != 1) {
		echo "<a href='".$edit_url."'><span class='a_href'>[修改]</span></a>&nbsp;&nbsp;<a href='".$display_url."'><span class='a_href'>[查看]</span></a></td>\n";
	} else {
		echo "[修改]&nbsp;&nbsp;<a href='".$diaplay_url."'><span class='a_href'>[查看]</span></a></td>\n";
	}

	echo "\t\t\t\t<td>".print_status( $done, $checkflag, $failstr )."</td>\n";
	echo "\t\t\t</tr>\n";

	return;
}



/**
 * echo the main part of enroll index page 
 * search database for flags and status associated with:
 * @id: id of the person
 * @exam: enum: 'computer', 'recruit', 'level'
 */
function print_enroll_index( $id, $exam ) {
	
		global $EXAMS;

		$db = dbconnect();

		$result = $db->query("select done, checkflag, failstr from personal where id='".$_SESSION['valid_user']."'");
		if( (!$result) || ( $result->num_rows != 1 ) )
			throw new Exception("获取您的个人信息失败！请您稍后再试。 ");
		$stat_assc = $result->fetch_assoc();
		$person_done = $stat_assc['done'];
		$person_check = $stat_assc['checkflag'];
		$person_failstr = $stat_assc['failstr'];
		$result->free();

		$result = $db->query("select done, checkflag, failstr, money from ".$EXAMS[$exam]['db_table']." where id='".$_SESSION['valid_user']."'");
		if( !$result )
			throw new Exception("获取您的报名信息失败！请您稍后再试。 ");
		if( $result->num_rows == 0 ) { // have never fill in given exam form
			$form_done = 0;
			$form_check = 0;
			$form_failstr='';
			$money = 0;
		} else {
			$stat_assc = $result->fetch_assoc();
			$form_done = $stat_assc['done'];
			$form_check = $stat_assc['checkflag'];
			$form_failstr = $stat_assc['failstr'];
			$money = $stat_assc['money'];
		}
		$result->free();

		$db->close();

?>
		<br/><br/><h1 align='center'>报名步骤</h1><br/>
		<table id='index_table'>
			<tr>
				<th>操作步骤</th>
				<th>当前状态</th>
			</tr>
<?php
			print_edit_tr( "1、填写个人信息表", "/enroll/personal.php", "/enroll/personal_view.php", $person_done, $person_check, $person_failstr );
			print_edit_tr( "2、填写报名信息表", $EXAMS[$exam]['form'], $EXAMS[$exam]['view'], $form_done, $form_check, $form_failstr, $person_done );

			echo "\t\t\t<tr>\n"."\t\t\t\t<td>3、等待后台审核通过</td>\n"."\t\t\t\t<td>";
			if( ($person_check == -1) || ($form_check == -1) ) {
				echo "审核未通过，请根据前2步后的状态说明，及时进行相应的修改后重新提交";
			} else if ( ($person_check == 1) && ($form_check == 1) ) {
				echo "恭喜您，审核已经通过！";
			} else if ( (!$person_done) || (!$form_done) ) {
				echo "未完成：您尚未完成表格填写";
			} else {
				echo "等待后台审核中。请您稍后查看";
			}
			echo "</td>\n"."\t\t\t</tr>\n";
?>
			<tr>
				<td>4、现场缴费及确认</td>
				<td>
<?php
				if( $money )	
					echo "恭喜您，全部报名步骤已完成！";
				else if( ($person_check == 1) && ($form_check == 1) )	
					echo "请尽快前往现场完成缴费等手续";
				else
					echo "未完成";
?>
				</td>
			</tr>
			<tr>
				<td>5、打印准考证</td>
				<td>
<?php
				if( $money && $form_check && $person_check ) 
					echo "<a href='".$EXAMS[$exam]['printer']."'><span class='a_href'>[点此打印]</span></a>";
				else
					echo "您尚未完成报名步骤";
?>
				</td>
			</tr>
		</table>
<?php
	if( $money && $form_check && $person_check ) 
		echo "<br/><br/><p>准考证打印方法说明：点击上方[点此打印]，<br/>
			在新打开的页面中，单击鼠标右键，选择“打印”即可。</p>";
}


function simple_table_view( $id, $tablename ) {
		global $CHINESE, $EXAM_ID;
		
		$db = dbconnect();
		$query = "select * from ".$tablename." where id='".$id."'";
		$result = $db->query($query);
		if( (!$result) || ( $result->num_rows != 1 ) )
			throw new Exception("获取数据库中相应的表格信息时失败！ ");
		$assc = $result->fetch_assoc();

		echo "\t\t\t<table id='index_table'>\n";
		foreach ( $assc as $key => $value ) {
			if( ($value==NULL) || ($key=='enroll_date') ||($key=='done') ||($key=='checkflag') ||($key=='failstr') ||($key=='money') )
				continue;
			echo "\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t<td>".$CHINESE[$key]."</td>\n";

			if( $key=='level_code') {
				$db = dbconnect();
				$query = "select level_position from exams where level_code='".$value."' and exam_id='".$EXAM_ID[$tablename]."'";
				$result = $db->query($query);
				if( (!$result) || ( $result->num_rows != 1 ) )
					throw new Exception("获取数据库中相应的表格信息时失败！ ");
				$assc = $result->fetch_assoc();
				$value = $assc['level_position'];
			}
			echo "\t\t\t\t\t<td>".$value."</td>\n";
			echo "\t\t\t\t</tr>\n";
		}
		echo "\t\t\t</table>\n";
		$result->free();
		$db->close();
}





?>
