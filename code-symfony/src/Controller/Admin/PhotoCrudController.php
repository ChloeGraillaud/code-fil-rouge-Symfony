<?php

// src/Controller/Admin/PhotoCrudController.php

namespace App\Controller\Admin;

use App\Entity\Photo;
use App\Entity\Service;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField; 
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Photo')
            ->setEntityLabelInPlural('Photos');
    }

    public function configureFields(string $pageName): iterable
{
    return [
        IdField::new('id')->onlyOnIndex(),
        TextField::new('altText', 'Texte alternatif'),
        ImageField::new('url', 'Image')
            ->setBasePath('')
            ->setUploadDir('public') 
            ->setRequired(true),
        AssociationField::new('service', 'Service')
            ->setRequired(true)
            ->setFormTypeOption('choice_label', 'description')
            ->formatValue(function ($value, $entity) {
                return $entity->getService()->getDescription();
            }),
        AssociationField::new('categorie', 'Catégorie')
            ->setRequired(true)
            ->setFormTypeOption('choice_label', 'nom')
            ->formatValue(function ($value, $entity) {
                return $entity->getCategorie()->getNom();
            }),
    ];
}


    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Sauvegarder l'image uploadée
        if ($entityInstance instanceof Photo) {
            $photoFile = $entityInstance->getUrl();

            if ($photoFile instanceof UploadedFile) {
                // Générer un nom unique pour le fichier
                $photoFileName = uniqid() . '.' . $photoFile->guessExtension();
                // Déplacer le fichier dans le répertoire public/uploads/photos
                $photoFile->move($this->getParameter('photos_directory'), $photoFileName);
                // Mettre à jour l'URL de l'image dans l'entité
                $entityInstance->setUrl($photoFileName);
            }
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Supprimer l'image physique du disque lors de la suppression
        if ($entityInstance instanceof Photo) {
            $filesystem = new Filesystem();
            $filesystem->remove($this->getParameter('photos_directory') . '/' . $entityInstance->getUrl());
        }

        parent::deleteEntity($entityManager, $entityInstance);
    }
}
