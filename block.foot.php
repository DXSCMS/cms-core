<a <?php if(@$_CMSINF['url-cms'] ){ ?>
target="_blank" href="<?php echo $_CMSINF['url-cms'];?>" 
<?php }?>><?php echo $_CMSINF["ncms"];?></a> | 
<a <?php if(@$_CMSINF['url-cms-ver'] ){ ?>
target="_blank" href="<?php echo $_CMSINF['url-cms-ver'];?>" 
<?php }?>><?php echo" v".$_CMSINF["ver"]; ?></a> | <?php echo $_CMSINF["adapt"];?> | 
<a <?php if(@$_SKININFO['url-skin-cms'] ){ ?>
target="_blank" href="<?php echo $_SKININFO['url-skin-cms'];?>" 
<?php }?>><?php echo $_SKININFO["name"]; ?></a> Skin | <?php echo $_CMSSET["lang"]; ?>

