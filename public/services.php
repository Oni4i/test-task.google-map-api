<?php

use DI\Container;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

return function (Container $container) {
    //doctrine setup
    $container->set(EntityManagerInterface::class, function () {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . '../config/migrations.yaml'],
            isDevMode: true,
        );

        $connection = DriverManager::getConnection([
            'driver' => 'pdo_mysql',
            'url' => $_ENV['DATABASE_URL'],
        ], $config);

        return new EntityManager($connection, $config);
    });

    $container->set(Request::class, function () {
        return Request::createFromGlobals();
    });

    $container->set(Environment::class, function () {
        $loader = new FilesystemLoader(__DIR__ . '/../src/View');

        return new Environment($loader);
    });
};
