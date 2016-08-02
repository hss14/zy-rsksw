<?php

require_once($_SERVER['DOCUMENT_ROOT']."/include/notice.inc.php");
$level_test_notice = new PageNotice();
$level_test_notice->nextpage = "/enroll/level_test/level_testform.php";
$level_test_notice->DisplayA();
?>


<?php
$level_test_notice->DisplayB();
?>
