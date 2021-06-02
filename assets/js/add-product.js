$(function() {

    $('#add_product_form').submit(function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append("add_product_form_submit", 1);

        // JS built-in function - If data is valid, return true, else return false
        if (this.checkValidity() === false) {
            // We add these in order to prevent submit action from happening
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass("was-validated"); // Bootstrap class
        } else {
            // If data is valid, then do the action via ajax
            $('#add_product_btn').val('Please Wait...');
            $.ajax({
                url: "includes/ajax/addProduct-action.php",
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#alert_message').html(response);
                    // resets the values of all elements in a form, be empty
                    $('add_product_form')[0].reset();
                    $('#add_product_btn').val('Submit');
                    $('#add_product_form').removeClass('was-validated');
                }
            });
        }
    });

});