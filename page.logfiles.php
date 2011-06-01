<?php

$getvars = array(
	'display' 	=> '',
	'type'		=> 'tool',
	'action'	=> '',
	'lines'		=> ''
);

foreach ($getvars as $gvar => $default) {
	$var[$gvar]	= isset($_REQUEST[$gvar]) ? $_REQUEST[$gvar] : $default;
}
$var['lines'] = preg_replace("/[^0-9]/", "",$var['lines']);

if(!$var['lines']){
	$action='';
}//promts for lines if its not set
switch($action) {
	case 'showlog':
		$var['log_path'] = $amp_conf['ASTLOGDIR'] . '/full';
		
		//buffer output so that we can compresses it, fall back to regular buffering (with no benifits) if gzip isnt supported
		//ob_start();
		//ob_start("ob_gzhandler") || ob_start();
		echo load_view(dirname(__FILE__) . '/views/showlogs.php', $var);
		/*$msg = ob_get_contents();
		ob_end_flush();
		header('Content-Length: ' . ob_get_length());
		ob_end_flush();
		//echo $msg;
		*/
		break;
	default:
		echo load_view(dirname(__FILE__) . '/views/index.php', $var);
    	break;
}
?>