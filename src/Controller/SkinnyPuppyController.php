<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SkinnyPuppyController extends AbstractController
{
    /**
     * @Route("/skinny/puppy", name="skinny_puppy")
     */
    public function index()
    {
        return $this->render('skinny_puppy/index.html.twig', [
            'controller_name' => 'SkinnyPuppyController',
        ]);
    }
}
