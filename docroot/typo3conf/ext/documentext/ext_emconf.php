<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'documentExt',
	'description' => 'My very first own typo3 Extension :)',
	'category' => 'plugin',
	'author' => 'René Backhaus',
	'author_email' => 'rene.backhaus@hdnet.de',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '0.2.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.6.0-7.6.99',
            'autoloader' => '1.0.0-5.5.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);