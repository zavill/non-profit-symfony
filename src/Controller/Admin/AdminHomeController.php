<?php


namespace App\Controller\Admin;

use App\Entity\Praying;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AdminBaseController
{
    /**
     * @Route("/admin", name="admin_home")
     */

    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        $arRender = parent::renderDefault();

        $arRender['praying'] = $this->getPrayersAction();

        return $this->render('admin/index.html.twig', $arRender);
    }

    /**
     * Получение всех запросов на молитвы
     *
     * @return Praying[]|object[]
     */
    public function getPrayersAction(): array
    {
        return $this->getDoctrine()->getRepository(Praying::class)->findBy([], ['id' => 'DESC']);
    }
}