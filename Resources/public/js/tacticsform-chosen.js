jQuery(document).ready(function($) {
    $(".chosen").chosen();
    
    $(".chosen").each(function(){
        $(this).next('.chzn-container').addClass($(this).attr('chosen-class'));
    });
});