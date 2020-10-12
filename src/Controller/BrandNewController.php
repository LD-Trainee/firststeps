<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BrandNewController extends AbstractController
{
    /**
     * @Route("/brand/new", name="brand_new")
     */
    public function Text()
    {
        return $this->render('brand_new/text.html.twig', [
            'controller_name' => 'BrandNewController'
        ]);
    }
}
