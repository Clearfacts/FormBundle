<?php

namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class DateTimeType
 * @package Tactics\Bundle\FormBundle\Form\Type
 */
class DateTimeType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['date_options'] = $options['date_options'];
        $view->vars['time_options'] = $options['time_options'];
        $view->vars['format'] = $options['format'];
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'date_format' => 'dd/MM/yyyy',
            'date_widget' => 'single_text',
            'time_widget' => 'single_text',
            'date_options' => array(
                'masked_input' => array(
                    'mask' => '99/99/9999',
                    'placeholder' => ' ',
                ),
                'format' => 'dd/MM/yyyy'
            ),
            'show_child_legend' => false,
            'time_options' => array(
                'masked_input' => array(
                    'mask' => '99:99',
                    'placeholder' => ' ',
                )
            ),
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'datetime';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'tactics_datetime';
    }
}