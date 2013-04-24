FormBundle
===========

Twig
----

Rendering form actions
    
    {{ form_save_cancel() }}

Will render as
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">{{ "save"|trans|capitalize }}</button>
        <button type="button" class="btn cancelbutton">{{ "cancel"|trans|capitalize }}</button>
    </div>

Types
-----

### currency
  
Automatically sets choices to all available currencies. preferred choices are EUR and USD.

```$builder->add('currency', 'currency');```

 Chosen
--------

  * Compact and large multiselect
  * Allow Deselect on Single Selects 
    (automatically enabled when required = false and the empty option has empty text)

### Options
 * Large (single item per line): add attribute "data-chosen-class" => "large
 * Ajax autocomplete: add attribute 'data-chosen-ajax-url' 

### Full Example
    @TacticsFormBundle/Resources/public/css/chosen.css

    @TacticsFormBundle/Resources/public/js/chosen.jquery.min.js
    @TacticsFormBundle/Resources/public/js/tacticsform-chosen.js

    // Static multiple example, no ajax
    $builder->add('skillblocks', 'model', array(
        'class' => 'Tactics\Bundle\SkillBundle\Model\SkillBlock',
        'property' => 'name',
        'multiple' => true,
        'attr' => array(
            'class' => 'chosen',
            'data-chosen-class' => 'large'
        )
    )); 

    // Ajax example
    $builder->add('persoon', 'model', array(
        'class' => 'Tactics\Bundle\PersoonBundle\Model\Persoon',
        'property' => 'naam',
        'required' => false,
        'attr' => array(
            'class' => 'chosen', 
            'data-chosen-ajax-url' => $this->router->generate('persoon_autocomplete')
         )
    ));

    // ajax autocomplete action
    /**
      * @Route("/autocomplete", name="persoon_autocomplete")
      * @Method({"GET"})
      */
    public function autocompleteAction(Request $request)
    {
        $term = $request->query->get('term');

        $personen = PersoonQuery::create()
          ->filterByVoornaam($term)
          ->_or()
          ->filterByAchternaam($term)
          ->setLimit(10)
          ->find();

        $results = array();

        foreach ($personen as $persoon) {
          $results[$persoon->getId()] = $persoon->__toString();
        }

        $response = new Response(json_encode($results));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

 Date / Time / DateTime Widgets
--------------------------------

 * Proper masks
 * date and time picker UI
 * extend from native Symfony widgets
 * note: 'datum' widget is deprecated in favor of 'tactics_date'

### Example

    $builder->add('publish_at', 'tactics_datetime');
    $builder->add('birthdate', 'tactics_date');
    $builder->add('hour_open', 'tactics_time');

    {% javascripts 
        '@TacticsFormBundle/Resources/public/js/jquery.maskedinput-1.3.min.js'
        '@TacticsFormBundle/Resources/public/js/jquery-ui-1.8.22.custom.min.js'
        '@TacticsFormBundle/Resources/public/js/tacticsform-masked-input.js'
        '@TacticsFormBundle/Resources/public/js/tacticsform-datum-input.js'

        time and datetime only:
        '@TacticsFormBundle/Resources/public/js/jquery.ui.timepicker.js'
    %}

    {% stylesheets
        admin bundle includes this one by default:
        '@TacticsFormBundle/Resources/public/css/base.css' 

        time and datetime only:
        '@TacticsFormBundle/Resources/public/css/jquery.ui.timepicker.css' 
    %}

time- and datepicker fields trigger following events.
    
    jQuery('#tactics-date-field').on('datepicker.select', function() {

    });

    jQuery('#tactics-date-field').on('datepicker.close', function() {

    });

    jQuery('#tactics-time-field').on('timepicker.select', function() {

    });

    jQuery('#tactics-time-field').on('timepicker.close', function() {

    });

Below: Stuff to remove from docs?
----------------------------------

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
