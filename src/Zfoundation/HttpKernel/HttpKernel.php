<?php
namespace App\Zfoundation\HttpKernel;


use Psr\Container\ContainerInterface;
use App\Zfoundation\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Zfoundation\HttpKernel\HttpKernelInterface;

    abstract class HttpKernel implements HttpKernelInterface
    {

        /**
         * Conteneur de services
         *
         * @var ContainerInterface
         */
        protected ContainerInterface $container;


        /**
         * Ce kernel dans lui même
         *
         * @var HttpKernel
         */
        protected static HttpKernel $kernel;


        public function __construct(ContainerInterface $container)
        {
            self::$kernel = $this;
            $this->container = $container;
        }


        /**
         * Cette méthode permet au noyau de soumettre la requête 
         * et de récupérer la réponse correspondante.
         *
         * @return Response
         */
        public function handleRequest() : Response
        {
            $router = $this->container->get(RouterInterface::class);

            if ( $router->hasNoController() ) 
            {
                return $this->generateNotFoundResponse('welcome');
            }
            
            $router_response = $router->run();

            return $this->getControllerResponse($router_response);

        }


        /**
         * Cette propriété du HttpKernel lui permet : 
         *      - d'appeler le contrôleur en charge de la requête
         *      - de lui demander de générer la réponse correspondante
         *      - et de la lui retourner
         *
         * @param array|null $router_response
         * @return Response
         */
        protected function getControllerResponse(?array $router_response): Response
        {
            $logger  = $this->container->get('logger');
            $uri_url = $this->container->get(Request::class)->getPathInfo();

            if ( $router_response === null ) 
            {
                $logger->error("Url : '$uri_url' not found");
                return $this->generateNotFoundResponse('notfound');
            }

            // Dans le cas contraire,
            
            // Récupérer le nom du contrôleur ainsi que sa méthode censée gérer l'évenement
            $controller     = $router_response['class'];
            $method         = $router_response['method'];
            
            $logger->info("Url : '$uri_url' found");
            
            if ( isset($router_response['parameters']) && !empty($router_response['parameters']) ) 
            {
                $parameters = $router_response['parameters'];
                
                $controller_instance = $this->container->get($controller);
                return $this->container->call([$controller_instance, $method], [...$parameters]);
            }

            return $this->container->call([$controller, $method]);
        }

        /**
         * Cette méthode du noyau lui permet de générer une réponse dans le cas où la requête n'a aucun contrôleur correspondant
         *
         * @param string $http_resource_name
         * @return Response
         */
        protected function generateNotFoundResponse(string $http_resource_name) : Response
        {
            ob_start();
            require __DIR__ . "/Resources/$http_resource_name.html.php";
            $content = ob_get_clean();

            return new Response($content, 404);
        }


        public static function getKernel() : self
        {
            return self::$kernel;
        }

        public function getContainer() : ContainerInterface
        {
            return $this->container;
        }
    }