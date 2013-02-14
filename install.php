<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed');}

$sql[] = 'CREATE TABLE IF NOT EXISTS `logfile_settings` (
  `key` varchar(100) NOT NULL default "",
  `value` varchar(255) default NULL,
  PRIMARY KEY  (`key`)
)';

$sql[] = 'CREATE TABLE IF NOT EXISTS `logfile_logfiles` (
  `name` varchar(25) NOT NULL default "",
  `debug` varchar(25) default NULL,
  `dtmf` varchar(25) default NULL,
  `error` varchar(25) default NULL,
  `fax` varchar(25) default NULL,
  `notice` varchar(25) default NULL,
  `verbose` varchar(25) default NULL,
  `warning` varchar(25) default NULL,
  PRIMARY KEY  (`name`)
)';

foreach($sql as $s) {
	sql($s);
}
unset($sql);

//set some defualts
$first_install = $db->getOne('SELECT COUNT(*) FROM logfile_settings');

if (!$first_install) { //zero count (aka false) is a new install
	$sql = 'INSERT INTO logfile_logfiles (name, debug, dtmf, error, fax, notice, verbose, warning)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
	$db->query($sql, array('full', 'on', 'off', 'on', 'off', 'on', 'on', 'on'));
	$db->query($sql, array('console', 'on', 'off', 'on', 'off', 'on', 'on', 'on'));
}
?>