<?php

namespace App\Controller\Admin;

use App\Entity\ROOM;
use App\Form\RoomImagesType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
        TextField::new('title'),
        TextEditorField::new('description'),
        NumberField::new('price'),
        TextField::new('address'),
        TextField::new('city'),
        TextField::new('zipcode'),
        NumberField::new('capacity_min'),
        NumberField::new('capacity_max'),
        ArrayField::new('ergonomic'),
        ArrayField::new('equipment'),
        
        CollectionField::new('roomImgs')
            ->setEntryType(RoomImagesType::class)
            ->setLabel('D autres images')
    ];

        

    }
   
}
