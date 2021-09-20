
// Enable the form to edition
$( "#btn-enable-edition" ).click(function() {
    $("#detail-form").removeAttr('disabled');
    $("#btn-enable-edition").addClass('d-none');
    $("#btn-cancel-edition").removeClass('d-none');
    $("#btn-submit-edition").removeClass('d-none');
});

// Disable the form and show the edit button again
$("#btn-cancel-edition").click(function(){
    $("#btn-enable-edition").removeClass('d-none');
    $("#btn-cancel-edition").addClass('d-none');
    $("#btn-submit-edition").addClass('d-none');

    $("#detail-form").attr('disabled', true);
});
