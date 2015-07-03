<?php
/*
included for: init.cms.php
*/

//echo '_load.cms-settings.php_';

require_once SETTINGS."/settings.cms.php";
if(is_file(SETTINGS."/settings.fb.php")) include_once SETTINGS."/settings.fb.php";

$_CMSSET = $_CMS["settings"];
?>
