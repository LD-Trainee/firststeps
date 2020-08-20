<?php

namespace App\Controller;

;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request)
    {

        $symfony = "Syfony ist das coolste Framework der Welt!";

//        return new Response('', Response::HTTP_I_AM_A_TEAPOT);

        return $this->render('index/plus.html.twig', [
            'controller_name' => 'World',
            'title' => $symfony
        ]);
    }
}
