<?php
namespace Tactics\Bundle\FormBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;

class MaskedInputTypeExtension extends AbstractTypeExtension
{
    /**
     * Builds the form.
     *
     * This method gets called after the extended type has built the form to
     * further modify it.
     *
     * @see FormTypeInterface::buildForm()
     *
     * @param FormBuilder $builder The form builder
     * @param array       $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('masked_input', $options['masked_input']);
    }

    /**
     * Builds the view.
     *
     * This method gets called after the extended type has built the view to
     * further modify it.
     *
     * @see FormTypeInterface::buildView()
     *
     * @param FormView      $view The view
     * @param FormInterface $form The form
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->set('masked_input', $form->getAttribute('masked_input'));
    }

    /**
     * Overrides the default options form the extended type.
     *
     * @param array $options
     *
     * @return array
     */
    public function getDefaultOptions()
    {
        return array(
            'masked_input' => null,
        );
    }
    
    /**
     * Returns the name of the type being extended
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return 'text';
    }
}