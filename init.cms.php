<?php
//echo '_init.cms.php_';

/* CMS Settings & Info*/
include_once CORE."/load.cms-settings.php";
include_once CORE."/info.cms.php";

/* CMS TOOLS */
include_once CORE."/init.cms-tools.php";

/*** Load Role ***/
include_once CORE."/init.role.php";
include_once CORE."/load.module.php";

/*** Permissions ***/
include_once CORE."/load.cms-permissions.php";

/*** Load PreHeaders ***/
include_once CORE."/load.preheaders.php";

/*** Load Skin ***/ 
include_once CORE."/load.skin.php";

?>