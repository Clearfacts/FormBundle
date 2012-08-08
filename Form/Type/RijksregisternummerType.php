<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RijksregisternummerType extends AbstractType
{
    public function getDefaultOptions(array $options)
    {
        return array(
            'masked_input' => array(
                'mask' => '99.99.99-999.99',
                'placeholder' => ' ',
            ),
        );
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'rijksregisternummer';
    }
}