<?php
namespace Nog\AppBundle\Service;

use Nog\AppBundle\Entity\Project;
use Nog\AppBundle\Utils\ProjectStatus;
use Application\Sonata\UserBundle\Entity\User;

class RatingManager 
{
    use \Nog\AppBundle\Service\Traits\SetEntityManagerTrait;
    use \Nog\AppBundle\Service\Traits\SetSecurityContextTrait;
    
    public function getRatingTypes() 
    {
        $repo = $this->em->getRepository('NogAppBundle:RatingType');
        return $repo->findAll();
    }
    
}
