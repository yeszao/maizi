jQuery(function($){
    $('.upload-custom-img').on('click', function(e) {
        e.preventDefault();
        var self = $(this),
            parent = self.parent('p'),
            delImgLink = parent.find('.delete-custom-img'),
            imgContainer = parent.find('.custom-img-container'),
            imgIdInput = parent.find('.custom-img-id');

        var custom_uploader = wp.media({
            multiple: false
        })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                imgContainer.html( '<img src="'+attachment.url+'" alt="" style="max-width:100%;"/>' );
                // imgInput.val(attachment.url);
                imgIdInput.val(attachment.id);

                // Unhide the remove image link
                delImgLink.removeClass( 'hidden' );
            })
            .open();
    });

    // DELETE IMAGE LINK
    $('.delete-custom-img').on( 'click', function( event ){
        event.preventDefault();
        var self = $(this),
            parent = self.parent('p'),
            delImgLink = parent.find('.delete-custom-img'),
            imgContainer = parent.find('.custom-img-container'),
            imgIdInput = parent.find('.custom-img-id');
        // Clear out the preview image
        imgContainer.html( '' );
        // Hide the delete image link
        delImgLink.addClass( 'hidden' );
        // Delete the image id from the hidden input
        imgIdInput.val( '' );
    });

    $('#widgets-right .color-picker, .inactive-sidebar .color-picker').wpColorPicker();

    // Executes wpColorPicker function after AJAX is fired on saving the widget
    $(document).ajaxComplete(function() {
        $('#widgets-right .color-picker, .inactive-sidebar .color-picker').wpColorPicker();
    });
});
