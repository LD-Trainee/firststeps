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
use App\Form\MinusFormType;

class RechnerMinusController extends AbstractController
{
    /**
     * @Route("/rechner/minus/{zahl}", name="rechner_minus")
     */
    public function Action(int $zahl, Request $request)
    {
        $form = $this->createForm(MinusFormType::class);
        $form->handleRequest($request);
        $zahlminus = $form->get('zahlminus')->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            $ergebnis = $zahl - $zahlminus;

            // ... perform some action, such as saving the task to the database
            $zahl = $form->get('zahl')->getData();
            $ergebnis = $zahl - $zahlminus;
                return $this->redirectToRoute('rechner_start', ['ergebnis' => $ergebnis]);
            }

        //$request = Request::createFromGlobals();
        return $this->render('rechner_start/minus.html.twig', [
            'zahl' => $zahl,
            'form' => $form->createView()
    ]);}





}