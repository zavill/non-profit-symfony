<?php


namespace App\Controller\Admin;


use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminUserController extends AdminBaseController
{

    /**
     * @Route("/admin/users", name="admin_users")
     * @return Response
     */
    public function index(): Response
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();

        $arRender = parent::renderDefault();
        $arRender['users'] = $user;
        return $this->render('admin/user/index.html.twig', $arRender);
    }

}
