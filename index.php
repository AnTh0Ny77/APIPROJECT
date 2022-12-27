<?php
require "vendor/autoload.php";
use Src\Services\Router;
use Src\Controllers\DocController;
header("Access-Control-Allow-Origin: *");

$router = new Router('/APIPROJECT');

$router->addRoute("GET", "/", [new DocController(), 'index']);
// $router->addRoute("GET", "/users/([0-9]+)", "UserController@show");
// $router->addRoute("POST", "/users", "UserController@create");
$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
echo $router->handleRequest();

