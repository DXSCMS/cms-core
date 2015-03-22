<?php	

class CMSPermissions{
	protected $MOD_PERMS;
	
	function __construct(){		
	}
	function loadModulePermissions(){ global $_SET; // echo MODULESROL;
		if( @is_file( MODULESROL.'/'.$_SET['module'].'/data/permissions.cms.php' ) ){
			include MODULESROL.'/'.$_SET['module'].'/data/permissions.cms.php'; // print_r($MOD_PERMS);
			if($MOD_PERMS){
				$this->MOD_PERMS = $MOD_PERMS;
				return true;
			}
		}
		return false;
	}
	function hasToPage($p = false){ global $_SET;
		$_page = $_SET['mod-page']; 
		if($p){ $_page = $p; }
		$_PERMS = $this->MOD_PERMS; 
		
		if( $_PERMS['type'] == 'A' ){ // Authorized Default
			if( isset($_PERMS['page'][$_page]) ){
				if($_PERMS['page'][$_page] == 'R') return false;
			}
			return true;
		}
		if( $_PERMS['type'] == 'R' ){ // Restricted Default
			if( isset($_PERMS['page'][$_page]) ){
				if($_PERMS['page'][$_page] == 'A') return true;
			}
			return false;		
		}
		if( $_PERMS['type'] == 'E' ){ // Explicit
			if( isset($_PERMS['page'][$_page]) ){
				if($_PERMS['page'][$_page] == 'A') return true;
				if($_PERMS['page'][$_page] == 'R') return false;
			}else{
				return false;
			}
		}
		return false;
	}
}
?>