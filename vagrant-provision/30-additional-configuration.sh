#!/usr/bin/env php
<?php
echo "Creating AdditionalConfiguration...";
$host = $argv[1];
$root = '/var/www/docroot';

$filecontent = file_get_contents($root . '/typo3conf/_AdditionalConfiguration.php');

if($filecontent){
	$filecontent = str_replace('###SITENAME###', $host, $filecontent);
	$filecontent = str_replace('###MD5_INSTALL_TOOL_PASSWORD###', md5('spitze23'), $filecontent);
	$filecontent = str_replace('###HOST###', 'localhost', $filecontent);
	$filecontent = str_replace('###DATABASE###', 'typo3', $filecontent);
	$filecontent = str_replace('###USERNAME###', 'root', $filecontent);
	$filecontent = str_replace('###PASSWORD###', 'spitze23', $filecontent);

	file_put_contents($root . '/typo3conf/AdditionalConfiguration.php', $filecontent);
	echo "AdditionalConfiguration created successfully.";
}
else {
	echo "Could not create AdditionalConfiguration. Continuing...";
}
