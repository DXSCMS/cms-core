<?php

//echo "_tool.URLCMS.class.php_";

class URLCMS{
	
	var $_root;
	var $_ext;
	
	var $_stModule;
	var $_module = null;
	var $_moduleCMS;
	
	var $_stPage;
	var $_page = null;
	var $_pageCMS;
	
	var $_stQuery;
	var $_query = null; 
	
	var $_moduleHandler;
	var $_pageHandler;
	
	var $_get;
	var $_getCMS;

	var $_qry = null;// Array()
	
	
	function URLCMS(){				
		$this->init();
	}
	
	private function init(){
	
		global $_CMSSET;
		global $_SET;
		
		$this->_root = $_CMSSET['root-file'].".".$_CMSSET['page-ext'];
		$this->_moduleHandler = $_CMSSET['module-handler'];
		$this->_pageHandler = $_CMSSET['page-handler'];
		
		$this->_moduleCMS = $_SET['cms-module'];
		$this->_pageCMS = $_SET['cms-page'];
		$this->_query = null;
		$this->_qry = Array();
		
		$get = $_GET;$this->_get = $get;
		
		$getCMS = $_GET;
			unset($getCMS[$_CMSSET['module-handler']]);
			unset($getCMS[$_CMSSET['page-handler']]);			
		$this->_getCMS = $getCMS;
		if(count($getCMS) > 0){
			foreach($getCMS as $key => $val){
				$this->_qry[$key] = $val;
			}
		}
	}
	
	function stModule($module){
		if( is_bool($module) ){ //echo '_$module_isBool_';
			if($module){
				$this->_stModule = true;
				$this->_module = $this->_moduleCMS;
			}else{
				$this->_stModule = false;
			}
		}else
		if( $module === null ){ //echo '_$module_isNull_';
			$this->_module = $this->_moduleCMS;
			$this->_stModule = true;
		}else{ //echo '_$module_'.$module.'_';
			$this->_stModule = true;
			$this->_module = $module;
		}
	}
	
	function stPage($page){
		if( is_bool($page) ){ //echo '_$page_isBool_';
			if($page){
				$this->_stPage = true;
				$this->_page = $this->_pageCMS;
			}else{
				$this->_stPage = false;
			}
		}else
		if( $page == null){ //echo '_$page_isNull_';
			$this->_stPage = true;
			$this->_page = $this->_pageCMS;
		}else{
			$this->_stPage = true;
			$this->_page = $page;
		}
	}
	
	function stQuery($query){
		if( is_bool($query) ){
			if($query){
				$this->_stQuery = true;
				$this->_qry = $this->_getCMS;
			}else{
				$this->_stQuery = false;
			}
			return true;
		}
		if( $query == null ){
			$this->_stQuery = true;
			$this->_qry = $this->_getCMS;
			return true;
		}
		if(is_array($query)){
			foreach($query as $id => $val){
				$this->_qry[ $id ] = $val;
			}
			return true;
		}
		if(is_string($query)){
			$qrys = explode("&",$query);
			foreach($qrys as $qry){
				$qryVals = explode("=",$qry);
				$this->_qry[ $qryVals[0] ] = $qryVals[1];
			}
			return true;
		}
	}
	
	function addQuery($query,$value = null){
		if(is_null($value)){
			if(is_array($query)){
				foreach($query as $id => $val){
					$this->_qry[ $id ] = $val;
				}
			}else{
				$qrys = explode("&",$query);
				foreach($qrys as $qry){
					$qryVals = explode("=",$qry);
					$this->_qry[ $qryVals[0] ] = $qryVals[1];
				}
			}
		}else{
			$this->_qry[ $query ] = $value;
		}
		$this->_query = true;
		return true;
	}
	
	function nstQuery(){
		$this->query = null;
		$this->_qry = null;
	}

	private function mkURL(){
		$qryStr = Array();
		$url = "?";
		$_qry = $this->_qry;
		
		if($this->_stModule){
			$qryStr[] = $this->_moduleHandler .'='. $this->_module;
		}
		if($this->_stPage){ 
			$qryStr[] = $this->_pageHandler .'='. $this->_page;
		}
		//print_r($_qry);

		if( count($_qry)>0 ) foreach( $_qry as $key => $val ){
			$qryStr[] = $key.'='.$val;
		}
		$url .= implode('&',$qryStr);
		return $url;
	}
	
	function gtQueryString(){
		foreach($this->_getCMS as $key => $val){
			$query[] = "$key=$val";
		}
		return implode("&",$query);

	}
	
	function gtLogout(){
		global $_CMSSET;
		return "?".$_CMSSET["logout-handler"];//."=1";
	}
	
	function gtLinkCurrent(){
		$qryStr = Array();
		$url = "?";
		foreach( $this->_get as $key => $val ){
			$qryStr[] = $key.'='.$val;
		}
		$url .= implode('&',$qryStr);
		return $url;
	}
	function gtLinkCurrentCMS(){
		$url  = $this->_root;
		$url .= $this->gtLinkCurrent();
		return $url;
	}
	
	function gtLink($module = null,$page = null,$query = null){
		
		$this->init();		
			$this->stModule($module);
			$this->stPage($page);
			$this->nstQuery();
			$this->stQuery($query);
		
		return $this->mkURL();
	}
	function gtLinkAjax($module = null,$page = null,$query = null){
		
		$this->init();		
			$this->stModule($module);
			$this->stPage($page);
			$this->nstQuery();
			$this->stQuery($query);
			$this->stQuery("ajax=true");
		
		return $this->mkURL();
	}
	function gtLinkCMS($module = null,$page = null,$query = null){
		$url  = $this->_root;
		$url .= $this->gtLink($module,$page,$query);
		return $url;
	}
	
	function gtLinkAll($module = null,$page = null,$query = null){
		
		$this->init();		
			$this->stModule($module);
			$this->stPage($page);
			$this->stQuery($query);
		
		return $this->mkURL();
	}
	function gtLinkAllAjax($module = null,$page = null,$query = null){
		
		$this->init();		
			$this->stModule($module);
			$this->stPage($page);
			$this->stQuery($query);
			$this->stQuery("ajax=true");
		
		return $this->mkURL();
	}
	function gtLinkAllCMS($module = null,$page = null,$query = null){
		$url  = $this->_root;
		$url .= $this->gtLinkAll($module,$page,$query);
		return $url;
	}
	
	function gtLinkModule(){
		return $this->gtLink(true,false,false);
	}
	
	function gtLinkPage(){
		return $this->gtLink(true,true,false);
	}
	
	function gtLinkQuery(){		
		$this->stModule($module);
		$this->stPage($page);
		return $this->mkURL();
	}
	
	function gtLinkModuleCMS(){
		$url  = $this->_root;
		$url .= $this->gtLinkModule();
		return $url;
	}
	
	function gtLinkPageCMS(){
		$url  = $this->_root;
		$url .= $this->gtLinkPage();
		return $url;
	}
	function gtLinkQueryCMS(){
		//$this->init();
		$url  = $this->_root;
		$url .= $this->gtLinkQuery();
		return $url;
	}
	
}

?>