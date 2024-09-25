<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Cocur\Slugify\Slugify;

class DemoController extends AbstractController
{
    #[Route('/demo', name: 'app_demo')]
    public function index(): Response
    {
        $timezone = new \DateTimeZone('Europe/Paris');
        $now = new \DateTime('now', $timezone);

        // Définir la localisation en français
        setlocale(LC_TIME, 'fr_FR.UTF-8');

        $slug = new Slugify();
        $textSlugified = $slug->slugify('Do the harlem shake', ["separator" => " "]);

        return $this->render('demo/index.html.twig', [
            'controller_name' => 'DemoController',
            'current_day' => strftime('%A', $now->getTimestamp()), // Jour de la semaine en français
            'current_dayN' => $now->format('d'), // Date au format AAAA-MM-JJ
            'current_month' => strftime('%B', $now->getTimestamp()), // Mois en français
            'current_time' => $now->format('H:i:s'), // Heure au format HH:MM:SS
            'textSlugified' => $textSlugified
        ]);
    }
}
