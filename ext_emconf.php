<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'AIJKO GeoIP Service',
	'description' => 'This extension provides an API for the Maxminds GeoIP2 databases. The API also works with the free GeoLite2 databases.',
	'category' => 'plugin',
	'author' => 'AIJKO GmbH',
	'author_email' => 'info@aijko.com',
	'author_company' => 'AIJKO GmbH',
	'shy' => 0,
	'version' => '1.0.0',
	'priority' => 'top',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.0-6.2.99',
			'static_info_tables' => '6.0.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);
