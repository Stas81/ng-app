<?php

namespace Nog\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nog\AppBundle\Entity\Project;
use Nog\AppBundle\Entity\RatingType;
use Application\Sonata\UserBundle\Entity\User;

/**
 * ProjectRating
 *
 * @ORM\Table("nog_project_ratings")
 * @ORM\Entity(repositoryClass="Nog\AppBundle\Entity\ProjectRatingRepository")
 */
class ProjectRating
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
     * @ORM\ManyToOne(targetEntity="\Nog\AppBundle\Entity\Project", inversedBy="ratings")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="\Nog\AppBundle\Entity\RatingType")
     * @ORM\JoinColumn(name="rating_type_id", referencedColumnName="id")
     */
    private $ratingType;    
    
    /**
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */    
    private $rater;    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer")
     */    
    private $rating;
            
    /**
     * Get id\Application\Sonata\UserBundle\Entity\
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set project
     *
     * @param \Nog\AppBundle\Entity\Project $project
     * @return ProjectRating
     */
    public function setProject(Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Nog\AppBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set rater
     *
     * @param \Application\Sonata\UserBundle\Entity\User $rater
     * @return ProjectRating
     */
    public function setRater(User $rater)
    {
        $this->rater = $rater;

        return $this;
    }

    /**
     * Get rater
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getRater()
    {
        return $this->rater;
    }

    /**
     * Set ratingType
     *
     * @param \Nog\AppBundle\Entity\RatingType $ratingType
     * @return ProjectRating
     */
    public function setRatingType(RatingType $ratingType = null)
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
     * Set rating
     *
     * @param integer $rating
     * @return ProjectRating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }
}
