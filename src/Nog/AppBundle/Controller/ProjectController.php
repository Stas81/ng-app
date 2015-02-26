<?php
namespace Nog\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nog\AppBundle\Form\Type\ProjectType;
use Symfony\Component\HttpFoundation\Request;
use Nog\AppBundle\Entity\Project;
use Nog\AppBundle\Entity\ProjectFile;

class ProjectController extends Controller
{
    /**
     * @Route("/project/create", name="create-project")
     * @Template()
     */    
    public function createProjectAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $project = new Project();                
            $file1 = new ProjectFile();
            $file1->setName('test');
            //$project->addFile($file1);
        
        
        $form = $this->createForm('project', $project);        
        $form->handleRequest($request);

        if ($form->isValid()) {            
            $em->persist($project);                                    
            $em->flush();
        }        
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/project/edit/{id}", name="edit-project")
     * @Template()
     */
    public function editProjectAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('NogAppBundle:Project')->findOneBy(['id' => $id]);                
        $form = $this->createForm('project', $project);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            var_dump($project);die;
            $project->upload();
            $em->flush();            
        }
        
        
        return ['form' => $form->createView()];
    }    
}
