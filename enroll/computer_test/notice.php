<?php

require_once($_SERVER['DOCUMENT_ROOT']."/include/notice.inc.php");
$computer_notice = new PageNotice();
$computer_notice->nextpage = "/enroll/computer_test/computerform.php";
$computer_notice->DisplayA();
?>


<?php
$computer_notice->DisplayB();
?>
