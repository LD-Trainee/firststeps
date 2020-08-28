<?php

namespace App\Controller;

use App\Entity\Rest;
use App\Form\RestFormType;
use http\Client;
use Nelmio\ApiDocBundle\Annotation\Security;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class MyRestController extends AbstractController
{
    /**
     * @var bool
     * @SWG\Property (type="boolean", description="true = Angaben zum generieren der Zufallszahl invalid")
     */

    private $Vogel = false;
    /**
     * @Route("/api/v1/random/", name="my_rest_api", methods={"GET"})
     * @SWG\Get  (
     *      path="/api/v1/random",
     *      operationId="generateNumber",
     *      summary="generiert eine Zufallszahl mithilfe der eingabewerte min, max",
     *      method="GET",
     *      @SWG\Response (
     *      response=200,
     *      description="Returns the Random Generated number",
     *      @SWG\Parameter
     *      (
     *          name="randomName",
     *          in="query",
     *          type="Integer",
     *          description="randomNumber ausgeben"
     *      ),
     * ),
     *      @SWG\Tag(name="randomNumber")
     * ),
     */

    public function IHSEY(Request $request): object
    {
        $contentType = $request->headers->get('Content-Type');

        /**
         * @SWG\Property(
         *     in="path",
         *     required="true",
         *     type="int",
         *     description="Minimum"
         * )
         *
         */
        $max = $request->query->get('max');

        /**
         * @SWG\Property(
         *     in="path",
         *     required="true",
         *     type="int",
         *     description="Maximum"
         * )
         */
        $min = $request->query->get('min');

        if( $max > $min) {
            $randomNumber = random_int($request->get('min'), $request->get('max'));
        } else {
            $randomNumber = 'Du schlawiner du';
        }

        $Res =new Response();
        $Res->setContent(json_encode([
            'data' => $randomNumber,
        ]));

        $Res->prepare($request);
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
                $this->Vogel = true;
            }




            $randomNumber = -777;
            //Rest API aufruf einfügen
            /*$curl = curl_init();
            $this->randomNumber = curl_setopt($curl, CURL_RTSPREQ_GET_PARAMETER, 1);
            curl_close($curl);*/

            $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
            $url = $baseurl.$this->generateUrl('my_rest_api').'?min='.$minZahl.'&max='.$maxZahl;

            //$url = 'https://enrd300qc4rug.x.pipedream.net';

            $response = $this->client->request(
                'GET',
                $url,
                ['json' => ['min' => $minZahl, 'max' => $maxZahl]]
            );
            $data = $response->getContent();
            $randomNumber = json_decode($data, $assoc = true, $depth = 512, $options = 0 )['data'];
        }

        if($this->Vogel){
            $this->Vogel = false;
            $randomNumber = 'Du schlawiner du';
        }

        return $this->render('my_rest/index.html.twig', [
            'form' => $form->createView(),
            'randomNumber' => $randomNumber
        ]);
    }
}
