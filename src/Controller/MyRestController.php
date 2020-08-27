<?php

namespace App\Controller;

use App\Entity\Rest;
use App\Form\RestFormType;
use http\Client;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MyRestController extends AbstractController
{
    private $spasst = false;
    /**
     * @Route("/api/v1/random/", name="my_rest_api", methods={"GET"})
     */
    public function IHSOY(Request $Req): object
    {
        if($Req->get('max') > $Req->get('min')) {
            $randomNumber = random_int($Req->get('min'), $Req->get('max'));
        } else {
            $randomNumber = 'Du schlawiner du';
        }

        $Res =new Response();
        $Res->setContent(json_encode([
            'data' => $randomNumber,
        ]));

        $Res->prepare($Req);
        return $Res;
    }
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/api/v1/index/", name="my_rest_index")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(RestFormType::class);
        $form->handleRequest($request);

        $randomNumber = -999;

        if ($form->isSubmitted() && $form->isValid()) {
            $minZahl = $form->get('minZahl')->getData();
            $maxZahl = $form->get('maxZahl')->getData();
            if($maxZahl <= $minZahl)
            {
                $this->spasst = true;
            }




            $randomNumber = -777;
            //Rest API aufruf einfügen
            /*$curl = curl_init();
            $this->randomNumber = curl_setopt($curl, CURL_RTSPREQ_GET_PARAMETER, 1);
            curl_close($curl);*/

            $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
            $url = $baseurl.$this->generateUrl('my_rest_api').'?min='.$minZahl.'&max='.$maxZahl;

            $response = $this->client->request(
                'GET',
                $url,
                ['body' => ['min' => $minZahl, 'max' => $maxZahl]]
            );
            $data = $response->getContent();
            $randomNumber = json_decode($data, $assoc = true, $depth = 512, $options = 0 )['data'];
        }

        if($this->spasst){
            $this->spasst = false;
            $randomNumber = 'Du schlawiner du';
        }

        return $this->render('my_rest/index.html.twig', [
            'form' => $form->createView(),
            'randomNumber' => $randomNumber
        ]);
    }
}
