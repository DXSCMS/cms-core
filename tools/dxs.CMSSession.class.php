<?php
/*
included for: init.session.php
*/

//echo '_tool/dxs.CMSSession.class.php_';

class CMSSession{
	protected $sess;
	function __construct(){global $_CMSSET;
		$this->sess = &$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]];
	}
	function Module(){ global $_CMSSET;
		if(!isset($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][MODULE])) $_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][MODULE] = array();
		$this->sess = &$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]][MODULE];
		return $this;
	}
	function This($subdom = false){ global $_CMSSET;
		$this->sess = &$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]];
		if($subdom){ $this->sess = &$_SESSION[$_CMSSET["idcms"]][$subdom]; }
		return $this;
	}
	function CMS($idcms = false){ global $_CMSSET;
		$this->sess = &$_SESSION[$_CMSSET["idcms"]];
		if($idcms){ $this->sess = &$_SESSION[$idcms]; }
		return $this;		
	}
	function Root(){ global $_CMSSET;
		$this->sess = &$_SESSION;
		return $this;		
	}
	//
	function all(){
		return $this->sess;
	}	
	function get($var,$uns = false){global $_CMSSET;
		@$ret = isset($this->sess[$var])?$this->sess[$var]:null;
		if($uns){ unset($this->sess[$var]); }		
		return $ret;
	}
	function set($var,$val){ global $_CMSSET;
		//if( is_object($val) ){$val = serialize($val);}
		$this->sess[$var] = $val;
		return $this;
	}
	function forget($var=false){ if($var){ unset($this->sess[$var]);}else{ $this->sess = array(); } return $this; }
	function has($var){	return isset($this->sess[$var]); }
	function is_set($var){ return isset($this->sess[$var]); }
	function is_empty($var){ return empty($this->sess[$var]); }	
	function up($var,$n = 1){ $this->sess[$var] = $this->sess[$var]+$n; }
	function down($var,$n = 1){ $this->sess[$var] = $this->sess[$var]-$n; }
	function pop($var){ return $this->get($var,true); }
	function pull($var){ return $this->get($var,true); }
	function put($var,$val){ return $this->set($var,$val); }
	function flush(){ return $this->forget(); }
}

?>