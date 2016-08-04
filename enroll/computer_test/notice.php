<?php

require_once($_SERVER['DOCUMENT_ROOT']."/include/page_extends.inc.php");

session_start();
$_SESSION['exam'] = 'computer';

$computer_notice = new PageNotice();
$computer_notice->nextpage = "/enroll/index.php";
$computer_notice->DisplayA();
?>


<?php
$computer_notice->DisplayB();
?>
