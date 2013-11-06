<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class DateType
 * @package Tactics\Bundle\FormBundle\Form\Type
 */
class DateType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['format'] = $options['format'];
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'widget' => 'single_text',
                'widget_addon' => array(
                    'append'
                ),
                'format' => 'dd/MM/yyyy',
                'masked_input' => array(
                    'mask' => '99/99/9999',
                    'placeholder' => ' ',
                )
            ))
            ->setAllowedValues(array(
                'widget' => array('single_text')
            ))
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'date';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'tactics_date';
    }
}