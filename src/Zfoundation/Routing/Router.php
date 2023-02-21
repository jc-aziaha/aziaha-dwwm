<?php
namespace App\Zfoundation\Routing;

use ReflectionClass;
use App\Zfoundation\Routing\Attributes\Route;
use Symfony\Component\HttpFoundation\Request;

    class Router implements RouterInterface
    {

        protected Request $request;

        protected array $controllers = [];

        protected array $routes = [];
        
        public function __construct(Request $request, array $controllers = [])
        {
            $this->request     = $request;
            $this->controllers = $controllers;
            $this->addRoutes($controllers);
        }

        /**
         * Cette méthode se charge d'ajouter les routes à l'armoire à routes
         *
         * @param array $controllers
         * 
         * @return void
         */
        public function addRoutes(array $controllers = []) : void
        {
            foreach ($controllers as $controller) 
            {
                $reflection_controller = new \ReflectionClass($controller);

                foreach ($reflection_controller->getMethods() as $reflection_method) 
                {
                    $reflection_attributes = $reflection_method->getAttributes(Route::class);
                    
                    foreach ($reflection_attributes as $reflection_attribute) 
                    {
                        $route = $reflection_attribute->newInstance();

                        $this->routes[$route->getName()] = [
                            "class" => $reflection_method->class,
                            "method" => $reflection_method->name,
                            "route" => $route
                        ];
                    }
                }
            }
        }

        
        /**
         * Cette méthode permet d'exécuter le routeur
         *
         * @return array|null
         */
        public function run() : ?array
        {

            foreach ($this->routes as $route) 
            {
                if ($this->match($this->request, $route['route'], $parameters)) 
                {
                    return [
                        "class"      => $route['class'],
                        "method"     => $route['method'],
                        "parameters" => $parameters
                    ];
                }
            }

            return null;
        }


        public function match(Request $request, Route $route, ?array &$params = [])
        {
            // Verifier la méthode d'envoie des données correspond à la méthode prévue
            if ( ! in_array($request->getMethod(), $route->getMethods()) ) 
            {
                // Retourner false 
                return false;
            }

            // Exploser la requête et la route en tableau
            $request_array = explode("/", $request->getPathInfo());
            $route_array   = explode("/", $route->getPath());

            // Retirer les espaces vides dans le tableau
            $request_array = array_values(array_filter($request_array, 'strlen'));
            $route_array = array_values(array_filter($route_array, 'strlen'));
            
            // Si le nombre d'enregistrement du tableau de la requête n'est pas le même que celui de la route
            if ( count($request_array) !== count($route_array) ) 
            {
                // Retourner false 
                return false;
            }
            
            // Parcourir le tableau de la route
            foreach ($route_array as $index => $urlPart) 
            {
                // dd($urlPart);

                // Si la valeur associée à l'index du tableau de la requête lors du tour de boucle existe,
                if (isset($request_array[$index])) 
                {
                    // dd('boom');
                    // Si la valeur commence par une accolade,
                    if (str_starts_with($urlPart, '{'))
                    {
                        // Récupérer le paramètre de la route sous forme de tableau
                        $routeParameter = explode(' ', preg_replace('/{([\w\-%]+)(<(.+)>)?}/', '$1 $3', $urlPart));

                        // A la clé 0, récupérer le nom du paramètre.
                        $paramName = $routeParameter[0];

                        // S'il n'y a aucune expression régulière passée, acceptons par défaut les lettres, les chiffres et les undescores.
                        $paramRegExp = (empty($routeParameter[1]) ? '[\w\-]+': $routeParameter[1]);
                        
                        // Si le regex a matché avec la requête,
                        if (preg_match('/^' . $paramRegExp . '$/', $request_array[$index])) 
                        {
                            // Sauvegardons le paramètre dans un tableau 
                            $params[$paramName] = $request_array[$index];
    
                            continue;
                        }
                    } 
                    // Sinon si le contenu est le même
                    elseif ($urlPart === $request_array[$index]) 
                    {
                        continue;
                    }
                }
                // Si la valeur n'esiste pas
                return false;
            }
    
            return true;
        }


        /**
         * Cette méthode permet de générer l'url d'une route en se basant sur son nom
         *
         * @param string $route_name
         * @param array $parameters
         * 
         * @return string
         */
        public function generateUrl(string $route_name, array $parameters = []) : string
        {

        }

        public function hasNoController() : bool
        {
            return (count($this->controllers) == 0) ? true : false;
        }


    }