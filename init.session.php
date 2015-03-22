<?php
session_start();
/*
included for: init.role.php
*/

//echo '_init.session.php_';
include_once CORE.'/tools/dxs.SessionCMS.class.php'; 	$_SS = New SessionCMS();
include_once CORE."/tools/dxs.CMSSession.class.php";	$CMSSession = $_CMSSession = new CMSSession();
?>