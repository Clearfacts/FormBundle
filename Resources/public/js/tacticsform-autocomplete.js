jQuery(document).ready(function($) {
    $('.autocomplete_select').chosen({
        disable_search_threshold: 0,
        no_results_text: 'Looking for '
    });

    var typingTimer = null;
    var searchBoxSelector = '.autocomplete_div > .chzn-container > .chzn-drop > .chzn-search > input';
    $('body').on('keyup', searchBoxSelector, function() {
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
    .on('keydown', searchBoxSelector, function() {
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

function getSelectBox(current) {
    return current.closest('.autocomplete_div')
        .find('.autocomplete_select')
    ;
}

function autocomplete(select, searchBox) {
    var term = searchBox.val();

    $.ajax({
        url: Routing.generate(select.attr('data-route'), $.parseJSON(select.attr('data-route-params'))),
        data: {
            term: term
        },
        type: "GET",
        dataType: "json",
        success:  function(json) {
            clearOptions(select);

            if ($.isEmptyObject(json)) {
                searchBox.parent().next('.chzn-results').find('.autocomplete_placeholder').removeClass('active-result');
                searchBox.parent().next('.chzn-results').append($('<li></li>').addClass('no-results').html('Nothing found for "'+term+'"'));

                return false;
            } else {
                $.each(json, function(index, value) {
                    select.append($('<option></option>')
                        .val(index)
                        .text(value)
                    );
                });

                triggerUpdate(select);
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
    select.trigger('liszt:updated');
}
