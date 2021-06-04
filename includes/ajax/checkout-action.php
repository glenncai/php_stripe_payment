<?php

include __DIR__ . '../../../config/db.php';
include __DIR__ . '../../functions.php';
include __DIR__ . '../../util.php';
include __DIR__ . '../../../vendor/autoload.php';

$db = new DB;
$actions = new Actions;
$util = new Util;

$failNumber = 1;

// Handle stripe payment process via ajax request
if (isset($_POST['stripe_payment_process'])) {
    $id = $util->filterInput($_POST['id']);
    $product = $actions->fetchProductById($id);

    $product_name = $product->product_name;
    $product_price = $product->product_price * 100;
    $product_desc = $product->product_desc;
    $product_image = $product->product_image;

    $product_quantity = 1;


    // Set the security key
    \Stripe\Stripe::setApiKey(DB::STRIPE_API_KEY);

    header('Content-Type: application/json');

    // Your should change you path in here
    $YOUR_DOMAIN = 'YOUR DOMAIN';

    // Something wrong here
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'hkd',
                'unit_amount' => $product_price,
                'product_data' => [
                    'name' => $product_name,
                    // Image will not appear in localhost.
                    'images' => [ '../../../assets/uploads/' . $product_image],
                ],
            ],
            'quantity' => $product_quantity,
            'description' => $product_desc
        ]],
        'mode' => 'payment',
        // CHECKOUT_SESSION_ID is from offical term. And id is the corresponding product id
        'success_url' => $YOUR_DOMAIN . '/success.php?session_id={CHECKOUT_SESSION_ID}&id=' . $id,
        'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
    ]);

    if (!empty($_SESSION['email']) && $_SESSION['email'] != null) {
        echo json_encode(['id' => $checkout_session->id]);
    } else {
        echo $failNumber;
    }


}
