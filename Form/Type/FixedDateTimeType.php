<?php
namespace Tactics\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DataTransformerChain;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToArrayTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToLocalizedStringTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToTimestampTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToRfc3339Transformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\ArrayToPartsTransformer;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Overrides the symfony DateTimeType with two additional widget options: 
 * time_options and date_options.
 * 
 * Symfony PR needed...
 *
 * @author Gert Vrebos <gert.vrebos at tactics.be>
 */
class FixedDateTimeType extends \Symfony\Component\Form\Extension\Core\Type\DateTimeType {

    private static $acceptedFormats = array(
        \IntlDateFormatter::FULL,
        \IntlDateFormatter::LONG,
        \IntlDateFormatter::MEDIUM,
        \IntlDateFormatter::SHORT,
    );
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $parts = array('year', 'month', 'day', 'hour', 'minute');
        $dateParts = array('year', 'month', 'day');
        $timeParts = array('hour', 'minute');

        if ($options['with_seconds']) {
            $parts[] = 'second';
            $timeParts[] = 'second';
        }

        $dateFormat = is_int($options['date_format']) ? $options['date_format'] : self::DEFAULT_DATE_FORMAT;
        $timeFormat = self::DEFAULT_TIME_FORMAT;
        $calendar = \IntlDateFormatter::GREGORIAN;
        $pattern = is_string($options['format']) ? $options['format'] : null;

        if (!in_array($dateFormat, self::$acceptedFormats, true)) {
            throw new InvalidOptionsException('The "date_format" option must be one of the IntlDateFormatter constants (FULL, LONG, MEDIUM, SHORT) or a string representing a custom format.');
        }

        if ('single_text' === $options['widget']) {
            if (self::HTML5_FORMAT === $pattern) {
                $builder->addViewTransformer(new DateTimeToRfc3339Transformer(
                    $options['model_timezone'],
                    $options['view_timezone']
                ));
            } else {
                $builder->addViewTransformer(new DateTimeToLocalizedStringTransformer(
                    $options['model_timezone'],
                    $options['view_timezone'],
                    $dateFormat,
                    $timeFormat,
                    $calendar,
                    $pattern
                ));
            }
        } else {
            // Only pass a subset of the options to children
            $dateOptions = array_merge(array_intersect_key($options, array_flip(array(
                'years',
                'months',
                'days',
                'empty_value',
                'required',
                'translation_domain',
            ))), $options['date_options']);

            $timeOptions = array_merge(array_intersect_key($options, array_flip(array(
                'hours',
                'minutes',
                'seconds',
                'with_seconds',
                'empty_value',
                'required',
                'translation_domain',
            ))), $options['time_options']);

            if (null !== $options['date_widget']) {
                $dateOptions['widget'] = $options['date_widget'];
            }

            if (null !== $options['time_widget']) {
                $timeOptions['widget'] = $options['time_widget'];
            }

            if (null !== $options['date_format']) {
                $dateOptions['format'] = $options['date_format'];
            }

            $dateOptions['input'] = $timeOptions['input'] = 'array';
            $dateOptions['error_bubbling'] = $timeOptions['error_bubbling'] = true;
            
            $dateOptions['attr'] = array('class' => 'jsoke');

            $builder
                ->addViewTransformer(new DataTransformerChain(array(
                    new DateTimeToArrayTransformer($options['model_timezone'], $options['view_timezone'], $parts),
                    new ArrayToPartsTransformer(array(
                        'date' => $dateParts,
                        'time' => $timeParts,
                    )),
                )))
                ->add('date', 'date', $dateOptions)
                ->add('time', 'time', $timeOptions)
            ;
        }

        if ('string' === $options['input']) {
            $builder->addModelTransformer(new ReversedTransformer(
                new DateTimeToStringTransformer($options['model_timezone'], $options['model_timezone'])
            ));
        } elseif ('timestamp' === $options['input']) {
            $builder->addModelTransformer(new ReversedTransformer(
                new DateTimeToTimestampTransformer($options['model_timezone'], $options['model_timezone'])
            ));
        } elseif ('array' === $options['input']) {
            $builder->addModelTransformer(new ReversedTransformer(
                new DateTimeToArrayTransformer($options['model_timezone'], $options['model_timezone'], $parts)
            ));
        }
    }    
    

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'datetime';
    }    
}

