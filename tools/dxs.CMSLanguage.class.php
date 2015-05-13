<?php

class CMSLanguage{
	protected $_CMS;
	protected $_CMSLNG;
	protected $_CMSSET;
	protected $idLang;
	protected $languages;
	
	public $MOD_LANG;
	public $CMS_LANG;
	protected $current;
	
	function __construct(){ 		
		global $_CMS,$_CMSINF;//print_r($_CMS);
		include $_CMS['settings']['role-sett']; //print_r($_CMS);
		$_CMSSET = $_CMS['settings'];
		$this->idLang = $_CMSSET["lang"];
		include LANGS."/".$_CMSSET["lang"].".cms.php"; /* Main */
		include LANGS."/".$_CMSSET["lang"].".php"; /* User Words*/
		$this->_CMSLNG = $_CMSLNG;	
		
		$this->MOD_LANG = array();
		$this->CMS_LANG = array();
		$this->current = false;		
	}
	protected function init(){
		
	}
	public function addMOD($key,$val,$over = true){
		if(!isset($this->MOD_LANG[$key])){
			$this->MOD_LANG[$key] = $val;
		}else{
			if($over){ $this->MOD_LANG[$key] = $val; }
		}
	}
	public function loadMOD($arr,$over = true){
		foreach($arr as $key => $val){ $this->addMOD($key,$val,$over); }
	}
	public function addCMS($key,$val,$over = true){
		if(!isset($this->CMS_LANG[$key])){
			$this->CMS_LANG[$key] = $val;
		}else{
			if($over){ $this->CMS_LANG[$key] = $val; }
		}
	}
	public function loadCMS($arr,$over = true){
		foreach($arr as $key => $val){ $this->addCMS($key,$val,$over); }
	}
	public function CMS(){
		$this->current = &$this->CMS_LANG;
		return $this;
	}
	public function Module(){
		$this->current = &$this->MOD_LANG;
		return $this;
	}
	public function group($key){
		if($this->current){
			if(isset($this->current[$key])){
				$this->current = $this->current[$key];
			}else{				
				$this->current = array();
			}
		}else{
			$this->current = array();
			if(isset($this->MOD_LANG[$key])) $this->current = $this->MOD_LANG[$key];
			if(isset($this->CMS_LANG[$key])) $this->current = $this->CMS_LANG[$key];			
		}
		return $this;
	}
	public function word($key,$keep = false){
		if(!$this->current){
			if(isset($this->MOD_LANG[$key])) return $this->MOD_LANG[$key];
			if(isset($this->CMS_LANG[$key])) return $this->CMS_LANG[$key];
		}else{
			if(isset($this->current[$key])){ $word = $this->current[$key]; if(!$keep){$this->current=false;} return $word;}
		}
		if(!$keep){$this->current=false;}
		return '{'.$key.'}';
	}
	public function wordU($key,$keep = false){ return strtoupper($this->word($key,$keep)); }
	public function	has($key){
		if(isset($this->MOD_LANG[$key])) return true;
		if(isset($this->CMS_LANG[$key])) return true;
		return false;
	}
}

?>