<?php

namespace App\Controller;

use App\Entity\NicApiView;
use App\Entity\NicApiViewVersion2;
use App\Form\NicApiViewFormType;
use App\Form\NicApiViewFormTypeVersion2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LeonApiViewControllerVersion2 extends AbstractController
{
    private $client;

    private $size;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/leon/api/view/v2/", name="leon_api_view_v2")
     */
    public function index(Request $request)
    {

        $form = $this->createForm(NicApiViewFormTypeVersion2::class);
        $output = $request->get('output');
        $baseurl = $request->get('baseurl');
        if($output==null){
            $output = 'rofl';
        }
        if($baseurl==null){
            $baseurl = 'nh Ngrok Adresse halt';
        }


        $NicApiViewEntity = new NicApiViewVersion2();
        $NicApiViewEntity->setOutput($output);
        $NicApiViewEntity->setNgrokURL($baseurl);
        $form->setData($NicApiViewEntity);

        $data = $request->query->all();
        /**$form->setData($rechnerEntity);**/


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            $input = $form->get('input')->getData();
            $del = $form->get('delete')->getData();

            if($input=='del'&&is_numeric($del)){
                $baseurl = $form->get('NgrokURL')->getData();
                if(mb_substr($baseurl, -1)!='/'){
                    $baseurl.='/';
                }
                $url = $baseurl.'api/v2/zitate/'.$del;

                //$url = 'https://enc8fn5j798ak.x.pipedream.net';

                $response = $this->client->request(
                    'DELETE',
                    $url,

                );
                $data = $response->getContent();
                $responseDataArray = json_decode($data, $assoc = true, $depth = 512, $options = 0 );
                $output = 'success';

                $NicApiViewEntity->setOutput($output);
                return $this->redirectToRoute('leon_api_view_v2', ['output' => $output, 'baseurl' => $baseurl]);
            }

            if($input=='add'){
                $baseurl = $form->get('NgrokURL')->getData();
                if(mb_substr($baseurl, -1)!='/'){
                    $baseurl.='/';
                }
                $url = $baseurl.'api/v2/zitate/';

                //$url = 'https://enc8fn5j798ak.x.pipedream.net';

                $response = $this->client->request(
                    'POST',
                    $url,
                    ['body' => json_encode(['zitat' => $del])]

                );

                $data = $response->getContent();
                $responseDataArray = json_decode($data, $assoc = true, $depth = 512, $options = 0 );
                if(!isset($responseDataArray['errorMessage'])) {
                    $output = 'successAdd';
                } else {
                    $output = ['Hinzufügen fehlgeschlagen!', 'Halte dich bitte an folgendes Format:', 'Text#Autor#Zeit', 'Danke :)'];
                }

                $NicApiViewEntity->setOutput($output);
                return $this->redirectToRoute('leon_api_view_v2', ['output' => $output, 'baseurl' => $baseurl]);
            }

            if($input=='help'){
                $baseurl = $form->get('NgrokURL')->getData();
                if(mb_substr($baseurl, -1)!='/'){
                    $baseurl.='/';
                }
                $url = $baseurl.'api/v2/zitate/help/';

                //$url = 'https://enc8fn5j798ak.x.pipedream.net';

                $response = $this->client->request(
                    'GET',
                    $url,


                );

                $data = $response->getContent();
                $responseDataArray = json_decode($data, $assoc = true, $depth = 512, $options = 0 );
                /**if(!isset($responseDataArray['errorMessage'])) {
                    $output = 'successAdd';
                } else {
                    $output = ['Hinzufügen fehlgeschlagen!', 'Halte dich bitte an folgendes Format:', 'Text#Autor#Zeit', 'Danke :)'];
                }**/
                $output = [$responseDataArray['help'], ''];

                $NicApiViewEntity->setOutput($output);
                return $this->redirectToRoute('leon_api_view_v2', ['output' => $output, 'baseurl' => $baseurl]);
            }




            if($input=='all'){
                $inputA = 'api/v2/zitate';
            } elseif($input=='rnd') {
                $inputA = 'api/v1/zitate/rnd';
            } elseif (is_numeric($input)){
                $inputA = 'api/v2/zitate/'.$input;
            } else {
                $inputA = 'api/v2/zitate/rnd';
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
            $responseDataArray = json_decode($data, $assoc = true, $depth = 512, $options = 0 );

            $counter1 = 0;
            $counter2 = 0;
            $this->size = 0;
            $output = null;
            if(!isset($responseDataArray['Zitattext'])) {
                if(!isset($responseDataArray['zitatText'])) {
                    while ($counter1 != sizeof($responseDataArray)) {
                        $output[$counter1 + $this->size] = $responseDataArray[$counter1]['Zitattext'];
                        $this->size++;
                        $output[$counter1 + $this->size] = $responseDataArray[$counter1]['Zitatautor'];
                        $this->size++;
                        $output[$counter1 + $this->size] = $responseDataArray[$counter1]['Zitatzeit'];
                        $counter1++;
                    }
                } else {
                    $output = $responseDataArray;
                    $this->size = 3;
                }
            } else {
                $output = $responseDataArray;
                $this->size = 3;
            }


            $NicApiViewEntity->setOutput($output);
            return $this->redirectToRoute('leon_api_view_v2', ['output' => $output, 'baseurl' => $baseurl]);

            /**if($form->get('Rechenart')->getData())
            {
                return $this->redirectToRoute('rechner_plus', ['zahl' => $zahl]);
            }
            return $this->redirectToRoute('rechner_minus', ['zahl' => $zahl]);
             **/
        }




        return $this->render('nic_api_view/indexVersion2.html.twig', [
            'form' => $form->createView(),
            'output' => $output,
            'size' =>$this->size
        ]);
    }
}
