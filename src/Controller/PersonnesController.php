<?php

namespace App\Controller;

use App\Entity\Personnes;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonnesController extends AbstractController
{
    #[Route('/personnes', name: 'app_personnes')]
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $personnes = $entityManager->getRepository(Personnes::class)->findAll();
        return $this->render('personnes/index.html.twig', [
            'controller_name' => 'PersonnesController',
            'personnes' => $personnes
        ]);
    }
    #[Route('/personne/create', name: 'app_personnes')]
    public function createPersonne(ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $personne = new Personnes();
        $personne->setNom('MANSEUR');
        $personne->setPrenom('Aghiles');
        $personne->setDateDeNaissance(new \DateTimeImmutable());

        $entityManager->persist($personne);
        $entityManager->flush();
        return $this->render('personnes/index.html.twig', [
            'controller_name' => 'PersonnesController',
        ]);
    }
}
