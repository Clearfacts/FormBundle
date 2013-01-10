// add new form to the given collection
function addFormToCollection(collectionName) {
    // Get the table that holds the collection
    var $collectionHolder = $('.collection-holder[collection=' + collectionName + ']');
    // Get the data-prototype
    var prototype = $collectionHolder.attr('data-prototype');
    // count the current form inputs we have (e.g. 2), use that as the new index (e.g. 2)
    var newIndex = $collectionHolder.attr('next-index');
    // nieuwe next-index zetten
    $collectionHolder.attr('next-index', ++newIndex);
    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newTr = prototype.replace(/__name__/g, newIndex);
    // append the form to the collection        
    $collectionHolder.append(newTr);
    // reapply chosen?
    $('.chosen').chosen();  
}

jQuery(document).ready(function() {
    $('.collection-add-btn').on('click', function(e) {                
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new form to the collectionholder
        addFormToCollection($(this).attr('collection'));
    });

    $('body').on('click', '.collection-remove-btn', function(e) {                
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove a form from the collection
        $(this).parents('tr:first').remove();
    });
});