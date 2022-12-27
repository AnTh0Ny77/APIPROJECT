<?php

namespace Src\Services;

class Router {
	private $routes = [];
	private $basePath;
  
	public function __construct(string $basePath = '') {
	  $this->basePath = $basePath;
	}
  
	public function addRoute(string $method, string $pattern, callable $handler) {
	  $this->routes[] = [$method, $pattern, $handler];
	}
  
	public function handleRequest() {
	  $method = $_SERVER['REQUEST_METHOD'];
	  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	  $path = substr($path, strlen($this->basePath));
  
	  foreach ($this->routes as $route) {
		list($routeMethod, $routePattern, $routeHandler) = $route;
  
		if ($method !== $routeMethod) {
		  continue;
		}
  
		$matches = [];
		if (preg_match('#^'.$routePattern.'$#', $path, $matches)) {
		  return call_user_func_array($routeHandler, array_slice($matches, 1));
		}
	  }
  
	  http_response_code(404);
	  return '404 Not Found';
	}
  }
  
  
  