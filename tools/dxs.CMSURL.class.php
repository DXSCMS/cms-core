<?php
//echo "_tool.CMSURL.class.php_";

class CMSURL{
	protected $_use_root;
	protected $_root;
	protected $_ext;
	
	protected $_setModule;
	protected $_module = null;
	protected $_moduleCMS; // Current
	
	protected $_setPage;
	protected $_page = null;
	protected $_pageCMS; // Current
	
	protected $_setQuery;
	protected $_query = null; 
	
	protected $_moduleHandler;
	protected $_pageHandler;
	
	protected $_get;
	protected $_getCMS;

	protected $_qry = null;// Array()
		
	function __construct(){$this->init();}
	public function __toString(){return $this->makeURL();}	
	public function str(){return $this->makeURL();}
	
	private function init(){	
		global $_CMSSET; //print_r($_CMSSET);
		global $_SET; //print_r($_SET);
		
		$this->_use_root		= false;
		$this->_root 			= $_CMSSET['root-file'].".".$_CMSSET['page-ext'];
		$this->_moduleHandler 	= $_CMSSET['module-handler'];
		$this->_pageHandler 	= $_CMSSET['page-handler'];
		
		$this->_moduleCMS 	= $_SET['cms-module'];
		$this->_pageCMS		= $_SET['cms-page'];
		
		$this->_setQuery 	= false;
		$this->_query 		= null;
		$this->_query_arr	= Array();
		
		$get = $_GET;$this->_get = $get;
		
		$getCMS = $_GET;
			unset($getCMS[$_CMSSET['module-handler']]);
			unset($getCMS[$_CMSSET['page-handler']]);
		$this->_getCMS = $getCMS;
		if(count($getCMS) > 0){
			foreach($getCMS as $key => $val){
				$this->_query_arr[$key] = $val;
			}
		}
	}
	private function makeURL(){
		$queryStr = Array();
		$url = ''; $url = $this->_root;
		if( $this->_use_root ){ $url = $this->_root; }		
		$_query_arr = $this->_query_arr;		
		if($this->_setModule){ $queryStr[] = $this->_moduleHandler .'='. $this->_module; }
		if($this->_setPage){ $queryStr[] = $this->_pageHandler .'='. $this->_page; }
		//print_r($_qry);
		if( $this->_setQuery ) if( count($_query_arr)>0 ) foreach( $_query_arr as $key => $val ){
			$queryStr[] = ($val!=null) ? ($key.'='.$val) : ($key);
		}
		if(count($queryStr)>0){	$url .= "?".implode('&',$queryStr); }
		return $url;
	}
	public function Root($use = true){
		if($use){ $this->_use_root = true;}
		return $this;
	}
	public function Ajax(){	return $this->addQuery('ajax','true'); }
	public function Module($module = true){ return $this->setModule($module); }
	public function setModule($module = true){		
		if( is_bool($module) ){ // true/false
			$this->_setModule = false;
			if($module && isset($this->_moduleCMS) ){
				$this->_setModule = true;
				$this->_module = $this->_moduleCMS;
			}
		}else
		if( $module === null ){ // true
			if( isset($this->_moduleCMS) ){
				$this->_setModule = true;
				$this->_module = $this->_moduleCMS;
			}			
		}else{ 
			$this->_setModule = true;
			$this->_module = $module;
		}
		return $this;
	}
	public function Page($page = true){ return $this->setPage($page); }
	public function setPage($page = true){
		//if(!$this->_setModule){ $this->_setModule = true;$this->_module = $this->_moduleCMS; }
		if( is_bool($page) ){
			$this->_setPage = false;
			if($page && isset($this->_pageCMS) ){
				$this->_setPage = true;
				$this->_page = $this->_pageCMS;
			}
		}else
		if( $page == null){ 
			if( isset($this->_pageCMS) ){
				$this->_setPage = true;
				$this->_page = $this->_pageCMS;
			}
		}else{
			$this->_setPage = true;
			$this->_page = $page;
		}
		return $this;
	}
	public function MPage($page = true){ return $this->Module()->Page($page); }
	public function noQuery($key = false){ 
		if($key){ return $this->Query()->removeQuery($key); }
		$this->_query_arr = array();
		return $this;
		//return $this->setQuery($key); 
	}
	public function onlyQuery($keys = false){ 
		if($keys){ 
			$keys_arr = explode(',',$keys);
			$only = array();
			foreach($keys_arr as $key){ $only[$key] = $this->_query_arr[$key];	}
			$this->_query_arr = array();
			foreach($only as $key => $val){ $this->addQuery($key,$val);	}
		}
		return $this;		
	}
	public function Query($query = true){ return $this->setQuery($query); }
	public function setQuery($query = true){		
		if( is_bool($query) ){
			if($query){
				$this->_setQuery = true;
				$this->_query_arr = $this->_getCMS;
			}else{
				$this->_setQuery = false;
				//$this->_query_arr = array();
			}
			return $this;
		}
		if( $query == null ){
			$this->_setQuery = true;
			$this->_query_arr = $this->_getCMS;
			return $this;
		}
		if(is_array($query)){
			$this->_setQuery = true;
			foreach($query as $id => $val){
				$this->_query_arr[ $id ] = $val;
			}
			return $this;
		}
		if(is_string($query)){
			$this->_setQuery = true;
			$qrys = explode("&",$query);
			foreach($qrys as $qry){
				$qryVals = explode("=",$qry);
				$this->_query_arr[ $qryVals[0] ] = $qryVals[1];
			}
			return $this;
		}
	}
	public function addQuery($key = false,$value = null){				
		$this->_setQuery = true;
		if(!$key) return $this;
		$this->_query_arr[ $key ] = $value;
		return $this;
	}	
	public function removeQuery($key){		
		unset( $this->_query_arr[ $key ] );
		return $this;
	}
	public function to($module = false,$page = false,$query = false){		
		$this->init();				
		return $this->Module($module)->Page($page)->Query($query);
	}
	public function Current(){
		return $this->to(true,true,true);
	}
	public function Logout(){
		global $_CMSSET;
		return $this->addQuery($_CMSSET["logout-handler"]);		
	}
	
	public function redirect(){
		header("Location: ". $this->makeURL() );
		exit;
	}
	public function getQueryString(){
		foreach($this->_getCMS as $key => $val){
			$query[] = ($val!=null)?("$key=$val"):("$key");
		}
		return implode("&",$query);
	}
	function isAjax(){
		if( @$_REQUEST['mode'] == 'ajax' || isset($_REQUEST['ajax']) ){return true;}
		return false;
	}
}
?>