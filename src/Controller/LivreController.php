<?php

namespace App\Controller;

use App\Services\LivreService;
use App\Entity\Livre;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Form\LivreType;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre", name="livre")
     */
    public function index(LivreService $livreService): Response
    {   
        $listeLivres = $livreService->getList();
        return $this->render('livre/index.html.twig', [
            'controller_name' => 'LivreController',
            'listeLivres'=>$listeLivres,
        ]);
    }
    /**
     * @Route("/livre/create", name="creerlivre")
     */
    public function creerLivre(LivreService $livreService,LivreType $form): Response
    {
    $form = $this->createForm(LivreType::class);
    return $this->render('livre/create.html.twig',['formulaire'=>$form->createView()]);
    }
}
