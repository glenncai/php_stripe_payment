<?php
require_once __DIR__ . '/includes/functions.php';

$actions = new Actions;
$db = new DB;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Stripe Payment Test</title>
</head>
<body>

    <?php include __DIR__ . '/includes/header.php'; ?>
    
    <div class="container">
        <h3 class="text-center font-weight-bold  mt-4">Welcome to my shop</h3><hr>
        <div class='row'>
        <?php $actions->getProduct(); ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Stripe Payment Script -->
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        $(function() {

            // Create an instance of the Stripe object with your publishable API key
            let stripe = Stripe('<?=  DB::STRIPE_PUB_KEY ?>');

            console.log(stripe);

            // When we click the button with the class 'buy_now_btn'
            $(document).on('click', '.buy_now_btn', function(e) {
                // Get the corresponding product id
                // 'this' means that the button what we click
                let id = $(this).attr('id');
                $(this).text('Please wait...'); 
                $.ajax({
                    url: "includes/ajax/checkout-action.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                        // We use this one to treat whether the checkotu btn is clicked
                        stripe_payment_process: 1
                    },
                    success: function(session) {
                        // redirect to stripe checkout page
                        return stripe.redirectToCheckout({
                            sessionId: session.id
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>