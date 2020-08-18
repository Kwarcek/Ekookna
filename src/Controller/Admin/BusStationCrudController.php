<?php

namespace App\Controller\Admin;

use App\Entity\BusStation;
use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BusStationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BusStation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [ 
            IdField::new('id')->hideOnForm(),
            TextField::new('address'),
            TextAreaField::new('description'),
        ];
    }
}
