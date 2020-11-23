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
        return new Response('
        <hr>
        <b>Удаление записи клиент-адресс по айди:</b>
        <br>
        METHOD: DELETE
        <br>
        URL: api/client/{id}
        <hr>
        
        ');
    }
}