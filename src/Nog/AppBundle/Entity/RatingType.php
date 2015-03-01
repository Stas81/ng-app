<?php

namespace Nog\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nog\AppBundle\Entity\Rater;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RatingType
 * @ORM\Table("nog_rating_types")
 * @ORM\Entity
 */
class RatingType
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="\Nog\AppBundle\Entity\Rater", mappedBy="ratingType", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $raters;

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
     * Set name
     *
     * @param string $name
     * @return RatingType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->raters = new ArrayCollection();
    }
    
    public function __toString() 
    {
        return $this->name;
    }

    /**
     * Add raters
     *
     * @param \Nog\AppBundle\Entity\Rater $raters
     * @return RatingType
     */
    public function addRater(Rater $raters)
    {
        $this->raters[] = $raters;

        return $this;
    }

    /**
     * Remove raters
     *
     * @param \Nog\AppBundle\Entity\Rater $raters
     */
    public function removeRater(Rater $raters)
    {
        $this->raters->removeElement($raters);
    }

    /**
     * Get raters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRaters()
    {
        return $this->raters;
    }
}
