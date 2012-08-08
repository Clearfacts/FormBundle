jQuery(document).ready(
    function($){
        $('.masked-input').each(function(){            
            $(this).mask($(this).attr('masked-input-mask'), {placeholder: $(this).attr('masked-input-placeholder')});
        });
    }
);
