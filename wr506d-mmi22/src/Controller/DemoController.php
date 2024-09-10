<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DemoController extends AbstractController
{
    #[Route('/demo', name: 'app_demo')]
    public function index(): Response
    {
	$date = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        //--test
        return $this->render('demo/index.html.twig', [
            'date' => $date,
        ]);
    }
}
