<?php

namespace App\Controller\Main;

use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{

    /**
     * @Route("/", name="home")
     */

    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        $arRender = parent::renderDefault();

        return $this->render('main/index.html.twig', $arRender);
    }

}