<?php
# Database settings
$GLOBALS['TYPO3_CONF_VARS']['DB']['database'] = '###DATABASE###';
$GLOBALS['TYPO3_CONF_VARS']['DB']['username'] = '###USERNAME###';
$GLOBALS['TYPO3_CONF_VARS']['DB']['password'] = '###PASSWORD###';
$GLOBALS['TYPO3_CONF_VARS']['DB']['host'] = '###HOST###';
$GLOBALS['TYPO3_CONF_VARS']['DB']['port'] = 3306;
$GLOBALS['TYPO3_CONF_VARS']['DB']['socket'] = '';

# Site settings
$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword'] = '###MD5_INSTALL_TOOL_PASSWORD###';
$GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'] = 30720;
#$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '10.10.10.1,212.100.49.52,92.39.29.14,194.25.28.170,194.25.28.171,194.25.28.172,194.25.28.173,194.25.28.174,87.138.198.64';


$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] = '###SITENAME###';

# GFX settings for vagrant boxes
#$GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path'] = '/usr/bin/';
#$GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path_lzw'] = '/usr/bin/';
#$GLOBALS['TYPO3_CONF_VARS']['GFX']['im_version_5'] = 'im6';



if (PHP_SAPI === 'cli') {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['extbase_object']['backend'] = 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend';
}
