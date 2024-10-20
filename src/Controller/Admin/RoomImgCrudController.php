<?php

namespace App\Controller\Admin;

use App\Entity\RoomImg;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RoomImgCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RoomImg::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('imageName', 'Name'),
            AssociationField::new('Room') 

           
        ];
    }
   
}
