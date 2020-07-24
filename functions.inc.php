<?php

if (! class_exists('\FreePBX\modules\Logfiles\logfiles_conf')) {
    include_once (dirname(__FILE__) . '/Logfiles_conf.class.php');
}
if (! class_exists('logfiles_conf')) {
    // We create the alias since "/libraries/BMO/FileHooks.class.php::processOldHooks"
    // cannot find the class if it has a namespace defined.
    class_alias('\FreePBX\modules\Logfiles\logfiles_conf', 'logfiles_conf');
}

/**
 * Generate astierks configs
 * 
 * Generates dialplan for callback
 * We call this with retrieve_conf
 * 
 * https://wiki.freepbx.org/pages/viewpage.action?pageId=98701336
 */
function logfiles_get_config($engine)
{
    $lf = \FreePBX::Logfiles();
    $lf->dialplanHooks_get_configOld($engine);
}