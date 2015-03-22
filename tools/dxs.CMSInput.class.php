<?php
//echo '_tool/dxs.CMSInput.class.php_';

class CMSInput{
	
	function get($var = null,$val = null){
		if(is_null($var)) return $_GET;
		$get = isset($_GET[$var])?$_GET[$var]:null;
		if(!is_null($get)){ $_GET[$var] = $val; }
		return $get;
	}
	function post($var = null,$val = null){
		if(is_null($var)) return $_POST;
		$get = isset($_POST[$var])?$_POST[$var]:null;
		if(!is_null($get)){ $_POST[$var] = $val; }
		return $get;
	}
	function request($var = null){
		if(is_null($var)) return $_REQUEST;
		if( isset($_REQUEST[$var]) ) return $_REQUEST[$var];
		return null;
	}
	function any($var = null){ return $this->request($var); }	
	function has($var,$method = 'REQUEST'){
		$arr = $_REQUEST;
		if($method=='POST'){ $arr = $_POST;}
		if($method=='GET'){ $arr = $_GET; }
		return isset($arr[$var]);
	}
}
?>