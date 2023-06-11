<?php

require_once '../vendor/autoload.php';

use DI\Container;
use App\Application;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new Container();

$servicesCallback = include 'services.php';
$servicesCallback($container);

$application = $container->get(Application::class);
$application->run();
