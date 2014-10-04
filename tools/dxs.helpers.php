<?php
function DXS_isAjax(){if( @$_REQUEST['mode'] == 'ajax' || isset($_REQUEST['ajax']) ){return true;}return false;}
function DXS_isFalse($var){if( is_bool($var) && $var == false){return true;}return false;}
function DXS_isTrue($var){if( is_bool($var) && $var == true){return true;}return false;}

if ( ! function_exists('is_true')){
	function is_true($var){if( is_bool($var) && $var == true){return true;}return false;}
}
if ( ! function_exists('is_false')){
	function is_false($var){if( is_bool($var) && $var == false){return true;}return false;}
}
?>