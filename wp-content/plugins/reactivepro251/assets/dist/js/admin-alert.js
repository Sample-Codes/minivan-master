"use strict";

(function($){
  
  jQuery(".reactive-reindexing").click( function() {

    var self = $( this );

    var loaderContainer = $( '<span/>', {
        'class': 'loader-image-container'
    }).insertAfter( self );

    var loader = $( '<img/>', {
        src: REACTIVE_ADMIN_ALERT.spinner,
        'class': 'loader-image'
    }).appendTo( loaderContainer );

      jQuery.ajax({
         type : "post",
         dataType: "json",
         url : REACTIVE_ADMIN_ALERT.ajaxurl,
         data : {action: "re_indexing_data", nonce: REACTIVE_ADMIN_ALERT.indexing_builder_nonce},
         success: function(response) {
          console.log(response);
          loaderContainer.remove();
          if (response.type == "success") {

            $('.reactice-success-message').html('Congratulation! Your indexing for posts is done.');
            $('#reactice-admin-notice').fadeOut(500);
          }
          else {
            $('.reactice-success-message').html('There is some problem. Please try again later.');
          }
        }
      })   

   });

})(jQuery);
