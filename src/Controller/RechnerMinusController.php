<?php


namespace App\Controller;

use App\Entity\Minus;
use App\Entity\Rechner;
use App\Form\RechnerFormType;
use ContainerXj8pkaf\getRechnerStartControllerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use App\Form\MinusFormType;

class RechnerMinusController extends AbstractController
{
    /**
     * @Route("/rechner/minus/{zahl}", name="rechner_minus")
     */
    public function Action(int $zahl, Request $request)
    {

        $form = $this->createForm(MinusFormType::class);

        {
        $TempMinusEntity = new Minus();
        $TempMinusEntity->setFeld($request->query->get('zahl'));
        $form->setData($TempMinusEntity);
    }
        $form->handleRequest($request);
        $zahlminus = $form->get('zahlminus')->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            $minusergebnis = $zahl - $zahlminus;

            $zahl = $form->get('feld')->getData();
            //$zahl = $request->query->get('zahl');
            $ergebnis = (int)$zahlminus - (int)$zahl;
                return $this->redirectToRoute('rechner_start', ['ergebnis' => $minusergebnis]);
            }

        //$request = Request::createFromGlobals();
        return $this->render('rechner_start/minus.html.twig', [
            'zahl' => $zahl,
            'form' => $form->createView()
    ]);}





}