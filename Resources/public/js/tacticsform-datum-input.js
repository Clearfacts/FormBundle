jQuery(document).ready(function($) {

    // --- date picker ---
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
    $('.timepicker').each(function(){
        $(this).timepicker({
            showOn: 'button',
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

        $(this).next('.ui-timepicker-trigger')
            .addClass('btn btn-default')
            .wrap('<span class="input-group-btn">')
        ;
    })

});
