<a class="label label-info" <?php if( @$_CMSINF['url-cms'] ){ ?>
target="_blank" href="<?php echo $_CMSINF['url-cms'];?>" 
<?php }?>><?php echo $_CMSINF["ncms"];?></a></label> | 
<a class="label label-info"  <?php if( @$_CMSINF['url-cms-ver'] ){ ?>
target="_blank" href="<?php echo $_CMSINF['url-cms-ver'];?>" 
<?php }?>><?php echo" v".$_CMSINF["ver"]; ?></a> | <label class="label label-default"><?php echo $_CMSINF["adapt"];?></label> | 
<a class="label label-info" <?php if( @$_SKININFO['url-skin-cms'] ){ ?>
target="_blank" href="<?php echo $_SKININFO['url-skin-cms'];?>" 
<?php }?>><?php echo $_SKININFO["name"]; ?></a> <label class="label label-default">Skin</label> | <label class="label label-default"><?php echo $_CMSSET["lang"]; ?></label>

