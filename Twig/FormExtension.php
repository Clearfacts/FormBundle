<?php

namespace Tactics\Bundle\FormBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class FormExtension extends \Twig_Extension
{
   /**
    * @var Symfony\Component\DependencyInjection\ContainerInterface
    */
    protected $container;

    /**
     * Constructor
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritDoc
     */
    public function getFunctions()
    {
        return array(
            'form_save_cancel' => new \Twig_Function_Method(
                $this,
                'renderButtons',
                array('is_safe' => array('html'))
            )
        );
    }

    /**
     * Render a save and cancel button.
     */
    public function renderButtons()
    {
        return $this->container->get('templating')->render('TacticsFormBundle:Extension:buttons.html.twig');
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'tactics_form';
    }
}
