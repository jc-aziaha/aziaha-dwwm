<?php

use App\Kernel;

    require __DIR__ . "/../config/bootstrap.php";

    $kernel = new Kernel($container);

    $response = $kernel->handleRequest();

    return $response->send();