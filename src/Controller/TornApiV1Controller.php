<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TornApiV1Controller extends AbstractController
{
    /**
     * @Route("/torn/api/v1", name="torn_api_v1")
     */
    public function index()
    {
        return $this->render('torn_api_v1/index.html.twig', [
            'controller_name' => 'TornApiV1Controller',
        ]);
    }
}
