<?php
namespace Nog\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType
{
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nog\AppBundle\Entity\ProjectFile',
        ));
    }    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file','file', ['label' => false]);
    }
        
    public function getName()
    {
        return 'file';
    }    
}
