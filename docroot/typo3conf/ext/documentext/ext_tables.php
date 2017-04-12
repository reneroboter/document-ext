<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\HDNET\Autoloader\Loader::extTables(
    'ReneRoboter',
    'documentext',
    \ReneRoboter\DocumentExt\Utility\RegisterUtility::getAutoloaderLoader()
);