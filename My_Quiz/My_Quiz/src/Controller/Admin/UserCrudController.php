<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            
            IdField::new('id')->hideOnForm(),
            EmailField::new('username'),
            TextField::new('pseudo'),
            ChoiceField::new('roles')
                    ->allowMultipleChoices()
                    ->autocomplete()
                    ->setChoices([  'User' => 'ROLE_USER',
                                    'Admin' => 'ROLE_ADMIN',]
        ),
            TextField::new('password'),
            BooleanField::new('isVerified'),
            DateTimeField::new('createat')->hideOnForm(),
            DateTimeField::new('updateat')->hideOnForm()
           
           
             
            
        ];
      
     
       
    
    }
   


}

