jQuery(document).ready(function($) {
  
    // --- date picker ---
  
    // create date picker(s)
    $('.datepicker, .tactics_datetime > div > input').datepicker({
        buttonText: '<i class="icon-calendar"></i>',
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        showButtonPanel: true,
        showOn: 'button',
        onSelect: function(){
            $(this).trigger('datepicker.select');
        },
        onClose: function(){
            $(this).trigger('datepicker.close');
        }
    })
    // disable tab select
    .next('button.ui-datepicker-trigger')
      .attr("tabIndex", "-1")
    ;
    
    
    // --- time picker ---

    // for each time input field
    $('.timepicker, .tactics_datetime > input[type=time]').each(function(){
        // Replace time input by text input to prevent standard time HTML5
        // controls from appearing.
        var replacement = $(this.outerHTML.replace('type="time"', 'type="text"'));
        $(this).replaceWith(replacement);

        replacement.addClass('time-input');

        // attach timepicker button to time field, the bootstrap way
        replacement.wrap('<div class="input-append">');
        replacement.after('<button class="btn ui-timepicker-trigger" type="button" tabindex="-1"><i class="icon-time"></i></button>');
        
        // fetch reference to the button
        var btn = replacement.next('button');
        
        // create time picker
        replacement.timepicker({
            showOn: 'button',
            button: btn,
            showCloseButton: true,
            showNowButton: true,
            showDeselectButton: true,
            onSelect: function(){
                $(this).trigger('timepicker.select');
            },
            onClose: function(){
                $(this).trigger('timepicker.close');
            }
        });
    })
    
});
