<?php

namespace App\Controller;

// it is called Pancake, do not change it or it breaks everything

use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


class PancakeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CommentaireRepository $commentaireRepository, Request $request): Response
{
    $comments = $commentaireRepository->findBy(['valide' => true]);
    $commentSubmitted = $request->query->get('comment_submitted', false);

    return $this->render('home/index.html.twig', [
        'comments' => $comments,
        'comment_submitted' => $commentSubmitted
    ]);
}

}
