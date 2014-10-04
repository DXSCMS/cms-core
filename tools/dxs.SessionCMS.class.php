<?php
/*
included for: init.session.php
*/

//echo '_tool.SessionCMS.class.php_';

class SessionCMS{
	
	function SessionCMS(){
	
	}
	function gt($var,$uns = false){
		global $_CMSSET;
		@$ret = $_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][$var];
		if($uns){
			unset($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][$var]);
		}		
		return $ret;
	}
	function gtu($var,$uns = false){
		$ret = $this->gt( $var , $uns);
		
	}
	function st($var,$val){
		global $_CMSSET;
		//if( is_object($val) ){$val = serialize($val);}
		$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][$var] = $val;
	}
	function nst($var){
		global $_CMSSET;
		unset($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][$var]);
	}
	function ist($var){
		global $_CMSSET;
		return isset($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][$var]);
	}
	function mpty($var){
		global $_CMSSET;
		return empty($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][$var]);
	}
	function up($var){
		global $_CMSSET;
		$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][$var]++;
	}
	
	/* Session Vars for Module */
	function gtMd($var,$uns = false){
		global $_CMSSET;
		$ret = $_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][MODULE][$var];
		if($uns){
			unset($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][MODULE][$var]);
		}
		//if( is_object($ret) ){return unserialize($ret);}
		return $ret;
	}
	function stMd($var,$val){
		global $_CMSSET;
		//if( is_object($val) ){$val = serialize($val);}
		$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][MODULE][$var] = $val;
	}
	function nstMd($var){
		global $_CMSSET;
		unset($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][MODULE][$var]);
	}
	function istMd($var){
		global $_CMSSET;
		return isset($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][MODULE][$var]);
	}
	function mptyMd($var){
		global $_CMSSET;
		return empty($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][MODULE][$var]);
	}
	function upMd($var){
		global $_CMSSET;
		$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][MODULE][$var]++;
	}
	
	/* Session vars Global */
	function stG($var,$val){ // setGlobal()
		$_SESSION[$var] = $val;
	}
	function gtG($var,$uns = false){ // getGlobal()
		$ret = $_SESSION[$var];
		if($uns){
			unset($_SESSION[$var]);
		}
		return $ret;
	}
	function nstG($var){ // unsetGlobal()
		unset($_SESSION[$var]);
	}
	function istG($var){ // issetGlobal();
		return isset($_SESSION[$var]);
	}
}

?>