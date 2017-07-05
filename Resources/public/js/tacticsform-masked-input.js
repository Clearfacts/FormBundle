jQuery(document).ready(function($) {
    $('.masked-input').each(function() {
        createMask($(this));
    });
});

/**
 * Create a mask on the given element
 * @param element
 */
function createMask(element) {
    if(element.attr('masked-input-mask')){
        element.mask(element.attr('masked-input-mask'), {
            placeholder: element.attr('masked-input-placeholder')
        });
    }
}