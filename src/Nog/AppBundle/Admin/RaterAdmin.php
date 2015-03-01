<?php
namespace Nog\AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Doctrine\ORM\EntityRepository;

class RaterAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user', 'entity', array('class' => 'Application\Sonata\UserBundle\Entity\User'))
            ->add('ratingType', 'entity', array('class' => 'Nog\AppBundle\Entity\RatingType', 'attr'=>array('hidden' => true)));
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('ratingType')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('user')
            ->add('ratingType')    
        ;
    }
    
    public function getNewInstance() {
        $instance = parent::getNewInstance();

            $ratingTypeId  = $this->request->get('objectId', null);
            if ($ratingTypeId !== null){
                $entityManager = $this->getModelManager()->getEntityManager('Nog\AppBundle\Entity\RatingType');
                $ratingType = $entityManager->getReference('Nog\AppBundle\Entity\RatingType', $ratingTypeId);
                $instance->setRatingType($ratingType);
            }
        return $instance;
    }
}
