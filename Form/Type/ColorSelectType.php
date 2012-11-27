<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ColorSelectType extends AbstractType
{
    public function getDefaultOptions(array $options)
    {
        return array(
                'attr' => array(
                    'class' => 'colorselect input-small'
                )
            );
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'colorselect';
    }
}