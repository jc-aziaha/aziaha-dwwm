<?php
namespace App\Controller;

use App\Zfoundation\Routing\Attributes\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Zfoundation\AbstractController\AbstractController;

    class WelcomeController extends AbstractController
    {

        #[Route("/", name: "welcome.index", methods: ['GET'])]
        public function index() : Response
        {
            $formation = "dwwm";
            return $this->render("welcome.html.twig", compact('formation'));
        }


        #[Route("/test", name: "welcome.test", methods: ['GET'])]
        public function test() : Response
        {
            dd('page test');
        }

        #[Route("/user/{id<\d+>}/edit", name: "welcome.test", methods: ['GET'])]
        public function edit(int $id) : Response
        {
            dd($id);
        }

    }