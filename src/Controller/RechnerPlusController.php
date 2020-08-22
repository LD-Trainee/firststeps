<?php

namespace App\Controller;

use App\Entity\Plus;
use App\Entity\Rechner;
use App\Form\RechnerFormType;
use ContainerXj8pkaf\getRechnerStartControllerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use App\Form\PlusFormType;

class RechnerPlusController extends AbstractController
{
    /**
     * @Route("/rechner/plus/{zahl}", name="rechner_plus")
     */
    public function Action(float $zahl, Request $request)
    {

        $form = $this->createForm(PlusFormType::class);

        {
            $TempPlusEntity = new Plus();
            $TempPlusEntity->setFeldPlus($request->query->get('zahl'));
            $form->setData($TempPlusEntity);
        }
        $form->handleRequest($request);
        $zahlplus = $form->get('zahlplus')->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            $Plusergebnis = $zahl + $zahlplus;

            $zahl = $form->get('feldPlus')->getData();
            //$zahl = $request->query->get('zahl');
            $ergebnis = $zahlplus - $zahl;
            return $this->redirectToRoute('rechner_start', ['ergebnis' => $Plusergebnis]);
        }

        //$request = Request::createFromGlobals();
        return $this->render('rechner_start/plus.html.twig', [
            'zahl' => $zahl,
            'form' => $form->createView()
        ]);}
}