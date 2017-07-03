<?php

return [

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => '\\OAuth\\Common\\Storage\\Session',

	/**
	 * Consumers
	 */
	'consumers' => [

		'Twitter' => [
    'client_id'     => '3wIXPcwsUSJDWDIBPktJtLI3R',
    'client_secret' => 'yx0RVfbE89pQXq8FfLtmuyXhcaovylzGDICYA2Ef8fZv64ICoh',
    // No scope - oauth1 doesn't need scope
],

	]

];
