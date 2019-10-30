<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

final class DefaultController {

    public function index()
    {
        return new Response('<h1>Welcome to News Portal!</h1>');
    }
}
