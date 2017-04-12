<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColorSelectType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr' => array(
                'class' => 'colorselect input-small'
            )
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getBlockPrefix()
    {
        return 'colorselect';
    }
}