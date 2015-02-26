<?php

namespace Nog\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
    
    /**
     * @Route("/app/{name}", name="homepage")
     */    
    public function indexAction($name)
    {
        return $this->render('NogSiteBundle:Default:index.html.twig', array('name' => $name));
    }
}
