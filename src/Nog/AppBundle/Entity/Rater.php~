<?php

namespace Nog\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Sonata\UserBundle\Entity\User;
use Nog\AppBundle\Entity\RatingType;
use Nog\AppBundle\Utils\SecurityRoles;

/**
 * Rater
 *
 * @ORM\Table("nog_raters")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks 
 */
class Rater
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Nog\AppBundle\Entity\RatingType", inversedBy="raters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ratingType;    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Rater
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ratingType
     *
     * @param \Nog\AppBundle\Entity\RatingType $ratingType
     * @return Rater
     */
    public function setRatingType(RatingType $ratingType)
    {
        $this->ratingType = $ratingType;

        return $this;
    }

    /**
     * Get ratingType
     *
     * @return \Nog\AppBundle\Entity\RatingType 
     */
    public function getRatingType()
    {
        return $this->ratingType;
    }        
    
        
    /**
     * @ORM\PrePersist
     */
    public function addUserVisorRole() 
    {
        $this->user->addRole(SecurityRoles::RATER);
    }
}
