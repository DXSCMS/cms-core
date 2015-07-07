<?php

include LANGS."/".$_CMSSET["lang"].".cms.php"; /* Main */
include LANGS."/".$_CMSSET["lang"].".php"; /* User Words*/
$_LANG = $_CMSLNG["global"]; //unset($_CMSLNG["global"]);
$CMSLanguage->loadCMS($_CMSLNG);
$CMSLanguage->loadCMS($_LANG,true);
?>