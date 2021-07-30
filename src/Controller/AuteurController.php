<?php

namespace App\Controller;
use App\Services\AuteurService;
use App\Entity\Auteur;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Form\AuteurType;
use Symfony\Component\Form\FormTypeInterface;

class AuteurController extends AbstractController
{
    /**
     * @Route("/auteur", name="auteur")
     */
    public function index(AuteurService $auteurService): Response
    {   
        $listeAuteurs = $auteurService->getList();
        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
            'listeAuteurs'=>$listeAuteurs,
        ]);
    }


    /**
     * @Route("/auteur/create", name="creerauteur")
     */
    public function creerAuteur(AuteurService $auteurService,AuteurType $form): Response
    {
    $form = $this->createForm(AuteurType::class);
    return $this->render('auteur/create.html.twig',['formulaire'=>$form->createView()]);
    }
}
