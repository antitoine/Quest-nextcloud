<?php
/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\Quest\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
	'routes' => [
		['name' => 'quest_api_v1#preflighted_cors', 'url' => '/api/0.1/{path}', 'verb' => 'OPTIONS', 'requirements' => ['path' => '.+']],
		['name' => 'quest_api_v1#search', 'url' => '/api/0.1/search'],
		['name' => 'quest_api_v1#check', 'url' => '/api/0.1/check']
	]
];
