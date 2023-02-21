<?php
namespace App\Zfoundation\AbstractController;

use App\Kernel;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

    abstract class AbstractController
    {
        
        private ContainerInterface $container;

        public function __construct()
        {
            $this->container = Kernel::getKernel()->getContainer();
        }

        public function render(string $view_path, array $parameters = [])
        {

            $content = $this->renderView($view_path, $parameters);
    
            $response = new Response();

            $response->setContent($content);

            return $response;
        }

        /**
         * Returns a rendered view.
         */
        protected function renderView(string $view, array $parameters = []): string
        {

            $twig = $this->container->get("twig");
                
            $content = $twig->render($view, $parameters);
            
            return $content;
        }
    }