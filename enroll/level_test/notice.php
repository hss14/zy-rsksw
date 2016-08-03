<?php

require_once($_SERVER['DOCUMENT_ROOT']."/include/notice.inc.php");

session_start();
$_SESSION['exam'] = 'level';

$notice = new PageNotice();
$notice->nextpage = "/enroll/index.php";
$notice->DisplayA();
?>


<?php
$notice->DisplayB();
?>
