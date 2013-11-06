jQuery(document).ready(function($) {

    // --- date picker ---

    // create date picker(s)
    $('.datepicker').each(function() {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy',
            showOn: 'button',
            buttonText: '<i class="fa fa-calendar-o"></i>',
            showButtonPanel: true,
            onSelect: function(){
                $(this).trigger('datepicker.select');
            },
            onClose: function(){
                $(this).trigger('datepicker.close');
            }
        });

        $(this).next('.ui-datepicker-trigger')
            .addClass('btn btn-default')
            .wrap('<span class="input-group-btn">')
        ;
    });

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
        replacement.after('<button class="btn ui-timepicker-trigger" type="button" tabindex="-1"><i class="fa fa-clock-time"></i></button>');

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
