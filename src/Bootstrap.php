<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
  paths: [__DIR__ . '/../app/Model'],
  isDevMode: true,
);

// configuring the database connection
$connection = DriverManager::getConnection([
  'dbname'   => $_ENV['DB_NAME'],
  'user'     => $_ENV['DB_USER'],
  'password' => $_ENV['DB_PASS'],
  'host'     => $_ENV['DB_HOST'],
  'driver'   => $_ENV['DB_CONNECTION_TYPE'],
], $config);

// obtaining the entity manager
return $entityManager = new EntityManager($connection, $config);
