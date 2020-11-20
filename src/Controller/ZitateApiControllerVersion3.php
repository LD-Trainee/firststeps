<?php

namespace App\Controller;

use App\Entity\Zitat;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse as Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ZitateApiControllerVersion3 extends AbstractController
{
    /**
     * @Route("/api/v3/zitat/{id}", name="api_zitate_id_v3", requirements={"id"="\d+"}, methods={"GET"})
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
     * @param Request $request
     * @param int $id
     * @return object
     */

    public function apiGetZitatById(Request $request, int $id): object
    {
        $em = $this->getDoctrine()->getManager();
        $zitat = $em->getRepository(Zitat::class)->findOneBy(['id' => $id]);
        if(empty($zitat)){
            $Res = new Response();
            $Res->setContent(json_encode([
                'zitatExists' => 'false'
            ]));

            $Res->prepare($request);
            return $Res;
        }

            $Res = new Response();
            $Res->setContent(json_encode([
                'zitatText' => $zitat->getText(),
                'zitatAutor' => $zitat->getAutor(),
                'zitatZeit' => $zitat->getTime()
            ]));

            $Res->prepare($request);
            return $Res;
        }
    //}


    /**
     * @Route("/api/v3/zitat/rnd", name="api_zitate_rnd_v3", methods={"GET"})
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
        $em = $this->getDoctrine()->getManager();
        $zitate = $em->getRepository(Zitat::class)->findAll();

        if(!empty($zitate)){
            $n = random_int(0, sizeof($zitate) - 1);

            $Res = new Response();
            $Res->setContent(json_encode([
                'zitatText' => $zitate[$n]->getText(),
                'zitatAutor' => $zitate[$n]->getAutor(),
                'zitatZeit' => $zitate[$n]->getTime(),
                'zitatId' => $zitate[$n]->getId()
            ]));


        } else {
            $Res = new Response();
            $Res->setContent(json_encode([
                'zitatExists' => 'false'
            ]));
        }
        $Res->prepare($request);
        return $Res;

    }

    /**
     * @Route("/api/v3/zitat/", name="api_zitate_all_v3", methods={"GET"})
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
        $em = $this->getDoctrine()->getManager();
        $zitate = $em->getRepository(Zitat::class)->findAll();
        if(empty($zitate)){
            $zitate[0] = new Zitat();
            $zitate[0]->setText('Keine');
            $zitate[0]->setAutor('Zitate');
            $zitate[0]->setTime('gefunden!');
        }

        $counter1 = 0;
        $counter2 = 0;
        while($counter1!=sizeof($zitate)) {
            while ($counter2 != 4) {
                if ($counter2 == 0){
                    $zitateAusgabe[$counter1]['Zitattext'] = $zitate[$counter1]->getText();
                }
                if ($counter2 == 1){
                    $zitateAusgabe[$counter1]['Zitatautor'] = $zitate[$counter1]->getAutor();
                }
                if ($counter2 == 2){
                    $zitateAusgabe[$counter1]['Zitatzeit'] = $zitate[$counter1]->getTime();
                }
                if ($counter2 == 3){
                    $zitateAusgabe[$counter1]['Zitatid'] = $zitate[$counter1]->getId();
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
     * @Route("/api/v3/zitat/", name="api_zitate_put_v3", requirements={"id"="\d+"}, methods={"POST"})
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
        $data = json_decode($request->getContent());
        if(empty($data)){
            $Res =new Response();
            $Res->setContent(json_encode([
                'success' => 'false',
                'errorMessage' => 'keine json Zitatdefinition im body vorhanden'
            ]));

            $Res->prepare($request);
            return $Res;
        }
        $newZitat = $data->zitat;

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

        $zitat = new Zitat();
        $new = explode("#", $newZitat);
        $zitat->setText($new[0])->setAutor($new[1])->setTime($new[2]);

        $em = $this->getDoctrine()->getManager();
        $zitate = $em->getRepository(Zitat::class)->findAll();
        if(empty($zitate)){
            $zitat->setId(1);
            $metadata = $em->getClassMetaData(get_class($zitat));
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
            $connection = $em->getConnection();
            $connection->exec("ALTER TABLE zitat AUTO_INCREMENT = 1;");
        }


        $em->persist($zitat);
        $em->flush(); /////////////////////////////////////////////// write to database

        $Res =new Response();
        $Res->setContent(json_encode([
            'success' => 'true',
            'id' => $zitat->getId()
        ]));

        $Res->prepare($request);
        return $Res;
    }


    /**
     * @Route("/api/v3/zitat/{id}", name="api_zitate_delete_v3", requirements={"id"="\d+"}, methods={"DELETE"})
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
        $em = $this->getDoctrine()->getManager();
        $zitat = $this->getDoctrine()->getRepository(Zitat::class)->findOneBy(['id' => $id]);
        if(empty($zitat)){
            $Res =new Response();
            $Res->setContent(json_encode([
                'success' => 'false'
            ]));

            $Res->prepare($request);
            return $Res;
        }
        $em->remove($zitat);
        $em->flush(); /////////////////////////////////////////////// write to database

        $Res =new Response();
        $Res->setContent(json_encode([
            'success' => 'true'
        ]));

        $Res->prepare($request);
        return $Res;

    }

    /**
     * @Route("/api/v3/zitat/help", name="api_zitate_help_v3",  methods={"GET"})
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
            'help' => 'Geben Sie eine Zitat ID ( z.B. 3) oder all oder rnd oder del oder add in das mittlere Feld ein, die unteren Felder sind für die Parameter zu del und add.'
        ]));

        $Res->prepare($request);
        return $Res;

    }
}
