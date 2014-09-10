<?php

namespace Tactics\Bundle\FormBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;

class SupportTextTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->setAttribute('support_text', $options['support_text']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options) 
    {
        $view->vars['support_text'] = $form->getAttribute('support_text');
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions() 
    {
        return array(
            'support_text' => null,
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
