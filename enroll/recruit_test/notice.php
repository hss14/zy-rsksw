<?php

require_once($_SERVER['DOCUMENT_ROOT']."/include/notice.inc.php");
$recruit_notice = new PageNotice();
$recruit_notice->nextpage = "/enroll/recruit_test/recruitform.php";
$recruit_notice->DisplayA();
?>


<?php
$recruit_notice->DisplayB();
?>
