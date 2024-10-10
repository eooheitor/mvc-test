<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . "/../core/config.php";
require_once __DIR__ . "/../vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
  paths: [__DIR__ . '/../app/Model'],
  isDevMode: true,
);

// configuring the database connection
$connection = DriverManager::getConnection([
  'dbname'   => DB_NAME,
  'user'     => DB_USER,
  'password' => DB_PASS,
  'host'     => DB_HOST,
  'driver'   => DB_CONNECTION_TYPE,
], $config);

// obtaining the entity manager
return $entityManager = new EntityManager($connection, $config);
