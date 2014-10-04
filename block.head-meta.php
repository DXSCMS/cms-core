<?php 
	$favicon = false;
	if(is_file(MEDIASKIN."/favicon.png")){
		$favicon = MEDIASKIN."/favicon.png";
	}else if(is_file(MEDIASKIN."/favicon.gif")){
		$favicon = MEDIASKIN."/favicon.gif";
	}
?>
<?php if($favicon){ ?>
<LINK REL="SHORTCUT ICON" HREF="<?php echo $favicon;?>">
<?php } ?>
<!--<meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1">-->
<meta http-equiv="Content-Type" content="text/html" charset="utf-8"> 
<meta http-equiv="pragma" content="no-cache" />
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />