(function($) {
    $(document).ready(function(){
        $("#wc_variations__accordion .variation__section").first().slideDown(); // Open first element on page load

        $("#wc_variations__accordion select").change(function(){
                $(this).parents('.variation__section').slideUp();
                $(this).parents('.variation__section').prev().addClass('step_complete');
                $(this).parents('.variation__section').next().next().slideDown();
            });
    });
})( jQuery );
