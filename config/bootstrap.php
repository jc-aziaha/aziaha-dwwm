<?php

use Whoops\Run;
use Dotenv\Dotenv;
use Whoops\Handler\PrettyPageHandler;

    // Chargement de l'autoloader de composer
    require __DIR__ . "/../vendor/autoload.php";


    // Chargement des constantes
    require __DIR__ . "/constants/app.php";


    // Chargement de whoops pour avoir des messages d'erreurs plus stylés
    $whoops = new Run;
    $whoops->pushHandler(new PrettyPageHandler);
    $whoops->register();


    // Chargement des variables d'environnement
    $dotenv = Dotenv::createImmutable(ROOT);
    $dotenv->load();


    // Chargement du conteneur de dépendances
    $container = require __DIR__ . "/di/container.php";

