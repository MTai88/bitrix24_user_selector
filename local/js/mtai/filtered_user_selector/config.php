<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

return [
	'css' => 'dist/filtered_user_selector.bundle.css',
	'js' => 'dist/filtered_user_selector.bundle.js',
	'rel' => [
		'main.polyfill.core',
		'ui.entity-selector',
	],
	'skip_core' => true,
];