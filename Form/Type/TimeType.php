<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TimeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'widget' => 'single_text',
            'attr' => array('class' => 'timepicker'),
            'masked_input' => array(
                'mask' => '99:99',
                'placeholder' => ' ',
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'time';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tactics_time';
    }
}