<?php
namespace Tactics\Bundle\FormBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MaskedDateTypeExtension
 * @package Tactics\Bundle\FormBundle\Form\Extension
 */
class MaskedDateTypeExtension extends AbstractTypeExtension
{
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
        if (isset($options['masked_input']) && $options['masked_input']) {
            $view->vars['masked_input'] = $options['masked_input'];
        }

        if (isset($options['format']) && $options['format']) {
            $view->vars['format'] = $options['format'];
        }
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'masked_input' => null,
            'format' => 'dd/MM/yyyy',
        ));

    }

    /**
     * Returns the name of the type being extended
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return DateType::class;
    }
}
