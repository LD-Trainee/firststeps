<?php

namespace App\Controller;

use App\Entity\NicApiView;
use App\Form\NicApiViewFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NicApiViewController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/nic/api/view", name="nic_api_view")
     */
    public function index(Request $request)
    {

        $form = $this->createForm(NicApiViewFormType::class);
        $output = $request->get('output');
        $baseurl = $request->get('baseurl');
        if($output==null){
            $output = 'rofl';
        }
        if($baseurl==null){
            $baseurl = 'nh Ngrok Adresse halt';
        }


        $NicApiViewEntity = new NicApiView();
        $NicApiViewEntity->setOutput($output);
        $NicApiViewEntity->setNgrokURL($baseurl);
        $form->setData($NicApiViewEntity);

        $data = $request->query->all();
        /**$form->setData($rechnerEntity);**/


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            $input = $form->get('input')->getData();


            if($input=='all'){
                $inputA = 'api/v1/zitate';
            } elseif($input=='rnd') {
                $inputA = 'api/v1/zitate/random';
            } elseif (is_numeric($input)){
                $inputA = 'api/v1/zitate/'.$input;
            }

            $baseurl = $form->get('NgrokURL')->getData();
            if(mb_substr($baseurl, -1)!='/'){
                $baseurl.='/';
            }
            $url = $baseurl.$inputA;

            //$url = 'https://enc8fn5j798ak.x.pipedream.net';

            $response = $this->client->request(
                'GET',
                $url,
            );
            $data = $response->getContent();
            $responseData = json_decode($data, $assoc = true, $depth = 512, $options = 0 )['data'];

            $counter1 = 0;
            $output = null;
            if(sizeof($responseData)!=3) {
                while ($counter1 != sizeof($responseData)) {
                    $output = $output . implode('___', $responseData[$counter1]) . '___';
                    $counter1++;
                }
            } else $output = implode('___', $responseData) . '___';

            $NicApiViewEntity->setOutput($output);
            return $this->redirectToRoute('nic_api_view', ['output' => $output, 'baseurl' => $baseurl]);

            /**if($form->get('Rechenart')->getData())
            {
                return $this->redirectToRoute('rechner_plus', ['zahl' => $zahl]);
            }
            return $this->redirectToRoute('rechner_minus', ['zahl' => $zahl]);
             **/
        }




        return $this->render('rechner_start/index.html.twig', [
            'form' => $form->createView(),
            'output' => $output
        ]);
    }
}
