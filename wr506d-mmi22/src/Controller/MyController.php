<?php

namespace App\Controller;

use App\Services\MyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class MyController extends AbstractController
{
    public function index(MyService $myService)
    {
        $result = $myService->doSomething();
    }
}
