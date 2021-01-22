<?php

namespace App\Controller\Admin;

use App\Entity\Song;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class SongCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Song::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre du mix'),
            TextField::new('thumbnail', 'Nom de l\'image'),
            TextField::new('file_name', 'Nom du fichier + Extension'),
            TextareaField::new('thumbnail_description', 'Description de l\'image'),
            AssociationField::new('genre', 'Genre du mix'),
            IntegerField::new('duration', 'Durée du mix (min)'),
            ImageField::new('imageFile', 'Ajouter un thumbnail en BDD')->setFormType(VichImageType::class)->hideOnIndex(),
            TextareaField::new('mixFile', 'Ajouter un mix en BDD')->setFormType(VichFileType::class)->hideOnIndex(),
        ];
    }
}
