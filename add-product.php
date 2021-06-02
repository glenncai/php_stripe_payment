<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Add Product</title>
</head>
<body>

    <?php include __DIR__ . '/includes/header.php'; ?>
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <h3>Add Product</h3>
                    </div>
                    <div class="card-body">
                    <div id="alert_message"></div>
                        <form action="#" method="POST" enctype="multipart/form-data" id="add_product_form" novalidate>

                            <div class="form-group">
                                <input type="text" name="product_name" class="form-control" placeholder="Product Name" required />
                                <div class="invalid-feedback">Product name is required</div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="product_price" class="form-control" placeholder="Product Price" required />
                                <div class="invalid-feedback">Product price is required</div>
                            </div>
                            <div class="form-group">
                                <textarea name="product_desc" class="form-control" placeholder="Product Description" required></textarea>
                                <div class="invalid-feedback">Product price is required</div>
                            </div>
                            <div class="form-group">
                                <label for="product_image">Select Product Image</label>
                                <input type="file" name="product_image" id="product_image" required />
                                <div class="invalid-feedback">Product image is required</div>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-primary btn-block" id="add_product_btn" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="assets/js/add-product.js"></script>
</body>
</html>