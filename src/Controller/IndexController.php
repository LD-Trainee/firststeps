<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $symfony = "Syfony ist das coolste Framework der Welt!";
        return $this->render('index/index.html.twig', [
            'controller_name' => 'World',
            'lob' => $symfony
        ]);
    }
}
