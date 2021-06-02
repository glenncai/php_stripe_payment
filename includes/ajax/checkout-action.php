<?php

include __DIR__ . '../../../config/db.php';
include __DIR__ . '../../functions.php';
include __DIR__ . '../../util.php';
include __DIR__ . '../../../vendor/autoload.php';

$db = new DB;
$actions = new Actions;
$util = new Util;

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

    $YOUR_DOMAIN = 'https://localhost/stripe_payment';

    // Something wrong here
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'unit_amount' => $product_price,
                'product_data' => [
                    'name' => $product_name,
                    'images' => ['../../../assets/uploads/products/' . $product_image],
                ],
            ],
            'quantity' => $product_quantity,
            'description' => $product_desc
        ]],
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . '/success.php',
        'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
    ]);

    echo json_encode(['id' => $checkout_session->id]);

}
