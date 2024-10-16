<?php

namespace App\Controller\Admin;

use App\Entity\ROOM;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ROOMCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ROOM::class;
    }

 
    public function configureFields(string $pageName): iterable
    {
        return [
          //  IdField::new('id')->setFormTypeOption('disabled', true),
            TextField::new(propertyName: 'title'),
            TextEditorField::new('description'),
            NumberField::new('price'),
            TextField::new(propertyName: 'address'),

            TextField::new(propertyName: 'city'),

            TextField::new(propertyName: 'zipcode'),

            NumberField::new(propertyName: 'capacity_min'),

            NumberField::new(propertyName: 'capacity_max'),
            //ArrayField::new(propertyName: 'ergonomic'),

            //ArrayField::new(propertyName: 'equipment'),

            ImageField::new('image')
            ->setBasePath('public/images') 
            ->setUploadDir('public/images') 
            ->setUploadedFileNamePattern('[randomhash].[extension]') 
            ->setRequired(false),

            //DateField::new(propertyName: 'created_at'),


        ];
    }
   
}
