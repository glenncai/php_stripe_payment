<?php
require_once __DIR__ . '../../functions.php';
require_once __DIR__ . '../../util.php';

$actions = new Actions;
$util = new Util;

// Handle add new product via ajax request

// Because we receive the formData from add-product.js
if (isset($_POST['add_product_form_submit'])) {
    $product_name = $util->filterInput($_POST['product_name']);
    $product_price = $util->filterInput($_POST['product_price']);
    $product_desc = $util->filterInput($_POST['product_desc']);

    $product_image_name = $_FILES['product_image']['name'];
    $product_image_temp = $_FILES['product_image']['tmp_name'];

    $product_image_ext = explode('.', $product_image_name);
    $product_image_ext = strtolower(end($product_image_ext));

    $upload_dir = '../../assets/uploads/';
    $image_name = uniqid() . '.' . $product_image_ext;
    $product_image_upload_dest = $upload_dir . 'products/' . $image_name;

    if ($actions->addProduct($product_name, $product_price, $product_desc, $image_name)) {
        // From 'product_image_temp' to 'product_image_upload_dest'
        move_uploaded_file($product_image_temp, $product_image_upload_dest);

        // 'success' is the class of Bootstrap
        echo $util->showMessage('success',  $product_name . ' added successfully!');
    } else {
         // 'danger' is the class of Bootstrap
        echo $util->showMessage('danger', 'Something went wrong!');
    }
}

?>