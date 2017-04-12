<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RijksregisternummerType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'masked_input' => array(
                'mask' => '99.99.99-999.99',
                'placeholder' => ' ',
            ),
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getBlockPrefix()
    {
        return 'rijksregisternummer';
    }
}