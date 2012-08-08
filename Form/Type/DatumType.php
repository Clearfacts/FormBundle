<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DatumType extends AbstractType
{
    public function getDefaultOptions(array $options)
    {
        return array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'class' => 'datepicker'
                ),
                'masked_input' => array(
                  'mask' => '99/99/9999',
                  'placeholder' => ' ',
                )
            );
    }

    public function getParent()
    {
        return 'date';
    }

    public function getName()
    {
        return 'datum';
    }
}