jQuery(function($){
    $(document).on('click', '.upload-custom-img', function(e) {
        e.preventDefault();
        var self = $(this),
            parent = self.parent('.upload-img-box'),
            delImgLink = parent.find('.delete-custom-img'),
            imgContainer = parent.find('.custom-img-container'),
            imgIdInput = parent.find('.custom-img-id');

        var frame = wp.media({
            multiple: false
        });

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();

            imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
            imgIdInput.val(attachment.id);
            delImgLink.removeClass( 'hidden' );
        });

        frame.open();
    });

    // DELETE IMAGE LINK
    $(document).on( 'click', '.delete-custom-img', function( event ){
        event.preventDefault();
        var self = $(this),
            parent = self.parent('.upload-img-box'),
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
