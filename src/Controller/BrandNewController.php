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
        $text = 'hier steht leider nur blödsinn, weil ich meinen neuen Controller testen wollte';
        return $this->render('brand_new/text.html.twig', [
            'controller_name' => 'BrandNewController',
            'text' => $text,
        ]);
    }

    public function show(string $text)
    {
        var_dump($text);
    }
}
