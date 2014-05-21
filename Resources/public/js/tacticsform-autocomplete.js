jQuery(document).ready(function($) {
    $('.autocomplete_select').chosen({
        disable_search_threshold: 0,
        no_results_text: 'Looking for '
    });

    var typingTimer = null;
    var searchBoxSelector = '.autocomplete_div > .chosen-container > .chosen-drop > .chosen-search > input';
    $('body').on('keyup', searchBoxSelector, function(e) {

        if (guardAllowedKeys(e.keyCode)) {
            return;
        }

        var select = getSelectBox($(this));
        var searchBox = $(this);

        if (! searchBox.val()) {
            clearOptions(select);
        }

        if (typingTimer == null) {
            typingTimer = setTimeout(function() {
                autocomplete(select, searchBox)
            }, 1000);
        }
    })
    .on('keydown', searchBoxSelector, function(e) {

        if (guardAllowedKeys(e.keyCode)) {
            return;
        }

        var select = getSelectBox($(this));

        if (! $(this).val()) {
            clearOptions(select);
        }

        clearTimeout(typingTimer);
        typingTimer = null;
    });

    $('.autocomplete_select').chosen().change(function() {
        var select = getSelectBox($(this));
        var target = $($(this).attr('data-target'));

        target.val(select.val());
    });
});

/**
 * There is still a problem with right- and left-arrow clearing selection.
 */
function guardAllowedKeys(keyCode) {
    var ignoreKeyMap = {
        38: 'up-arrow',
        40: 'down-arrow',
        13: 'enter',
    };

    return ignoreKeyMap.hasOwnProperty(keyCode);
}

function getSelectBox(current) {
    return current.closest('.autocomplete_div')
        .find('.autocomplete_select')
    ;
}

function autocomplete(select, searchBox) {
    var term = searchBox.val();

    var url =  Routing.generate(select.attr('data-route'));
    if(select.attr('data-route-params')) {
        url = Routing.generate(select.attr('data-route'), $.parseJSON(select.attr('data-route-params')));
    }

    $.ajax({
        url: url,
        data: {
            term: term
        },
        type: "GET",
        dataType: "json",
        success:  function(json) {
            clearOptions(select);

            if ($.isEmptyObject(json)) {
                searchBox.parent().next('.chosen-results').find('.autocomplete_placeholder').removeClass('active-result');
                searchBox.parent().next('.chosen-results').append($('<li></li>').addClass('no-results').html('Nothing found for "'+term+'"'));
                searchBox.val(term);
                return false;
            } else {
                $.each(json, function(index, value) {
                    select.append($('<option></option>')
                        .val(index)
                        .text(value)
                    );
                });

                triggerUpdate(select);
                searchBox.val(term);
            }
        }
    });
}

function clearOptions(select) {
    // Keep the placeholder or we lose the searchbox
    select.find('option')
        .not('.autocomplete_placeholder')
        .remove()
    ;

    triggerUpdate(select);
}

function triggerUpdate(select) {
    select.trigger('chosen:updated');
}
