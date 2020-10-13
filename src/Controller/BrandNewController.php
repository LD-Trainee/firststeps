<?php

namespace App\Controller;

use App\Entity\HerrchenEntity;
use App\Entity\HundEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BrandNewController extends AbstractController
{
    /**
     * @Route("/brand/new", name="brand_new")
     */
    public function Text()
    {
        $em = $this->getDoctrine()->getManager();
        $herr = new HerrchenEntity();
        $herr->setName($this->name());
        $hund1 = new HundEntity();
        $hund1->setName($this->name())->setAge(rand(0,20))->setRasse($this->rasse());
        $em->persist($herr);
        $em->flush();
        $gandalfs = $em->getRepository(HerrchenEntity::class)->findAll();
        $idN = array_rand($gandalfs);
        $id = $gandalfs[$idN]->getId();
        $hund1->setHerrchen($id);
        $em->persist($hund1);
        $em->flush();

        return $this->render('brand_new/text.html.twig', [
            'controller_name' => 'BrandNewController'
        ]);
    }

    public function name()
    {
        $array = [
            'Gerald',
            'He Man',
            'Susi',
            'Strolch',
            'Gandalf',
            'Peter',
            'Giesela'
        ];
        return($array[array_rand($array)]);
    }

    public function rasse()
    {
        $array = [
            'Bernhardiner',
            'Baby Löwenhirsch',
            'Wackeldackel'
        ];
        return($array[array_rand($array)]);
    }
}
