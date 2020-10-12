<?php

namespace App\Controller;

use App\Entity\NicApiViewVersion2;
use App\Form\NicApiViewFormTypeVersion2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LeonApiViewControllerVersion3 extends AbstractController
{
    private $client;

    private $size;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/leon/api/view/v3/", name="leon_api_view_v3")
     */
    public function index(Request $request)
    {

        $form = $this->createForm(NicApiViewFormTypeVersion2::class);
        $output = $request->get('output');
        $baseurl = $request->get('baseurl');
        if($output==null){
            $output = ['ZitateView Version 3', 'Von Leon Olbrück', ' '];
        }
        if($baseurl==null){
            $baseurl = 'full Hostname: http://localhost';
        }


        $NicApiViewEntity = new NicApiViewVersion2();
        $NicApiViewEntity->setOutput($output);
        $NicApiViewEntity->setNgrokURL($baseurl);
        $form->setData($NicApiViewEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $input = $form->get('input')->getData();
            $del = $form->get('delete')->getData();

            if($input=='del'&&is_numeric($del)){ //            DELETE action
                $baseurl = $form->get('NgrokURL')->getData();
                if(mb_substr($baseurl, -1)!='/'){
                    $baseurl.='/';
                }
                $url = $baseurl.'api/v3/zitat/'.$del;

                $response = $this->client->request(
                    'DELETE',
                    $url,

                );
                $data = $response->getContent();
                $responseDataArray = json_decode($data, $assoc = true, $depth = 512, $options = 0 );
                $output = $responseDataArray['success'];
                $NicApiViewEntity->setOutput($output);
                return $this->redirectToRoute('leon_api_view_v3', ['output' => $output, 'baseurl' => $baseurl]);
            }

            if($input=='add'){//                                ADD action
                $baseurl = $form->get('NgrokURL')->getData();
                if(mb_substr($baseurl, -1)!='/'){
                    $baseurl.='/';
                }
                $url = $baseurl.'api/v3/zitat/';

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
                return $this->redirectToRoute('leon_api_view_v3', ['output' => $output, 'baseurl' => $baseurl]);
            }

            if($input=='help'){                      //            help action
                $baseurl = $form->get('NgrokURL')->getData();
                if(mb_substr($baseurl, -1)!='/'){
                    $baseurl.='/';
                }
                $url = $baseurl.'api/v3/zitat/help/';

                //$url = 'https://enc8fn5j798ak.x.pipedream.net';

                $response = $this->client->request(
                    'GET',
                    $url,


                );

                $data = $response->getContent();
                $responseDataArray = json_decode($data, $assoc = true, $depth = 512, $options = 0 );
                $output = [$responseDataArray['help'], ''];

                $NicApiViewEntity->setOutput($output);
                return $this->redirectToRoute('leon_api_view_v3', ['output' => $output, 'baseurl' => $baseurl]);
            }




            if($input=='all'){                            //            all, rnd, byId action
                $inputA = 'api/v3/zitat';
            } elseif($input=='rnd') {
                $inputA = 'api/v3/zitat/rnd';
            } elseif (is_numeric($input)){
                $inputA = 'api/v3/zitat/'.$input;
            } else {
                $inputA = 'api/v3/zitat/rnd';
            }

            $baseurl = $form->get('NgrokURL')->getData();
            if(mb_substr($baseurl, -1)!='/'){
                $baseurl.='/';
            }
            $url = $baseurl.$inputA;

            $response = $this->client->request(
                'GET',
                $url,
            );
            $data = $response->getContent();
            $responseDataArray = json_decode($data, $assoc = true, $depth = 512, $options = 0 );
            if(!empty($responseDataArray['zitatExists'])){
                $NicApiViewEntity->setOutput($output);
                return $this->redirectToRoute('leon_api_view_v3', ['output' => 'noSuchId', 'baseurl' => $baseurl]);
            } else
            {
                $counter1 = 0;
                $counter2 = 0;
                $this->size = 0; // ;)
                $output = null;
                if (!isset($responseDataArray['Zitattext'])) {
                    if (!isset($responseDataArray['zitatText'])) {
                        while ($counter1 != sizeof($responseDataArray)) {
                            $output[$counter1 + $this->size] = $responseDataArray[$counter1]['Zitattext'];
                            $this->size++;
                            $output[$counter1 + $this->size] = $responseDataArray[$counter1]['Zitatautor'];
                            $this->size++;
                            $output[$counter1 + $this->size] = $responseDataArray[$counter1]['Zitatzeit'];
                            $this->size++;
                            $output[$counter1 + $this->size] = $responseDataArray[$counter1]['Zitatid'];
                            $counter1++;
                        }
                    } else {
                        $output = $responseDataArray;
                        $this->size = 4;
                    }
                } else {
                    $output = $responseDataArray;
                    $this->size = 4;
                }
            }


            $NicApiViewEntity->setOutput($output);
            return $this->redirectToRoute('leon_api_view_v3', ['output' => $output, 'baseurl' => $baseurl]);
        }




        return $this->render('nic_api_view/indexVersion3.html.twig', [
            'form' => $form->createView(),
            'output' => $output,
            'size' =>$this->size
        ]);
    }
}
