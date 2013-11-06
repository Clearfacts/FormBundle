<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateTimeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'date_format' => 'dd/MM/yyyy',
            'date_widget' => 'single_text',
            'time_widget' => 'single_text',
            'attr' => array(
                'class' => 'tactics_datetime'
            ),
            'date_options' => array(
                'masked_input' => array(
                    'mask' => '99/99/9999',
                    'placeholder' => ' ',
                )
            ),
            'time_options' => array(
                'masked_input' => array(
                    'mask' => '99:99',
                    'placeholder' => ' ',
                )
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'datetime';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tactics_datetime';
    }
}