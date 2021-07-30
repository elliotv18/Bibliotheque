<?php 
namespace App\Services;

use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;

class LivreService
{
    private $_entityManager = [];
    private $_listeLivre = [];

    function __construct(EntityManagerInterface $em)
    {
        $this->_entityManager = $em;
        $this->_listeLivre = $this->_entityManager->getRepository(Livre::class)->findAll();
    }
    
function getList()
    {
        return $this->_listeLivre;
    }
    function addLivre($pLivre)
    {
        array_push($this->_listeLivre,$pLivre);
        $this->_entityManager->persist($pLivre);
        $this->_entityManager->flush();
    }
    public function getLivre($pId)
    {
         $find = false;
         $livre = $this->_entityManager->getRepository(Livre::class)->find($pId);
         if (isset($livre))
             $find = true;
         return  ['found'=>$find,'livre'=>$livre];
     }
     public function delLivre($pId)
    {
        $livre = $this->getLivre($pId);
        if ($livre['found']== true)
        {
            $this->_entityManager->remove($livre['livre']);
            $this->_entityManager->flush();
        }
        
    }
    
}