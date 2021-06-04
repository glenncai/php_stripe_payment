<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/db.php';
$actions = new Actions;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Orders</title>
</head>

<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Item number</th>
                <th scope="col">Item name</th>
                <th scope="col">Amount</th>
                <th scope="col">Currency</th>
                <th scope="col">Transaction ID</th>
                <th scope="col">Payment status</th>
                <th scope="col">Payment date</th>
            </tr>
        </thead>
        <tbody>
            <?php $actions->getOrders(); ?>
        </tbody>
    </table>

</body>

</html>