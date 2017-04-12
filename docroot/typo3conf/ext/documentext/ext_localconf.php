<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\HDNET\Autoloader\Loader::extLocalconf(
    'ReneRoboter',
    'documentext',
    \ReneRoboter\Documentext\Utility\RegisterUtility::getAutoloaderLoader()
);

