<?php

namespace App\Controller;

use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentFormController extends AbstractController
{
    #[Route('/add-comment', name: 'add_comment', methods: ['POST'])]
    public function addComment(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nomExpediteur = $request->request->get('nom');
        $texte = $request->request->get('message');

        // Vérification des champs requis
        if ($nomExpediteur && $texte) {
            $commentaire = new Commentaire();
            $commentaire->setNomExpediteur($nomExpediteur);
            $commentaire->setTexte($texte);
            $commentaire->setDateCommentaire(new \DateTime());
            $commentaire->setValide(false); // En attente de validation

            $entityManager->persist($commentaire);
            $entityManager->flush();

            // Redirection pour éviter la double soumission
            return $this->redirectToRoute('home', [
                'comment_submitted' => true,
            ]);
        }

        // Si les champs sont manquants, redirige avec un message d'erreur
        return $this->redirectToRoute('home', [
            'error' => 'Tous les champs sont requis.',
        ]);
    }
}
