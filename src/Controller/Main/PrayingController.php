<?php


namespace App\Controller\Main;


use App\Entity\Praying;
use App\Form\PrayingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrayingController extends BaseController
{
    /**
     * @Route("/prayer/", name="prayer")
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $arRender = parent::renderDefault();

        /* Создаём форму и обрабатываем её */
        $praying = new Praying();
        $form = $this->createForm(PrayingType::class, $praying);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->createPrayingAction($praying);
            $arRender['result'] = 'Your request has been successfully sent';

            /* Сбрасываем значения формы и создаём новую */
            unset($form, $praying);
            $praying = new Praying();
            $form = $this->createForm(PrayingType::class, $praying);
        } else if ($form->isSubmitted() && !$form->isValid()) {
            $arRender['result'] = 'Make sure that all fields of the form are filled out correctly';
        }

        $arRender['form'] = $form->createView();

        return $this->render('main/prayer.html.twig', $arRender);
    }

    /**
     * Добавление заявки на молитву
     * @param Praying $praying
     */
    public function createPrayingAction(Praying $praying)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($praying);
        $entityManager->flush();
    }
}