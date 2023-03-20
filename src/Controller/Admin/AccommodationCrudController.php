<?php

namespace App\Controller\Admin;

use App\Admin\Field\VichImageField;
use App\Entity\Accommodation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
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
        yield VichImageField::new('imageFile');
        //yield AssociationField::new('');
        yield TextEditorField::new('slug');
        yield TextEditorField::new('description');
        yield Field::new('nbrMaxPerson');
        yield MoneyField::new('nightPrice')->setStoredAsCents(false)->setCurrency('EUR');
    }
}
