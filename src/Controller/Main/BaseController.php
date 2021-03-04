<?php


namespace App\Controller\Main;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    public function renderDefault(): array
    {
        return [
            'title' => 'Non-Profit Organization',
            'markup_path' => '/public/Markup/build',
        ];
    }
}