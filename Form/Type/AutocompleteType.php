<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AutocompleteType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $repo = $this->manager
            ->getRepository($options['class'])
        ;

        $view->vars['object'] = $repo->find($view->vars['value']);
        $view->vars['route'] = $options['route'];
        $view->vars['route_params'] = $options['route_params'];
        $view->vars['method'] = $options['method'];
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array(
            'route',
            'class'
        ))
        ->setOptional(array(
            'route_params',
        ))
        ->setDefaults(array(
            'route_params' => array(),
            'method' => null,
            'attr' => array(
                'style' => 'display: none;'
            )
        ))
        ->setAllowedTypes(array(
            'route_params' => 'array'
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'autocomplete';
    }
}