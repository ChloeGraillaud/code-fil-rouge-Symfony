<?php

namespace App\Tests\Integration;

use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentaireIntegrationTest extends KernelTestCase
{
    public function testAddAndValidateComment(): void
{
    self::bootKernel();
    $entityManager = self::getContainer()->get('doctrine')->getManager();
    $commentaireRepository = self::getContainer()->get(CommentaireRepository::class);

    // Ajouter un commentaire
    $commentaire = new Commentaire();
    $commentaire->setNomExpediteur('John Doe');
    $commentaire->setTexte('Ceci est un commentaire à valider.');
    $commentaire->setDateCommentaire(new \DateTime());
    $commentaire->setValide(false);

    $entityManager->persist($commentaire);
    $entityManager->flush();

    // Valider le commentaire
    $retrievedComment = $commentaireRepository->findOneBy(['nomExpediteur' => 'John Doe']);
    $retrievedComment->setValide(true);
    $entityManager->flush();

    // Vérifier la validation
    $validatedComment = $commentaireRepository->findOneBy(['nomExpediteur' => 'John Doe']);
    $this->assertTrue($validatedComment->isValide());
}

}
