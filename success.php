<?php

// For PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/util.php';

$db = new DB;
$actions = new Actions;
$util = new Util;

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$message = '';

// Get the session_id from stripe payment return
if (!empty($_GET['session_id'])) {
    $session_id = $_GET['session_id'];

    // We should use secret key to retrieve the corresponding data
    \Stripe\Stripe::setApiKey(DB::STRIPE_API_KEY);

    try {
        // checkout_session is the response body in payment. i.e the whole information of payment
        // Then we will get the object key from checkout_session (api)
        $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
    } catch (Exception  $e) {
        $api_error = $e->getMessage();
    }

    if (empty($api_error) && $checkout_session) {
        try {
            $intent =  \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $api_error = $e->getMessage();
        }

        try {
            $customer = \Stripe\Customer::retrieve($checkout_session->customer);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $api_error = $e->getMessage();
        }

        if (empty($api_error) && $intent) {
            // status is the key from response body
            if ($intent->status == 'succeeded') {
                $product_id = $util->filterInput($_GET['id']);
                $productDetail = $actions->fetchProductById($product_id);

                $product_image = $productDetail->product_image;
                $item_name = $productDetail->product_name;
                // Try to print the api blow to see the details and format
                // print_r($intent);
                // print_r($customer);
                $customer_name = $intent->charges['data'][0]['billing_details']['name'];
                $customer_email = $customer->email;
                $transactionId = $intent->id;

                // cuz we multiply 100 for product price in checkout-action.php, we need to divide 100 here
                $amount = $intent->amount / 100;

                $currency = $intent->currency;
                $status = $intent->status;

                if ($actions->existingOrders($session_id)) {
                    // Insert product detail into orders table
                    $actions->insertPaymentInfo($customer_name, $customer_email, $item_name, $product_id, $amount, $currency, $transactionId, $status, $session_id);
                }

                if ($status == 'succeeded') {
                    $message = 'Your payment has been successful.';

                    // PHPMailer setting
                    try {
                        //Server settings

                        //Send using SMTP
                        $mail->isSMTP();
                        //Set the SMTP server to send through
                        $mail->Host = 'smtp.gmail.com';
                        //Enable SMTP authentication                     
                        $mail->SMTPAuth = true;
                        //SMTP username
                        $mail->Username = DB::USERNAME;
                        //SMTP password                     
                        $mail->Password = DB::PASSWORD;
                        //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above         
                        $mail->Port = 587;

                        //Recipients
                        $mail->setFrom(DB::USERNAME, 'Glenn Cai');
                        //Add a recipient
                        $mail->addAddress($customer_email, $customer_name);

                        //Add attachments
                        $mail->addAttachment('assets/uploads/' . $product_image);

                        //Set email format to HTML
                        $mail->isHTML(true);
                        $mail->Subject = 'Project From Glenn - PHPMailer';
                        $mail->Body    = 'Please check your orders. Thanks.';

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $message = 'Your payment has failed!';
                }
            } else {
                $message = 'Transaction has been failed!';
            }
        } else {
            $message = 'Unable to fetch the transaction details!';
        }
    } else {
        $message = 'Transaction has been failed!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php echo $message; ?></title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <div class="payment">
                    <div class="payment_header">
                        <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
                    </div>
                    <div class="content">
                        <h1><?php echo $message; ?></h1>

                        <?php if (!empty($transactionId)): ?>
                        <h4 class="font-weight-bold">Payment Information</h4><hr>
                        <p><b>Transaction ID : </b><?php echo $transactionId; ?></p><hr>
                        <p><b>Paid Amount : </b><?php echo number_format($amount, 2, '.', ','); ?></p><hr>
                        <h4 class="font-weight-bold">Product Information</h4><hr>
                        <p><b>Product ID : </b><?php echo $product_id; ?></p>
                        <p><b>Product Name : </b><?php echo $item_name; ?></p>
                        <img src='assets/uploads/<?php echo $product_image ?>'>
                        <?php endif; ?>
                    </div>
                    <a href="index.php" class="btn">Back to home</a>
                </div>
            </div>
        </div>
    </div>


</body>

</html>