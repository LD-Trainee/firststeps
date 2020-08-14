<?php

namespace App\Controller;

use App\Entity\Rechner;
use App\Form\RechnerFormType;
use ContainerXj8pkaf\getRechnerStartControllerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class RechnerStartController extends AbstractController
{
    /**
     * @Route("/rechner/start", name="rechner_start")
     */
    public function eingabeHauptseite(Request $request)
    {
        $form = $this->createForm(RechnerFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            $zahl = $form->get('zahl')->getData();

            if($form->get('attending')->getData())
            {
                return $this->redirectToRoute('rechner_minus', ['zahl' => $zahl]);
            }
                return $this->redirectToRoute('rechner_minus', ['zahl' => $zahl]);
        }

        return $this->render('rechner_start/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
