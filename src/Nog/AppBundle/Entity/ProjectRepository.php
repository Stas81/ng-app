<?php

namespace Nog\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Application\Sonata\UserBundle\Entity\User;
use Nog\AppBundle\Entity\RatingType;
use Nog\AppBundle\Entity\Project;

class ProjectRepository extends EntityRepository
{
    public function findProjectsByAuthor(User $author, $offset = 0, $limit = 10) 
    {
        $result = $this->getEntityManager()->createQuery(
                'SELECT p FROM NogAppBundle:Project p
                    WHERE p.author = :author 
                    ORDER BY p.dateCreated DESC'
                )->setParameter('author', $author)
                ->setFirstResult($offset)
                ->setMaxResults($limit)
                ->getResult();
        return $result;
    }
    
    public function findProjects($offset = 0, $limit = 10)
    {
        $result = $this->getEntityManager()->createQuery(
                'SELECT p FROM NogAppBundle:Project p
                    ORDER BY p.dateCreated DESC'
                )
                ->setFirstResult($offset)
                ->setMaxResults($limit)                
                ->getResult();
        return $result;
    }
    
    public function findProjectsWithRatingsByAuthor(User $author, $offset = 0, $limit = 10)
    {
        $result = $this->em->createQuery(
                'SELECT p as project, AVG(r.rating) as rating FROM NogAppBundle:Project p
                    LEFT JOIN NogAppBundle:ProjectRating r WITH p = r.project
                    WHERE p.author = :author 
                    GROUP BY p
                    ORDER BY p.dateCreated DESC'
                )->setParameter('author', $author)
                ->setFirstResult($offset)
                ->setMaxResults($limit)                
                ->getResult();
        return $result;
    }    
    
    
    public function findProjectsWithRatings($offset = 0, $limit = 10)
    {
        $result = $this->em->createQuery(
                'SELECT p as project, AVG(r.rating) as rating FROM NogAppBundle:Project p
                    LEFT JOIN NogAppBundle:ProjectRating r WITH p = r.project                    
                    GROUP BY p
                    ORDER BY p.dateCreated DESC'
                )
                ->setFirstResult($offset)
                ->setMaxResults($limit)                
                ->getResult();
        return $result;
    }
    
    
}
