<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config');
$dotenv->load();

define('OMISE_PUBLIC_KEY', $_ENV['OMISE_PUBLIC_KEY']);
define('OMISE_SECRET_KEY', $_ENV['OMISE_SECRET_KEY']);
