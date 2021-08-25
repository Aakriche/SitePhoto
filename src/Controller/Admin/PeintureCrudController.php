<?php

namespace App\Controller\Admin;

use App\Entity\Peinture;
use Cassandra\Time;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

use Vich\UploaderBundle\Form\Type\VichImageType;

class PeintureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Peinture::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            TextareaField::new('description')->hideOnIndex(),
            NumberField::new('largeur')->hideOnIndex(),
            NumberField::new('hauteur')->hideOnIndex(),
            DateField::new('dateRealisation'),
            AssociationField::new('categorie'),
            NumberField::new('prix')->hideOnIndex(),
            BooleanField::new('enVente'),
            BooleanField::new('portfolio'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->onlyWhenCreating(),
            ImageField::new('file')->setBasePath('/uploads/peintures/')->onlyOnIndex(),
            SlugField::new('slug')->setTargetFieldName('nom')->hideOnIndex(),

        ];

    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC']);
    }
}

