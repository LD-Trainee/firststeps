<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class VinTestController extends AbstractController
{
    /**
     * @Route("/vin/test/{vin}", name="vin_test")
     */

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function index($vin)
    {
        $url = "https://de.vindecoder.pl/".$vin;

        $response = $this->client->request(
            'GET',
            $url
        );


        return $this->render('vin_test/index.html.twig', [
            'controller_name' => 'VinTestController',
        ]);
    }
}
