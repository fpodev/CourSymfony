<?php

namespace App\Controller;

use App\Entity\Pin;
use Doctrine\ORM\EntityManager;
use PhpParser\Builder\Interface_;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class PinsController extends AbstractController
{
          
    /**
     * @Route("/", name="app_home", methods={"GET"})
     */
    public function index(EntityManagerInterface $em): Response
    {
        
        $repo = $em->getRepository(Pin::class); 

        $pins = $repo->findAll();

        return $this->render('pins/index.html.twig', [
            'pins' => $pins,
        ]);
    }

    /**
     * @Route("/pins/create", name="app_pins_create", methods={"GET", "POST"})
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        
       $form = $this->createFormBuilder()
            ->add('title')
            ->add('description')
            ->getForm()
        ;
        return $this->render("pins/create.html.twig",['monFormulaire' => $form]);
    }
}
