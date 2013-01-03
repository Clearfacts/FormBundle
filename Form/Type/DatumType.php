<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * @deprecated
 * 
 * Replaced by DateType (tactics_date)
 */
class DatumType extends DateType
{
    public function getName()
    {
        return 'datum';
    }
}