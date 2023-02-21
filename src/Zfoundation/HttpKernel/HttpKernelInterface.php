<?php
namespace App\Zfoundation\HttpKernel;

use Symfony\Component\HttpFoundation\Response;

    interface HttpKernelInterface
    {
        /**
         * Cette méthode permet au noyau de soumettre la requête 
         * et de récupérer la réponse correspondante.
         *
         * @return Response
         */
        public function handleRequest() : Response;
    }