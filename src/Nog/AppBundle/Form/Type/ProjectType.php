<?php
namespace Nog\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType
{
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nog\AppBundle\Entity\Project',
        ));
    }    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('files', 'collection', 
                    array('type' => new FileType(), 
                        'allow_add' => true, 
                        'by_reference' => false,
                        ))
            ->add('save', 'submit');
    }
        
    public function getName()
    {
        return 'project';
    }
}