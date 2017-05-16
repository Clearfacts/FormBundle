jQuery(document).ready(function($) {
    $('.datepicker').each(function() {
        createDatePicker($(this));
    });

    $('.timepicker').each(function(){
        createTimePicker($(this));
    })
});

/**
 * Creates a datepicker on the given element
 *
 * @param element
 */
function createDatePicker(element) {
    element.datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        showOn: 'button',
        yearRange: element.data('year-range') ? element.data('year-range') : "-10:+10",
        buttonText: '<i class="fa fa-calendar-o icon-calendar-empty"></i>',
        showButtonPanel: true,
        onSelect: function(){
            element.trigger('datepicker.select');
        },
        onClose: function(){
            element.trigger('datepicker.close');
        }
    });

    element.next('.ui-datepicker-trigger')
        .addClass('btn btn-default')
        .wrap('<span class="input-group-btn">')
    ;
}

/**
 * Creates a timepicker on the given element
 *
 * @param element
 */
function createTimePicker(element) {
    element.timepicker({
        showOn: 'button',
        showCloseButton: true,
        showNowButton: true,
        showDeselectButton: true,
        onSelect: function(){
            element.trigger('timepicker.select');
        },
        onClose: function(){
            element.trigger('timepicker.close');
        }
    });

    element.next('.ui-timepicker-trigger')
        .addClass('btn btn-default')
        .wrap('<span class="input-group-btn">')
    ;
}