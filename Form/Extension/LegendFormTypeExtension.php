<?php

namespace Tactics\Bundle\FormBundle\Form\Extension;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

/**
 * Class LegendFormTypeExtension
 * @package Tactics\Bundle\FormBundle\Form\Extension
 */
class LegendFormTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['render_fieldset'] = $options['render_fieldset'];
        $view->vars['show_legend'] = $options['show_legend'];
        $view->vars['show_child_legend'] = $options['show_child_legend'];
        $view->vars['label_render'] = $options['label_render'];
        $view->vars['label_class'] = $options['label_class'];
        $view->vars['render_required_asterisk'] = $options['render_required_asterisk'];
        $view->vars['render_optional_text'] = $options['render_optional_text'];
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'render_fieldset' => true,
            'show_legend' => false,
            'show_child_legend' => true,
            'label_render' => true,
            'label_class' => 'col-xs-2 col-sm-2 col-md-2 col-lg-2',
            'render_required_asterisk' => true,
            'render_optional_text' => true,
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getExtendedType()
    {
        return 'form';
    }
}
