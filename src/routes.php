<?php

use src\Helpers;

/**
 * Função responsável por encontrar os caminhos para a view
 * @author Heitor
 * @since 03/10/2024
 */

function load($controller, $method, $params = [])
{
  $controllerNamespace = "app\\Controller\\{$controller}";
  if (class_exists($controllerNamespace)) {
    $controllerInstance = new $controllerNamespace();
    if (method_exists($controllerInstance, $method)) {
      $controllerInstance->$method(...$params);
    } else {
      echo "Método não encontrado";
    }
  } else {
    echo "Controller não encontrado";
  }
}

$router = [
  'GET' => [
    '/' => fn() => load('PessoaController', 'index'),
    '/' => fn() => load('PessoaController', 'index', [$_GET['search'] ?? null]),
    '/pessoa' => fn() => load('PessoaController', 'create'),
    '/pessoa/search' => fn() => load('PessoaController', 'search'),
    '/pessoa/delete/{id}' => fn($id) => load('PessoaController', 'delete', [$id]),
    '/pessoa/edit/{id}' => fn($id) => load('PessoaController', 'edit', [$id]),
    '/pessoa/{id}/contato' => fn($id) => load('ContatoController', 'index', [$id]),
    '/pessoa/{id}/contato/create' => fn($id) => load('ContatoController', 'create', [$id]),
    '/contato/delete/{id}' => fn($id) => load('ContatoController', 'delete', [$id]),
    '/contato/edit/{id}' => fn($id) => load('ContatoController', 'edit', [$id]),
  ],
  'POST' => [
    '/' => fn() => load('PessoaController', 'create'),
    '/pessoa/store' => fn() => load('PessoaController', 'store'),
    '/pessoa/update/{id}' => fn($id) => load('PessoaController', 'update', [$id, $_POST]),
    '/pessoa/{id}/contato/store' => fn($id) => load('ContatoController', 'store', [$id, $_POST]),
    '/contato/update/{id}' => fn($id) => load('ContatoController', 'update', [$id, $_POST]),
  ]
];
