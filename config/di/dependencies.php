<?php

use Monolog\Level;
use Monolog\Logger;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Monolog\Handler\StreamHandler;
use App\Zfoundation\Routing\Router;
use App\Zfoundation\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;

    return [

        // L'objet contenant toutes les informations de la requête
        Request::class => Request::createFromGlobals(),


        "controllers" => [
            // "App\Controller\WelcomeController"
        ],

        RouterInterface::class => DI\create(Router::class)->constructor(DI\get(Request::class), DI\get('controllers')),

        "logger" => function() {
            // create a log channel
            $logger = new Logger('access');
            $logger->pushHandler(new StreamHandler(ROOT . "/var/dev/dev.log", Level::Debug));

            return $logger;
        },

        "twig" => function () {
            $loader = new FilesystemLoader(ROOT . "/templates");
            $twig = new Environment($loader, [
                'cache' => ROOT . '/var/cache/dev/twig',
                'auto_reload' => true
            ]);
            return $twig;
        }
    ];