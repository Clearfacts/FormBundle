FormBundle
===========

Types
-----

  * currency
    Automatically sets choices to all available currencies. preferred choices
    are EUR and USD.
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
