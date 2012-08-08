jQuery(document).ready(function($) {
  
    $('.datepicker').datepicker({
      buttonText: '<i class="icon-calendar"></i>',
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy',
      showButtonPanel: true,
      showOn: 'button'
    });
});
