<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse as Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SodokuGenController extends AbstractController
{
    /**
     * @Route("/sodoku/gen", name="sodoku_gen", methods = "GET")
     */
    public function index()
    {
        return $this->render('sodoku_gen/index.html.twig', [
            'controller_name' => 'SodokuGenController',
        ]);
    }

    /**
     * @Route("/sodoku/gen/method", name="sodoku_gen_method", methods = "GET")
     */

    public function genSodoku(Request $request)
    {
        $howManyEmptyNumbers = 40;

        $feldArray = $this->fillEmpty();
        echo 'feldArray voll mit Nullen';
        $test = $this->countEmptyPositions($feldArray);
        $feldArray = $this->fillFeldWithValues($feldArray);
        echo 'feldArray voll mit Zahlen';
        $feldArray = $this->killNumbers($feldArray, $howManyEmptyNumbers);

        $response =new Response();
        $response->setContent(json_encode([
            'sudoku' => $feldArray
        ]));

        $response->prepare($request);
        return $response;
    }

    private function checkNumber($feldArray, $x, $y, $value){
        //print_r("checkNumber: ".$x.' '.$y.' '.$value);
        $counter1 = 0;
        $works = true;

        while($counter1!==9){
            if($feldArray[$x][$counter1]==$value){
                $works = false;
            }

            if($feldArray[$counter1][$y]==$value){
                $works = false;
            }

            $counter1++;
        }

        $counter1 = 0;
        if(!$works){return $works;}

        /**
         * Groups:
         *  1  2  3
         *  4  5  6
         *  7  8  9
         *
         *  012, 345, 678
         *
         *
         *             if($x != 0 & $y != 0 & $value == $feldArray[$x][$y]){
        $works = false;
        }
        if($x != 1 & $y != 0 & $value == $feldArray[$x][$y]){
        $works = false;
        }
        if($x != 2 & $y != 0 & $value == $feldArray[$x][$y]){
        $works = false;
        }
        if($x != 0 & $y != 1 & $value == $feldArray[$x][$y]){
        $works = false;
        }
        if($x != 1 & $y != 1 & $value == $feldArray[$x][$y]){
        $works = false;
        }
        if($x != 1 & $y != 2 & $value == $feldArray[$x][$y]){
        $works = false;
        }
        if($x != 0 & $y != 2 & $value == $feldArray[$x][$y]){
        $works = false;
        }
        if($x != 1 & $y != 2 & $value == $feldArray[$x][$y]){
        $works = false;
        }
        if($x != 2 & $y != 2 & $value == $feldArray[$x][$y]){
        $works = false;
        }
         */

        if($x <= 2 & $y <= 2 ){
            $group = 1;
            $works = $this->checkGroup(0, 0, $feldArray, $value);
        }
        if($x > 2 & $x <= 5 & $y > 2 & $y <= 5){
            $group = 5;
            $works = $this->checkGroup(3, 3, $feldArray, $value);
        }
        if($x > 5 & $y > 5 ){
            $group = 9;
            $works = $this->checkGroup(6, 6, $feldArray, $value);
        }
        if($x > 2 & $x <= 5 & $y <= 2){
            $group = 2;
            $works = $this->checkGroup(3, 0, $feldArray, $value);
        }
        if($x > 5 & $y <= 2){
            $group = 3;
            $works = $this->checkGroup(6, 0, $feldArray, $value);
        }
        if($x <= 2 & $y > 2 & $y <= 5){
            $group = 4;
            $works = $this->checkGroup(0, 3, $feldArray, $value);
        }
        if($x > 5 & $y > 2 & $y <= 5){
            $group = 6;
            $works = $this->checkGroup(6, 3, $feldArray, $value);
        }
        if($x <= 2 &  $y < 5){
            $group = 7;
            $works = $this->checkGroup(0, 6, $feldArray, $value);
        }
        if($x > 2 & $x <= 5 & $y < 5){
            $group = 8;
            $works = $this->checkGroup(3, 6, $feldArray, $value);
        }





        return $works;

    }

    private function checkGroup($cX, $cY, $feldArray, $value){
        $works = true;

        $counterX = 0;
        $counterY = 0;

        while($counterX != ( 2 ) ){
            while( $counterY != ( 2 ) ){
                if($feldArray[$cX + $counterX][$cY + $counterY] == $value){
                    $works = false;
                }

                $counterY++;
            }
            $counterY = 0;
            $counterX++;
        }



        return $works;
    }

    private function fillEmpty(){
        $c1 = 0;
        $c2 = 0;

        while($c1 != 9){
            while($c2 != 9){
                $feldArray[$c1][$c2] = 0;
                $c2++;
            }
            $c1++;
            $c2 = 0;
        }

        return $feldArray;
    }

    private function countEmptyPositions($feldArray){
        $count = 0;
        $c1 = 0;
        $c2 = 0;

        while($c1 != 9){
            while($c2 != 9){
                if($feldArray[$c1][$c2] == 0){
                    $count++;
                }
                $c2++;
            }
            $c1++;
            $c2 = 0;
        }
        return $count;
    }

    private function fillFeldWithValues($feldArray){

        $counterX = 0;
        $counterY = 0;
        $debug = 0;
        $used = [];

        while($counterX != 9){
            while($counterY != 9){
                $rnd = random_int(1, 9);
                $debug++;
                if($debug == 100){
                    $debug = 0;
                }
                $c1=0;

                while($c1!=count($used)){
                    if($used[$c1]==$rnd){
                        $c1=-1;
                        $rnd = random_int(1, 9);
                    }
                    $c1++;
                }


                if($this->checkNumber($feldArray, $counterX, $counterY, $rnd)){
                    $feldArray[$counterX][$counterY] = $rnd;
                    $counterY++;
                    $used[count($used)] = $rnd;

                }
            }
            $used = [];
            $counterY = 0;
            $counterX++;
        }

        return $feldArray;

    }

    private function killNumbers($feldArray, int $howManyEmptyNumbers)
    {
        while($this->countEmptyPositions($feldArray) != $howManyEmptyNumbers){
            $rndX = random_int(0, 8);
            $rndY = random_int(0, 8);
            if($feldArray[$rndX][$rndY] != 0){
                $feldArray[$rndX][$rndY] = 0;
            }
        }
        return $feldArray;
    }

}
