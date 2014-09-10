<?php

namespace Tactics\Bundle\FormBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;

class HelpTooltipTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->setAttribute('help_tooltip', $options['help_tooltip']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options) 
    {
        $view->vars['help_tooltip'] = $form->getAttribute('help_tooltip');
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions() 
    {
        return array(
            'help_tooltip' => null,
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function getExtendedType() 
    {
        return 'field';
    }
}

?>
