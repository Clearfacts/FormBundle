jQuery(document).ready(function($) {
  
    // --- date picker ---
  
    // create date picker(s)
    $('.datepicker, .tactics_datetime > div > input').datepicker({
      buttonText: '<i class="icon-calendar"></i>',
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy',
      showButtonPanel: true,
      showOn: 'button'
    })
    // disable tab select
    .next('button.ui-datepicker-trigger')
      .attr("tabIndex", "-1")
    ;
    
    
    // --- time picker ---

    // for each time input field
    $('.timepicker, .tactics_datetime > input[type=time]').each(function(){
        
        // attach timepicker button to time field, the bootstrap way
        $(this).wrap('<div class="input-append">');
        $(this).after('<button class="btn ui-timepicker-trigger" type="button" tabindex="-1"><i class="icon-time"></i></button>');

        // fetch reference to the button
        var btn = $(this).next('button');
        
        // create time picker
        $(this).timepicker({
            showOn: 'button',
            button: btn,
            showCloseButton: true,
            showNowButton: true,
            showDeselectButton: true
        });
    })
    
});
