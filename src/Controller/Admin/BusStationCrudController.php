<?php

namespace App\Controller\Admin;

use App\Entity\BusStation;
use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            BooleanField::new('readed')->hideOnForm(),
            TextField::new('address'),
            TextAreaField::new('description'),
            //ImageField::new('name')->setFormType(VichImageType::class),
        ];
    }
}
