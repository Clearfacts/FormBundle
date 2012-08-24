TableBundle
===========

Multi select
------------
    @TacticsFormBundle/Resources/public/css/chosen.css
    @TacticsFormBundle/Resources/public/css/tacticsform-chosen.css

    @TacticsFormBundle/Resources/public/js/chosen.jquery.min.js
    @TacticsFormBundle/Resources/public/js/tacticsform-chosen.js

### Options
 * "large": add attribute "chosen-class" => "large

### Full Example
    $builder->add('skillblocks', 'model', array(
        'class' => 'Tactics\Bundle\SkillBundle\Model\SkillBlock',
        'property' => 'name',
        'multiple' => true,
        'attr' => array(
            'class' => 'chosen',
            'chosen-class' => 'large'
        )
    )); 

### Below: Stuff to remove from docs?

Polyfill fields:
  So far javascripts have been added to emulate the behavior of an html 5 number field type in older browsers
  If you want to use a numberfield , add a formfield in your typeClass with fieldtype = integer 
  and include following lines in your template:
    {% block stylesheets %}
      {{ parent() }}
      
        {% stylesheets
            '@TacticsFormBundle/Resources/public/css/chosen.css'
        %}
    
        <link href="{{ asset_url }}" type="text/css" rel="stylesheet">
        
        {% endstylesheets %}  
    {% endblock %}

    and import following javascripts :
      - '@TacticsFormBundle/Resources/public/js/tacticsform-datum-input.js'
      - '@TacticsFormBundle/Resources/public/js/chosen.jquery.min.js'