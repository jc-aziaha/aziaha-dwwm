<?php
namespace App\Zfoundation\Routing;

    interface RouterInterface
    {

        /**
         * Cette méthode se charge d'ajouter les routes à l'armoire à routes
         *
         * @param array $routes
         * 
         * @return void
         */
        public function addRoutes(array $controllers) : void;

        
        /**
         * Cette méthode permet d'exécuter le routeur
         *
         * @return array|null
         */
        public function run() : ?array;


        /**
         * Cette méthode permet de générer l'url d'une route en se basant sur son nom
         *
         * @param string $route_name
         * @param array $parameters
         * 
         * @return string
         */
        public function generateUrl(string $route_name, array $parameters = []) : string;

    }