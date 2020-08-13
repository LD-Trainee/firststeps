<?php

namespace App\Controller;

use ContainerXj8pkaf\getRechnerStartControllerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;

class RechnerStartController extends AbstractController
{
    /**
     * @Route("/rechner/start", name="rechner_start")
     */
    public function eingabeHauptseite(Request $request)
    {
        $form = $this->createForm(\RechnerFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $info = $form->getData();

        }


        return $this->render('rechner_start/index.html.twig',
            [
                'rechnerForm' => $form->createView(),
            ]);
    }
}
