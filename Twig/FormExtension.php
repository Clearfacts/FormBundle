<?php

namespace Tactics\Bundle\FormBundle\Twig;

class FormExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Constructor
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @inheritDoc
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('form_save_cancel', [$this, 'renderButtons'], array('is_safe' => array('html')))
        );
    }

    /**
     * Render a save and cancel button.
     */
    public function renderButtons()
    {
        return $this->twig->render('TacticsFormBundle:Extension:buttons.html.twig');
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'tactics_form';
    }
}
