<?php
//dies ist nh änderung
// src/Controller/LuckyController.php
namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
     /**
      * @Route("/blog/{_locale}/{page}", name="blog_list", requirements={"page"="\d+", "_locale": "en|de"}, defaults={"title": "Hello world!"})
      */
    public function number(int $page,string $title, LoggerInterface $logger)
    {
        $number = random_int(0, 100);
        $logger->info($page);
        // return $this->redirect('http://youtube.com/');
        var_dump($page);
        //return $this->redirect('http://google.com/');
        return $this->render('lucky/number.html.twig', [
            'number' => $number,
            'page' => $page,
            'title' => $title
        ]);
    }

    public function list(int $page)
    {
        var_dump($page);
    }

    public function show(int $slug)
    {
        var_dump($slug);
    }
}