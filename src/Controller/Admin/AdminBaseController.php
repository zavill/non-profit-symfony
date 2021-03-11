<?php


namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminBaseController extends AbstractController
{
    public function renderDefault(): array
    {
        return [
            'title' => 'New Mount Sinai Baptist Church Admin Panel'
        ];
    }
}