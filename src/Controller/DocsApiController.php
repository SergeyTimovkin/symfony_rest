<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocsApiController
{
    /**
     * @Route("/")
     */
    public function index(){
        return new Response('Docs API');
    }
}