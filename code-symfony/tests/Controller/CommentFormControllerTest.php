<?php

namespace App\Tests\Controller;

use App\Controller\CommentFormController;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CommentFormControllerTest extends TestCase
{
    public function testAddCommentWithValidData(): void
    {
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $entityManagerMock->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Commentaire::class));
        $entityManagerMock->expects($this->once())
            ->method('flush');

        $request = new Request([], [
            'nom' => 'John Doe',
            'message' => 'Ceci est un test unitaire.',
        ]);

        $controller = new CommentFormController();
        $response = $controller->addComment($request, $entityManagerMock);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertSame('/home?comment_submitted=1', $response->getTargetUrl());
    }

    public function testAddCommentWithMissingData(): void
    {
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);

        $request = new Request([], [
            'nom' => 'John Doe',
            // Pas de message ici
        ]);

        $controller = new CommentFormController();
        $response = $controller->addComment($request, $entityManagerMock);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertSame('/home?error=Tous%20les%20champs%20sont%20requis.', $response->getTargetUrl());
    }
}
