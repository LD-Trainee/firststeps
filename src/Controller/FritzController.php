<?php

namespace App\Controller;

use App\Entity\Fritz;
use App\Form\FritzType;
use App\Repository\FritzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\NicApiView;
use App\Form\NicApiViewFormType;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class FritzController extends AbstractController
{

    private $client;
    private $aha;
    /**
     * @Route("/fritz/", name="fritz_index", methods={"GET", "POST"})
     */


    public function index(Request $request)
    {


            // Form auslesen
            //$wert = $form->get('wert');
            /**{
                $switches = $this->aha->getAllSwitches();
                $data = $form->getData();
                $switch = $data->getSwitch();
                $dat = new Fritz();
                $dat->setSwitch($switches);
                $form->setData($dat);
            }**/

                $this->aha->setSwitchOn('087610234455');
                sleep(4);
                $this->aha->setSwitchOff('087610234455');




        return $this->render('fritz/index.html.twig');
    }



    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->aha = new FritzboxAHA();
        // username = app
        // pw = appinterntest
        $this->aha->login('fritz.box/', 'app', 'apptest+');

    }

    /**
     * @Route("/new", name="fritz_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fritz = new Fritz();
        $form = $this->createForm(FritzType::class, $fritz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fritz);
            $entityManager->flush();

            return $this->redirectToRoute('fritz_index');
        }

        return $this->render('fritz/new.html.twig', [
            'fritz' => $fritz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fritz_show", methods={"GET"})
     */
    public function show(Fritz $fritz): Response
    {
        return $this->render('fritz/show.html.twig', [
            'fritz' => $fritz,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fritz_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fritz $fritz): Response
    {
        $form = $this->createForm(FritzType::class, $fritz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fritz_index');
        }

        return $this->render('fritz/edit.html.twig', [
            'fritz' => $fritz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fritz_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Fritz $fritz): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fritz->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fritz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fritz_index');
    }
}
