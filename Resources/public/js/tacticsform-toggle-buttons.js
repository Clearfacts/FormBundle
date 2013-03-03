jQuery(document).ready(function($) {
    //inputs van type checkbox met class toggle-button wrappen in div
    $('.toggle-button-checkbox').each(function(){
        $(this).wrap('<div class="toggle-button" style="float:left" />')
    });
    
    $('div.toggle-button').toggleButtons({
        height: 14,
        width: 42,
        label: {
            enabled: "",
            disabled: ""
        },
        style: {
            // Accepted values ["primary", "danger", "info", "success", "warning"] or nothing
            enabled: "success",
            disabled: "danger"            
        }
    });
});