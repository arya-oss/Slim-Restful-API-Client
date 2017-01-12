<?php
session_start();
require __DIR__.'/../vendor/autoload.php';

$app = new Slim\App([
  'settings' => [
    'displayErrorDetails' => true,
    'db' => [
        // Eloquent configuration
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'test',
        'username'  => 'root',
        'password'  => 'root',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ],
  ]
]);

$container = $app->getContainer();

$capsule = new Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($container) use ($capsule) {
	return $capsule;
};

date_default_timezone_set('UTC');

$container['UserController'] = function($container) {
	return new App\Controllers\UserController();
};

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig(__DIR__.'/../resources/views', [
        'cache' => false,
    ]);
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
    return $view;
};

require __DIR__.'/../app/routes.php';

?>
