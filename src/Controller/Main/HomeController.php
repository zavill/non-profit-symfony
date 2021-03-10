<?php

namespace App\Controller\Main;

use App\Entity\Praying;
use App\Form\PrayingType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{

    /**
     * @Route("/", name="home")
     *
     * @return Response
     */

    public function index(): Response
    {
        $arRender = parent::renderDefault();

        return $this->render('main/index.html.twig', $arRender);
    }

    /**
     * @Route("/about/", name="about")
     *
     * @return Response
     */
    public function about(): Response
    {
        $arRender = parent::renderDefault();

        return $this->render('main/about.html.twig', $arRender);
    }

}