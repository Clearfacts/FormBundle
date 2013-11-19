    function initialiseChosenFields(selector)
    {
        if (selector) {
            var elements = $(selector);
        } else {
            var elements = $('.chosen')
        }

        // Enable chosen on every select list selected
        elements.each(function()
        {
            var options = {
                disable_search_threshold: 5,
            };
            var $this = $(this);

            // enable 'x' on input to remove selected value when single select
            // and not required
            options.allow_single_deselect = $this.attr('required') ? false : true;

            // default chosen from select list
            if (! $this.attr('data-chosen-ajax-url'))
            {
                $this.chosen(options);
            }
            // chosen with ajax
            else
            {
                options = $.extend([], {
                    method: 'GET',
                    url: $this.attr('data-chosen-ajax-url'),
                    dataType: 'json',
                    allow_single_deselect: true
                });


                $this.ajaxChosen(options, function (data) {
                    var terms = {};

                    $.each(data, function (i, val) {
                        terms[i] = val;
                    });

                    return terms;
                });
            }
	    $this.trigger("liszt:updated");
        });

        // add chosen-class as class to chosen container
        $(".chosen").each(function(){
            $(this).next('.chzn-container').addClass($(this).attr('data-chosen-class'));
        });
    }

jQuery(document).ready(function($) {
    initialiseChosenFields();

});
