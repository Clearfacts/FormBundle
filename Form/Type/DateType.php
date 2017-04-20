<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
    public function configureOptions(OptionsResolver $resolver)
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
            ->setAllowedValues(
                'widget' , array('single_text')
            )
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return \Symfony\Component\Form\Extension\Core\Type\DateType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getBlockPrefix()
    {
        return 'tactics_date';
    }
}