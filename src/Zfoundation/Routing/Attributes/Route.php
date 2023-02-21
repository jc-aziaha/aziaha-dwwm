<?php
namespace App\Zfoundation\Routing\Attributes;

use Attribute;

    #[Attribute(Attribute::TARGET_METHOD)]
    class Route
    {

        /**
         * Cette méthode représente l'url de la route dont le routeur attend la réception
         *
         * @var string
         */
        private string $path;

        /**
         * Cette méthode représente le nom de la route qui sera sollicitée
         *
         * @var string
         */
        private string $name;

        /**
         * Cette méthode représente les méthodes ou verbes HTTP grâce auxquels, on peut accéder la route
         *
         * @var array
         */
        private array $methods = [];


        /**
         * Cette méthode représente les paramètres récupérées de la barre d'url s'il y en a
         *
         * @var array
         */
        private array $parameters = [];


        public function __construct($path, $name, $methods = ["GET"])
        {
            $this->path     = $path;
            $this->name     = $name;
            $this->methods  = $methods;
        }

        public function getPath() : string
        {
            return $this->path;
        }

        public function getName() : string
        {
            return $this->name;
        }

        public function getMethods() : array
        {
            return $this->methods;
        }

        /**
         * Cette méthode vérifie si des paramètres sont passés à la route via l'url
         *
         * @return boolean
         */
        public function hasParameters() : bool
        {
            return preg_match('/{([\w\-%]+)(<(.+)>)?}/', $this->path);
        }

        /**
         * Cette méthode récupère les paramètres de la route
         *
         * @return array
         */
        public function fetchParameters() : array
        {
            if (empty($this->parameters)) 
            {
                preg_match_all('/{([\w\-%]+)(?:<(.+?)>)?}/', $this->getPath(), $params);
                $this->parameters = array_combine($params[1], $params[2]);
            }

            return $this->parameters;
        }
    }