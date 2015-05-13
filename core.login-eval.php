<?php

if( $_CMSSession->has('_cms_logged') && $_CMSSession->get('_cms_logged') ){
	if( time() - $_CMSSession->get('_cms_tlog') > $_CMSSET["timemax-log"] ){
		$_CMSSession->set('_cms_logged',false);
		$_CMSSession->set('_cms_login-error',true);
		$_CMSSession->set('_cms_login-error-msg',$_CMSLNG['session-expired']);
		$_CMSSession->set('_cms_ses-exp',true);
		$_CMSSession->set('_cms_ses-exp-bg',true);
	}
}
?>