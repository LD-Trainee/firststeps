<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\ScopingHttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class StefanAufgabeController extends AbstractController
{
    private $client;
    private $url;
    private $url2;
    private $token;
    private $seperator;
    public function __construct(HttpClientInterface $client){



//        $this->client = new ScopingHttpClient($client, [
//            'https://ferronordic.d-velop.cloud/' => [
//                'Content-Type' => 'application/json',
//                'User-Agent'=> 'PostmanRuntime/7.26.5',
//                'Accept'=> '*/*',
//                'Accept-Encoding'=> 'gzip, deflate, br',
//                'Connection'=> 'keep-alive',
//                'Authorization'=> $this->token
//            ],
//            'headers' => [
//                'Content-Type' => 'application/json',
//                'User-Agent'=> 'PostmanRuntime/7.26.5',
//                'Accept'=> '*/*',
//                'Accept-Encoding'=> 'gzip, deflate, br',
//                'Connection'=> 'keep-alive',
//                'Authorization'=> $this->token
//            ]
//        ]);
        $this->client = $client;

        $this->file = 'Zieldatei.csv';

        $this->seperator = ';';

        $this->url = 'https://ferronordic.d-velop.cloud/task/tasks/search';

        $this->url2 = 'https://ferronordic.d-velop.cloud/identityprovider/scim/groups/';

        //$this->url = 'https://9caab5791455846ab4317c1258ec1e82.m.pipedream.net';
        // siehe config/packages/framework.yaml für header
    }

    /**
     * @Route("/stefan/aufgabe", name="stefan_aufgabe")
     */
    public function index()
    {
        $response = $this->client->request(
            'POST',
            $this->url,
                    [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'User-Agent'=> 'PostmanRuntime/7.26.5',
                        'Accept'=> '*/*',
                        'Accept-Encoding'=> 'gzip, deflate, br',
                        'Connection'=> 'keep-alive',
                        'Authorization'=> $this->token
                    ],
                        'body' => '{"includeMetadata":true,"resultsPerPage":20000,"orderColumn":"received","orderDir":1,"searchParam":"","group":"ALL","inverse":false}'
                    ]


        );

        $response2 = $this->client->request(
            'GET',
            $this->url2,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'User-Agent'=> 'PostmanRuntime/7.26.5',
                    'Accept'=> '*/*',
                    'Accept-Encoding'=> 'gzip, deflate, br',
                    'Connection'=> 'keep-alive',
                    'Authorization'=> $this->token
                ],
                'body' => '{"includeMetadata":true,"resultsPerPage":20000,"orderColumn":"received","orderDir":1,"searchParam":"","group":"ALL","inverse":false}'
            ]
        );

        $speicherort = '/public/'.$this->file;
        //$success = json_decode($response->getContent());
        $success = 'yup';
        $data = json_decode($response->getContent(), true)['_embedded']['tasks'];
        $count = count($data);
        //$data2 = json_decode($response2->getContent(), true);
        $data2 = json_decode(gzdecode($response2->getContent()), true);
        //file_put_contents('testtesttest.txt', $data2);

        file_put_contents($this->file, 'Gegenstand;zugewiesene Gruppen;Brutto Betrag;Dokument;Kostenstellen;Kreditorname;Kreditornr.;Mandantenname;Mandantennr.;Netto Betrag;Prozessinstanz;Rechnungsdatum;Standort;Externe Belegnr.;Belegart;Empfangsdatum;Link zur Aufgabe;'."\r\n");

        foreach ($data as $row){

            $addStr = null;
            $rowToWrite = $row['subject'].$this->seperator.
                implode(',', $row['assignedGroups']).$this->seperator;
                $add = $row['metadata'];
                foreach($add as $a){
                    if($a['key']=='bruttoBetrag'){
                        $bruttoBetrag = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='docId'){
                        $docId = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='costCenters'){
                        $costCenters = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='kreditorName'){
                        $kreditorName = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='kreditorNr'){
                        $kreditorNr = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='mandantenName'){
                        $mandantenName = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='mandantenNr'){
                        $mandantenNr = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='nettoBetrag'){
                        $nettoBetrag = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='custom1'){
                        $custom1 = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='rechnungsdatum'){
                        $rechnungsdatum = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='custom2'){
                        $custom2 = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='externeBelegnr'){
                        $externeBelegnr = implode(',', $a['values']).$this->seperator;
                    }
                    if($a['key']=='belegart'){
                        $belegart = implode(',', $a['values']).$this->seperator;
                    }

                }
            $date = substr($row['receiveDate'], 0, 10).$this->seperator;
            $link = $row['_links']['form']['href'].$this->seperator;
            $rowToWrite = $rowToWrite.$bruttoBetrag.$docId.$costCenters.$kreditorName.$kreditorNr.$mandantenName.$mandantenNr.$nettoBetrag.$custom1.$rechnungsdatum.$custom2.$externeBelegnr.$belegart.$date.$link;

            // einfügen V.2 Mapping Gruppennamen mit 2.ter API schnittstelle

            foreach ($data2['resources'] as $group){
                if($group['id'] == implode(',', $row['assignedGroups'])){
                    $rowToWrite = str_replace($group['id'], $group['displayName'], $rowToWrite);
                }
            }

            $rowToWrite = utf8_decode($rowToWrite);
            file_put_contents($this->file, $rowToWrite."\r\n", FILE_APPEND | LOCK_EX);
        }


        return $this->render('stefan_aufgabe/index.html.twig', [
            'controller_name' => 'StefanAufgabeController',
            'speicherort' => $speicherort,
            'success' => $success,
            'count' => $count
        ]);
    }
}

