<?php


namespace App\Controller\Main;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DonateController extends BaseController
{

    /**
     * @Route("/donate/", name="donate")
     *
     * @return Response
     */
    public function index(): Response
    {
        $arRender = parent::renderDefault();

        //$arRender['stripe_key'] = $_ENV['STRIPE_KEY'];

        return $this->render('main/donate.html.twig', $arRender);
    }

}
