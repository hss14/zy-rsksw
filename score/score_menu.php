<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/include/header.inc.php");
	$score = new PageZyrsksw();

	$score->DisplayHead();
	$score->DisplayMenu( $score->buttons );

	$score->Displayfooter();
?>
