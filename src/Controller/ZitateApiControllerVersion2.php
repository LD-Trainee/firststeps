<?php

namespace App\Controller;

use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse as Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ZitateApiControllerVersion2 extends AbstractController
{
    /**
     * @Route("/api/v2/zitate/{id}", name="api_zitate_id_v2", requirements={"id"="\d+"}, methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Json mit einem bestimmten Zitaten",
     *     @SWG\Schema(
     *        type="object",
     *        example={"zitatText: Dies ist das Zitat,zitatAutor: Dies ist der Autor des Zitats,zitatZeit: Dies ist die Zeit des Zitats"}
     *     )
     * )
     * @SWG\Parameter(
     *     name="params",
     *     in="path",
     *     type="string",
     *     description="id in der url angeben",
     *     @SWG\Schema(
     *        type="url",
     *        example={"3"}
     *     )
     * )
     */

    public function apiGetZitatById(Request $request): object
    {

        $id = $request->get('id');
        $zitate = $this->setZitate();


        if (is_numeric($id)) {
            /**
             * Hier Zitat per ID ausgeben
             */


            $test = $zitate[3][1];

            if ($id >= sizeof($zitate)) {
                $Res = new Response();
                $Res->setContent(json_encode([
                    'errorMessage' => 'es sind nur ' . sizeof($zitate) . ' Zitate verfügbar!'
                ]));

                $Res->prepare($request);
                return $Res;
            }

            $Res = new Response();
            $Res->setContent(json_encode([
                'zitatText' => $zitate[$id][0],
                'zitatAutor' => $zitate[$id][1],
                'zitatZeit' => $zitate[$id][2]
            ]));

            $Res->prepare($request);
            return $Res;
        }
    }


    /**
     * @Route("/api/v2/zitate/rnd", name="api_zitate_rnd_v2", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Json mit random Zitate",
     *     @SWG\Schema(
     *        type="object",
     *        example={"zitatText: Dies ist das Zitat,zitatAutor: Dies ist der Autor des Zitats,zitatZeit: Dies ist die Zeit des Zitats"}
     *     )
     * )
     * @SWG\Parameter(
     *     name="params",
     *     in="path",
     *     type="string",
     *     description="none",
     *     @SWG\Schema(
     *        type="url",
     *        example={"keine parameter notwendig oder akzeptiert"}
     *     )
     * )
     */



    public function apiGetRandomZitat(Request $request): object
    {
        $data = json_decode($request->getContent());
        $zitate = $this->setZitate();

            /**
             * Heir Random Zitat ausgeben
             */

            $id = random_int(0, sizeof($zitate)-1);

            $Res =new Response();
            $Res->setContent(json_encode([
                'zitatText' => $zitate[$id][0],
                'zitatAutor' => $zitate[$id][1],
                'zitatZeit' => $zitate[$id][2]
            ]));

            $Res->prepare($request);
            return $Res;


    }

    /**
     * @Route("/api/v2/zitate/", name="api_zitate_all_v2", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Json mit allen Zitaten",
     *     @SWG\Schema(
     *        type="object",
     *        example={"zitatText: Dies ist das Zitat,zitatAutor: Dies ist der Autor des Zitats,zitatZeit: Dies ist die Zeit des Zitats  so oft wie es zitate gibt :)"}
     *     )
     * )
     * @SWG\Parameter(
     *     name="params",
     *     in="path",
     *     type="string",
     *     description="none",
     *     @SWG\Schema(
     *        type="url",
     *        example={"keine parameter notwendig oder akzeptiert :)"}
     *     )
     * )
     */

    public function apiGetAlleZitate(Request $request): object
    {
        $data = json_decode($request->getContent());
        $zitate = $this->setZitate();

        $a = sizeof($zitate) / 3;
        $counter1 = 0;
        $counter2 = 0;
        while($counter1!=sizeof($zitate)) {
            while ($counter2 != 3) {
                if ($counter2 == 0){
                    $zitateAusgabe[$counter1]['Zitattext'] = $zitate[$counter1][0];
                }
                if ($counter2 == 1){
                    $zitateAusgabe[$counter1]['Zitatautor'] = $zitate[$counter1][1];
                }
                if ($counter2 == 2){
                    $zitateAusgabe[$counter1]['Zitatzeit'] = $zitate[$counter1][2];
                }
                $counter2++;
            }
            $counter1++;
            $counter2 = 0;
        }




            $Res =new Response();
            $Res->setContent(json_encode($zitateAusgabe));

            $Res->prepare($request);
            return $Res;


    }

    /**
     * @Route("/api/v2/zitate/", name="api_zitate_put_v2", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="gibt ok bei erfolg, wer hätts gedacht, und dann auch noch die id vom neuen Zitat!",
     *     @SWG\Schema(
     *        type="object",
     *        example={"{success:true,id:69}"}
     *     )
     * )
     * @SWG\Parameter(
     *     name="params",
     *     in="body",
     *     type="json",
     *     description="das zu postende Zitat angeben",
     *     @SWG\Schema(
     *        type="object",
     *        example={"{zitat:Zitattext#Zitatautor#Zitatzeit}"}
     *     )
     * )
     */


    public function apiPutZitat(Request $request)
    {
        $zitate = $this->setZitate();
        $data = json_decode($request->getContent());
        $newZitat = $data->zitat;

        $newZitatId = sizeof($zitate);

        $testZitatSyntax = explode('#', $newZitat);
        if(sizeof($testZitatSyntax)!='3'){
            $Res =new Response();
            $Res->setContent(json_encode([
                'success' => 'false',
                'errorMessage' => 'Falsche Zitat Syntax, bitte an dokumentation halten!'
            ]));

            $Res->prepare($request);
            return $Res;
        }
        $textString = null;
        $counter1 = 0;
        while($counter1!==sizeof($zitate)){
            if($textString===null) {
                $textString = $textString . implode($zitate[$counter1], "#");
            } else {
                $textString = $textString . "#" . implode($zitate[$counter1], "#");
            }
            $counter1++;
        }
        $textString = $textString . '#' . $newZitat;

        file_put_contents("Zitate_v2.txt", $textString);

        $Res =new Response();
        $Res->setContent(json_encode([
            'success' => 'true',
            'id' => $newZitatId
        ]));

        $Res->prepare($request);
        return $Res;
    }


    /**
     * @Route("/api/v2/zitate/{id}", name="api_zitate_delete_v2", requirements={"id"="\d+"}, methods={"DELETE"})
     * @SWG\Response(
     *     response=200,
     *     description="gibt ok bei erfolg, wer hätts gedacht!",
     *     @SWG\Schema(
     *        type="object",
     *        example={"{success:true}"}
     *     )
     * )
     * @SWG\Parameter(
     *     name="params",
     *     in="path",
     *     type="number",
     *     description="das zu entfernende Zitat per id angeben",
     *     @SWG\Schema(
     *        type="number",
     *        example={69}
     *     )
     * )
     */

    public function apiDeleteZitatById(Request $request, $id)
    {
        $zitate = $this->setZitate();

        array_splice($zitate, $id, 1);

        $textString = null;
        $counter1 = 0;
        while($counter1!==sizeof($zitate)){
            if($textString===null) {
                $textString = $textString . implode($zitate[$counter1], "#");
            } else {
                $textString = $textString . "#" . implode($zitate[$counter1], "#");
            }
            $counter1++;
        }
        file_put_contents("Zitate_v2.txt", $textString);

        $Res =new Response();
        $Res->setContent(json_encode([
            'success' => 'true'
        ]));

        $Res->prepare($request);
        return $Res;

    }

    /**
     * @Route("/api/v2/zitate/help", name="api_zitate_help_v2",  methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="gibt Hilfestellung für den User",
     *     @SWG\Schema(
     *        type="object",
     *        example={"{help:Geben sie all für alle ziatate ein....}"}
     *     )
     * )
     */

    public function apiHelp(Request $request)
    {
        $Res =new Response();
        $Res->setContent(json_encode([
            'help' => 'Geben Sie eine Zitat ID ( z.B. 3) oder all oder rnd oder del oder put in das mittlere Feld ein'
        ]));

        $Res->prepare($request);
        return $Res;

    }

    public function setZitate()
    {
        $zitate = [
            "0" => ["Energie", "Captain John Luc Picard", "Sternzeit 4-1-420"],
            "1" => ["Was ist das? Ein blaues Licht. Was macht es? Es leuchtet blau.", "Rambo 3", "14. Juli 1988"],
            "2" => ["Bier ist geil!", "Johann Wolfgang von Goethe", "28. August 1749 bis 22. März 1832"],
            "3" => ["Du bist zu leib für diese Welt", "Meine süße Ex", "14.02.2020"],
            "4" => ["Tag Herr Braunschweig", "Noob & Nerd WG", "10. Januar 2013"],
            "5" => ["Anders ist besser!", "Tele 5", "seit dem ich denken kann"],
            "6" => ["Dumm ist nur wer dummes tut", "Forest Gump", "13. Oktober 1994"],
            "7" => ["manus manum lavat", "Epicharmos", "* um 540 v. Chr.; † um 460 v. Chr."],

        ];

        $zitateA = file_get_contents ( 'Zitate_v2.txt' );

        $zitateFetzen = explode('#', $zitateA);
        $counter1=0;
        $counter2=0;
        $cc=0;
        $countZitate = sizeof($zitateFetzen);
        while($counter1!==$countZitate){
            while($counter2!==3){
                $zitateFinal[$cc][$counter2] = $zitateFetzen[$counter1 + $counter2];
                $counter2++;
            }
            $counter1 = $counter1+3;
            $cc++;
            $counter2 = 0;
        }



        $zitate = $zitateFinal;


        return $zitate;
    }
}
