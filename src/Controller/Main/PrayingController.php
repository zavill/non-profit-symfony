<?php


namespace App\Controller\Main;


use App\Entity\Praying;
use App\Form\PrayingType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrayingController extends BaseController
{
    /**
     * @Route("/prayer/", name="prayer")
     *
     * @return Response
     */
    public function index(): Response
    {
        $arRender = parent::renderDefault();

        $praying = new Praying();
        $form = $this->createForm(PrayingType::class, $praying);

        $arRender['form'] = $form->createView();

        return $this->render('main/prayer.html.twig', $arRender);
    }

    /**
     * Добавление заявки на молитву
     * @Route("/prayer/create", methods={"POST"})
     */
    public function createPraying()
    {

    }
}