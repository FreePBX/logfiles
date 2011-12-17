<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }

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
		echo load_view(dirname(__FILE__) . '/views/showlogs.php', $var);

		break;
	default:
		echo load_view(dirname(__FILE__) . '/views/index.php', $var);
    	break;
}
?>
