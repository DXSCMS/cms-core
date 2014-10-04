<?php
unset($_SESSION[ $_CMSSET["idcms"] ][ $_CMSSET["subdom"] ][ $_CMSSET["access"] ]);
header("Location: ".$_SET["self"]);
?> 


