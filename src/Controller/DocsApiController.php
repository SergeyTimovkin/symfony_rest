<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocsApiController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return new Response('
        <hr>
         <b>Просмотр записи клиент-адресс по айди:</b>
        <br>
        METHOD: GET
        <br>
        URL: api/client/{id}
        <br>
        RETURN: client-address data JSON
        <hr>
        <b>Удаление записи клиент-адресс по айди:</b>
        <br>
        METHOD: DELETE
        <br>
        URL: api/client/{id}
        <br>
        RETURN: {  status: code, message: "text"  }
        <hr>
        <b>Обновление записи клиент-адресс по айди:</b>
        <br>
        METHOD: PUT
        <br>
        URL: api/client/{id}
        <br>
        Example data: {
                 "client_id": 1,
                 "home_id": 2,
                 "porch": 24,
                  "floor": 2,
                  "intercom": 31,
                 "apartment": 4
                }
        <br>
      
        <hr>
        
        ');
    }
}