<?php
//echo '_core.login.php_';

if( !$_CMSSession->get('_cms_logged') && DXS_isAjax() ){
	if( $_CMSSession->get('_cms_ses-exp') ){
		//echo $_CMSLNG['session-expired'];
		$CMS_AJAX_RESPONSE['error'] = true;
		$CMS_AJAX_RESPONSE['message'] = $_CMSLNG['session-expired'];
	}else{
		//echo $_CMSLNG['not-logged'];
		$CMS_AJAX_RESPONSE['error'] = true;
		$CMS_AJAX_RESPONSE['message'] = $_CMSLNG['not-logged'];
	}	
}

if( $_CMSSession->get('_cms_ses-exp') ){
	$_CMSSession->forget('_cms_login-error');
	$_CMSSession->forget('_cms_login-error-msg');
	$_CMSSession->set('_cms_ses-exp',false);
	$CMS_AJAX_RESPONSE['error'] = false;
	$CMS_AJAX_RESPONSE['message'] = '';
}

$_CMSSession->set('_cms_login-error',false);

if( ($_CMSSession->has('_cms_logged') && $_CMSSession->get('_cms_logged')) || $_CMSSession->get('_cms_ses-exp-bg') ){
	if( $_CMSSession->has('_cms_tlog')) if( time() - $_CMSSession->get('_cms_tlog') > $_CMSSET['timemax-log'] ){
		$_CMSSession->set('_cms_logged',false);
		$_CMSSession->set('_cms_login-error',true);
		$_CMSSession->set('_cms_login-error-msg',$_CMSLNG['session-expired']);
		$_CMSSession->set('_cms_ses-exp',true);
		$_CMSSession->set('_cms_ses-exp-bg',false);
	}
}

include LOGIN.'/'.$_CMSSET['login-eval'];

if( isset($_REQUEST['login']) && !$_CMSSession->get('_cms_logged') ){
	if( validaLogin() ){	
		$_CMSSession->set('_cms_logged',true);
		$_CMSSession->set('_cms_tlog',time());		
		$_CMSSession->forget('_cms_login-attempts');
		$_CMSSession->forget('_cms_login-error');
		$_CMSSession->forget('_cms_login-error-msg');
		$_CMSSession->forget('_cms_login-error-type');
		
		if($_CMSSession->has('_cms_login-redirect')){
			$redirect = $_CMSSession->get('_cms_login-redirect',true);			
		}else{
			$redirect = $_CMSURL->to();
		}
		$CMS_AJAX_RESPONSE['error']	= false;
		$CMS_AJAX_RESPONSE['message']	= html_entity_decode( $_CMSLNG["success-logged"] );
		$CMS_AJAX_RESPONSE['redirect']	= $redirect;
		if( !DXS_isAjax() ){
			header('Location: '.$redirect);
		}else{
			$CMS_AJAX_RESPONSE['redirect'] = $_CMSURL->Current()->removeQuery('ajax').'';
			echo json_encode($CMS_AJAX_RESPONSE);exit;
		}
	}else{
		$_CMSSession->up('_cms_login-attempts');
		$CMS_AJAX_RESPONSE['error']	= true;
		$CMS_AJAX_RESPONSE['type']	= $_CMSSession->get('_cms_login-error-type');		
		$CMS_AJAX_RESPONSE['message']	= html_entity_decode( $_CMSSession->get('_cms_login-error-msg') );
		$CMS_AJAX_RESPONSE['redirect']	= $_CMSSession->get('_cms_login-redirect');
	}
}

if( $_CMSSession->is_empty('_cms_login-attempts') && !$_CMSSession->get('_cms_logged') ){
	$_CMSSession->set('_cms_login-attempts',0);
}

if( !$_CMSSession->get('_cms_logged') ){
	$_CMSSession->set( '_cms_login-redirect' , $_CMSURL->Current().'' );	
	include CORE.'/load.login.php';
	exit();
}else{
	$_CMSSession->set('_cms_tlog',time());
	$_CMSSession->set('_cms_ses-exp',false);
}

?>