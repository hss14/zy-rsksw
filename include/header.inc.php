<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/include/template.inc.php');
// require_once($_SERVER['DOCUMENT_ROOT'].'/include/bulletin.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/notice.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/database_funcs.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/user_funcs.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/check_user_input.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/print_form.inc.php');

$MONTH = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );

$CPTR_SUBJECTS = array( 'WINDOWS XP', 'EXCEL 2003', 'WORD2003', 'INTERNET应用(XP版)' );

?>
