<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeliciousPizzaController extends AbstractController
{
    /**
     * @Route("/testen/des/testers", name="delicious_pizza")
     */
    public function index()
    {
        return $this->render('delicious_pizza/index.html.twig', [
            'controller_name' => 'DeliciousPizzaController',
        ]);
    }
}
