<?php
namespace Nog\AppBundle\Service;

use Nog\AppBundle\Entity\Project;
use Nog\AppBundle\Entity\RatingType;
use Nog\AppBundle\Utils\ProjectStatus;
use Nog\AppBundle\Utils\SecurityRoles;
use Application\Sonata\UserBundle\Entity\User;

class ProjectManager 
{
    use \Nog\AppBundle\Service\Traits\SetEntityManagerTrait;
    use \Nog\AppBundle\Service\Traits\SetSecurityContextTrait;
    
    /**
     * @param User $user
     * @return Project
     */
    public function createProject()
    {
        $user = $this->securityContext->getToken()->getUser();        
        
        if ($user instanceof User && $user->hasRole(SecurityRoles::USER)){
            $newProject = new Project();
            $newProject->setDateCreated(new \DateTime());        
            $newProject->setAuthor($user);
            $newProject->setStatus(ProjectStatus::PROJECT_CREATED);
        } else {
            $newProject = null;
        }
        return $newProject;
    }
    
    /**
     * @param Project $project
     */
    public function updateProject(Project $project) 
    {
        if (!$project->getId()){
            $this->em->persist($project);
        }        
        $this->em->flush();
    }
    
    
    /**
     * @param integer $projectId
     * @return Project
     * @throws \Exception
     */
    public function getProjectForEditById($projectId)
    {
        $user = $this->securityContext->getToken()->getUser();
        if (!$user instanceof User){
            return null;
        }        
        
        $projectRepo = $this->em->getRepository('NogAppBundle:Project');
        $project = $projectRepo->findOneBy(['id' => $projectId]);                
        
        if (!$project instanceof Project) {
            return null;
        }
        
        if ($project->getStatus() !== ProjectStatus::PROJECT_CREATED) {
            throw new 
                \Exception("Project cannot be edited. It has non-editable status.");
        }
         
        if ($this->userCanEditProject($user, $project)) {
                return $project;
        } else {
                return null;
        }
    }
    
    /**
     * 
     * @param integer $projectId
     * @return Project
     */
    public function getProjectForViewById($projectId)
    {
        $user = $this->securityContext->getToken()->getUser();
        if (!$user instanceof User){
            return null;
        }        
        
        $projectRepo = $this->em->getRepository('NogAppBundle:Project');
        $project = $projectRepo->findOneBy(['id' => $projectId]);
        
        if (!$project instanceof Project) {
            return null;
        }
        
        if ($this->userCanViewProject($user, $project)) {
                return $project;
        } else {
                return null;
        }
    }
    
    /**
     * @param User $user
     * @param Project $project
     * @return boolean
     */
    public function userCanEditProject(User $user, Project $project) 
    {
        $result = false;
        
        if ($project->getAuthor() == $user ||
            $user->hasRole(SecurityRoles::VISOR) ||
            $user->hasRole(SecurityRoles::RATER) ||
            $user->hasRole(SecurityRoles::ADMIN) ||
            $user->hasRole(SecurityRoles::SUPER_ADMIN)) {
            $result = true;
        }
        return $result;
    }
    
    
    /**
     * @param User $user
     * @param Project $project
     * @return boolean
     */
    public function userCanViewProject(User $user, Project $project) 
    {
        $result = false;
        
        if ($project->getAuthor() == $user ||
            $user->hasRole(SecurityRoles::VISOR) ||
            $user->hasRole(SecurityRoles::RATER) ||
            $user->hasRole(SecurityRoles::ADMIN) ||
            $user->hasRole(SecurityRoles::SUPER_ADMIN)) {
            $result = true;
        }
        return $result;
    }
    
    /**
     * 
     * @param User $user
     * @param RatingType $ratingType
     * @return boolean
     */
    public function userCanRateProject(RatingType $ratingType = null)
    {
        $user = $this->securityContext->getToken()->getUser();
        $result = false;
        if (!$ratingType) {
            $result = $user->hasRole(SecurityRoles::RATER) || 
                    $user->hasRole(SecurityRoles::ADMIN) || 
                    $user->hasRole(SecurityRoles::SUPER_ADMIN);
        } else {
            $ratersRepo = $this->em->getRepository('NogAppBundle:Rater');
            $rater = $ratersRepo
                    ->findOneBy(['user' => $user, 'ratingType' => $ratingType]);
            $result = (($rater == null)? false : true) || 
                    $user->hasRole(SecurityRoles::ADMIN) || 
                    $user->hasRole(SecurityRoles::SUPER_ADMIN);
        }
        return $result;
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getProjectList() 
    {
        $user = $this->securityContext->getToken()->getUser();
        if (!$user instanceof User) {
            return null;
        }        
        $returnAllProjects = $user->hasRole(SecurityRoles::VISOR) || 
                    $user->hasRole(SecurityRoles::RATER) || 
                    $user->hasRole(SecurityRoles::ADMIN) || 
                    $user->hasRole(SecurityRoles::SUPER_ADMIN);
        $projectRepo = $this->em->getRepository('NogAppBundle:Project');
                
        if ($returnAllProjects) {
            $result = $projectRepo->findProjects();
        } else {
            $result = $projectRepo->findProjectsByAuthor($user);
        }
        return $result;
    }
}
