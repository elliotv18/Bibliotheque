<?php 
namespace App\Services;

use App\Entity\Auteur;
use Doctrine\ORM\EntityManagerInterface;

class AuteurService
{
    private $_entityManager = [];
    private $_listeAuteur = [];

    function __construct(EntityManagerInterface $em)
    {
        $this->_entityManager = $em;
        $this->_listeAuteur = $this->_entityManager->getRepository(Auteur::class)->findAll();
    }
    
function getList()
    {
        return $this->_listeAuteur;
    }
    function addAuteur($pAuteur)
    {
        array_push($this->_listeAuteur,$pAuteur);
        $this->_entityManager->persist($pAuteur);
        $this->_entityManager->flush();
    }
    public function getAuteur($pId)
    {
         $find = false;
         $auteur = $this->_entityManager->getRepository(Auteur::class)->find($pId);
         if (isset($auteur))
             $find = true;
         return  ['found'=>$find,'auteur'=>$auteur];
     }
     public function delAuteur($pId)
    {
        $auteur = $this->getAuteur($pId);
        if ($auteur['found']== true)
        {
            $this->_entityManager->remove($auteur['auteur']);
            $this->_entityManager->flush();
        }
        
    }
    
}