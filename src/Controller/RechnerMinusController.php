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
    public function Action(int $zahl)
    {
        $form = $this->createForm(MinusFormType::class);
        //$request = Request::createFromGlobals();
        return $this->render('rechner_start/minus.html.twig', [
            'zahl' => $zahl,
            'form' => $form->createView()
    ]);
    }

}