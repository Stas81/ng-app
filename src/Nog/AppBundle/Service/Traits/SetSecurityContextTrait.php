<?php
namespace Nog\AppBundle\Service\Traits;

trait SetSecurityContextTrait
{
    private $securityContext;    
       
    public function setSecurityContext($securityContext) 
    {
        $this->securityContext = $securityContext;
    }    

}
