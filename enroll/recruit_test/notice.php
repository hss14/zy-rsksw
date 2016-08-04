<?php

require_once($_SERVER['DOCUMENT_ROOT']."/include/page_extends.inc.php");

session_start();
$_SESSION['exam'] = 'recruit';

$notice = new PageNotice();
$notice->nextpage = "/enroll/index.php";
$notice->DisplayA();
?>


<?php
$notice->DisplayB();
?>
