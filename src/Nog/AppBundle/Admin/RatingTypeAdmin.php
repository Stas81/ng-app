<?php
namespace Nog\AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RatingTypeAdmin extends Admin
{
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Rating Type Name'));
        
        if ($this->id($this->getSubject())) {
            $formMapper
            ->add('raters', 'sonata_type_collection', array('by_reference' => true,'cascade_validation' => false), array(
                'allow_delete'=>true,
                'edit' => 'inline',
                'inline' => 'table'
                ));            
        }
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name') 
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
        ;
    }    
}
