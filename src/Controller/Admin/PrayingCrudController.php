<?php

namespace App\Controller\Admin;

use App\Entity\Praying;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PrayingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Praying::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
