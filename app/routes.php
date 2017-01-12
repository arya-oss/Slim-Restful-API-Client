<?php

$app->get('/', function($request, $response) {
  $this->view->render($response, 'index.html', ['msg'=>'Hello Slim', 'name'=> "Rajmani Arya"]);
  // return 'Home';
})->setName('home');

$app->get('/users', 'UserController:getAll');
$app->get('/users/{id}', 'UserController:get');
$app->post('/users', 'UserController:insert');
$app->put('/users/{id}', 'UserController:update');
$app->delete('/users/{id}', 'UserController:delete');
