<?php
namespace Nog\AppBundle\Service\Traits;


trait SetEntityManagerTrait
{
    /**
     *
     * @var \Doctrine\ORM\EntityManager;
     */
    private $em;
    
    public function setEntityManager($em) 
    {
        $this->em = $em;        
    }
    
}
