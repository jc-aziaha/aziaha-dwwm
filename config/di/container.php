<?php

use DI\ContainerBuilder;

    $builder = new ContainerBuilder();
    $builder->addDefinitions(__DIR__ . "/dependencies.php");
    $container = $builder->build();

    return $container;