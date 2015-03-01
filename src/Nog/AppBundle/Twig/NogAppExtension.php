<?php
namespace Nog\AppBundle\Twig;

use Nog\AppBundle\Utils\ProjectStatus;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Extension
 *
 * @author develop1
 */
class NogAppExtension extends \Twig_Extension 
{
    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return array(
            'projectStatus' => new \Twig_Function_Method($this, 'projectStatus')
        );
    }

    /**
     * @param int $status
     * @return int
     */
    public function projectStatus ($status) 
    {
        if (array_key_exists($status, ProjectStatus::$statusNames)) {
            return ProjectStatus::$statusNames[$status];
        } else {
            return null;
        }
        
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'nog_app_extension';
    }
}