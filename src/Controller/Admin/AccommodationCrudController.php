<?php

namespace App\Controller\Admin;

use App\Entity\Accommodation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class AccommodationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Accommodation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield Field::new('Title');
        //yield AssociationField::new('');
        yield TextEditorField::new('description');
    }
}
