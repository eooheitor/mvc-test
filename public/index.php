<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$request = $_SERVER['REQUEST_METHOD'];

try {
  if (!isset($router[$request])) {
    throw new Exception("A rota não existe");
  }
  $matched = false;
  foreach ($router[$request] as $route => $controller) {
    $pattern = preg_replace('/{[a-zA-Z_][a-zA-Z0-9_]*}/', '(\d+)', $route);
    if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
      array_shift($matches);
      $controller(...$matches);
      $matched = true;
      break;
    }
  }
  if (!$matched) {
    throw new Exception("A rota não existe");
  }
} catch (Exception $e) {
  echo "Erro: " . $e->getMessage();
}
