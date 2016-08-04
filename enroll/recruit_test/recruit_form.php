<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/include/header.inc.php");
	session_start();
	$recruit_form = new PageZyrsksw();

	$recruit_form->DisplayHead();
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
		$r_post = array( 'level_code', 
					'first_educ',  'first_grad_year', 'first_grad_month',
					'best_educ',  'best_grad_year', 'best_grad_month',
					'height', 'weight', 'postcode'
					);

		$r_char = array( 'first_school', 'first_major', 'best_school', 'best_major',
					'certificate', 'mandarin', 'english', 'computer', 'resume',
					'hobby', 'addr'
					);
		$family1 = array( 'family1_name', 'family1_relation', 'family1_age', 'family1_company', 'family1_position' );
		$family2 = array( 'family2_name', 'family2_relation', 'family2_age', 'family2_company', 'family2_position' );
		$family3 = array( 'family3_name', 'family3_relation', 'family3_age', 'family3_company', 'family3_position' );


		try {
			foreach( array( 'r_post','r_char' ) as $current_array ) {
				foreach( $$current_array as $current ) {
					$$current = trim( $_POST[$current] );
					if( ! $$current ) {
						throw new Exception("您没有完成报名表！请填满所有必填项再提交！");
					}
				}
			}
			if( trim($_POST['family1_name'])  ) {
				foreach( $family1 as $current ) {
					$$current = trim( $_POST[$current] );
					if( ! $$current ) {
						throw new Exception("您没有填完家庭成员1的信息！");
					}
				}
			}
			if( trim($_POST['family2_name'])  ) {
				foreach( $family2 as $current ) {
					$$current = trim( $_POST[$current] );
					if( ! $$current ) {
						throw new Exception("您没有填完家庭成员2的信息！");
					}
				}
			}
			if( trim($_POST['family3_name'])  ) {
				foreach( $family3 as $current ) {
					$$current = trim( $_POST[$current] );
					if( ! $$current ) {
						throw new Exception("您没有填完家庭成员3的信息！");
					}
				}
			}

			check_recruit_form( );  // to be done

			$db = dbconnect();
			$result = $db->query( "select * from recruit_test where id=".$id );
			if( !$result )
				throw new Exception("从招聘考试数据库获取信息时出现了问题。请您稍后再试。 ");
			if( $result->num_rows ) {
				$query = "update recruit_test
						where id ='".$id."'";   //to be done
			} else {
				$query = "insert into recruit_test(id, , done ) values";   //to be done
			}
				
			$result = $db->query($query);
			if( (!$result) || ( $db->affected_rows != 1 ) )
				throw new Exception("暂时无法将您的招聘考试报名信息添加到数据库。请您稍后再试。 ");
			$db->close();
?>
			<p><br/><br/>报名信息填写成功！<br/><br/></p>
			<p><a href='/enroll/index.php'><span class='a_href'>&gt;&gt;下一步</span></a><br/><br/></p>
<?php
		} //end of try
		catch (Exception $e) {
				echo "\t\t<p class='RedFont'>".$e->getMessage()."</p><br/><br/><br/>\n";
				recruit_form();
		}

	} // end of if isset _SESSION
?>

		</div> <!-- end of div class contation -->
	</div> <!-- end of div class div900c -->

<?php
	$recruit_form->Displayfooter();
?>
