<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends AbstractController
{
    #[Route('/galerie', name:'app_galerie')]
    public function index(PhotoRepository $photoRepository): Response
    {
        
        $photos = $photoRepository->findAll();

        
        return $this->render('gallery/galerie.html.twig', [
            'photos' => $photos,
        ]);
    }
}