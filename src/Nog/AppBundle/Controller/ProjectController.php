<?php
namespace Nog\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use JMS\DiExtraBundle\Annotation as DI;
use Nog\AppBundle\Entity\RatingType;


class ProjectController extends Controller
{
    /**
     * @var \Nog\AppBundle\Service\ProjectManager
     * @DI\Inject("nogapp.project.manager")
     */    
    private $projectManager;

    /**
     * @var \Nog\AppBundle\Service\RatingManager
     * @DI\Inject("nogapp.rating.manager")
     */    
    private $ratingManager;
    
    /**
     * @Route("/project/create", name="create-project")
     * @Template()
     */    
    public function createAction(Request $request)
    {                
        $project = $this->projectManager->createProject();        
        if (!$project) {
            throw new AccessDeniedException();
        }        
        $form = $this->createForm('project', $project);        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->projectManager->updateProject($project);
        }
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/project/edit/{id}", name="edit-project")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        
        $project = $this->projectManager->getProjectForEditById($id);
        if (!$project) {
            throw new NotFoundHttpException("Project::Id => $id not found. Or you cannot edit it.");
        }        
        $form = $this->createForm('project', $project);        
        $form->handleRequest($request);
        if ($form->isValid()) {            
            $this->projectManager->updateProject($project);            
        }        
        return ['form' => $form->createView()];
    }
    
    
    /**
     * @Route("/test", name="delete-project")
     * @Template()
     */
    public function removeAction(Request $request) 
    {
        $project = $this->projectManager->getProjectForViewById(6);
        $result = $this->projectManager->getProjectsWithRating($project);
        var_dump($result);
        die;
    }
    
    
    /**
     * @Route("/project/view/{id}", name="view-project")
     * @Template()
     */
    public function viewAction($id)
    {
        $project = $this->projectManager->getProjectForViewById($id);
        if (!$project) {
            throw new NotFoundHttpException("Project::Id => $id not found. Or you cannot view it.");
        }        
        $result['project'] = $project;
        if($this->projectManager->userCanRateProject()){
            $ratingTypes = $this->ratingManager->getRatingTypes();
            $result['rating']['types'] = $ratingTypes;
            $result['rating']['rates'] = [1, 2, 3];
        }
        return $result;
    }        
    
    
    /**
     * @Route("/project/list", name="list-projects")
     * @Template()
     */
    public function listAction() 
    {
        $projects = $this->projectManager->getProjectList();
        if (!$projects) {
            throw new NotFoundHttpException("Not found.");
        }
        return ['projects' => $projects];
    }
    
}
