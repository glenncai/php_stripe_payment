<?php
require_once __DIR__ . '../../config/db.php';

class Actions extends DB {

    // Insert form data into database
    public function addProduct($p_name, $p_price, $p_desc, $p_image) {
        $sql = 'INSERT INTO products (product_name, product_price, product_desc, product_image) VALUES (:product_name, :product_price, :product_desc, :product_image)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_name', $p_name, PDO::PARAM_STR);
        $stmt->bindParam(':product_price', $p_price, PDO::PARAM_STR);
        $stmt->bindParam(':product_desc', $p_desc, PDO::PARAM_STR);
        $stmt->bindParam(':product_image', $p_image, PDO::PARAM_STR);
        $stmt->execute();

        return true;
    }

    // Fetch the product details from DB
    public function getProduct() {
        try {
            $sql = 'SELECT * FROM products ORDER BY id DESC';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
            while($row = $stmt->fetch()) {
                // filter data from database
                $product_name = $row->product_name;
                // make the price to be good format i.e 12456.8 to be 12,457
                $product_price = number_format($row->product_price, 0, '.', ',');
                $product_desc = $row->product_desc;
                $product_image = $row->product_image;
                $id = $row->id;
    
                echo " <div class='col-lg-3 col-md-6'>
                            <div class='card shadow'>
                                <img src='assets/uploads/products/{$product_image}' alt='{$product_name}' class='card-img-top p-3'>
                                <div class='card-body pt-0'>
                                <h5 class='card-title'>{$product_name}</h5>
                                <div class='card-text my-2'>{$product_desc}</div>
                                <button class='btn btn-danger btn-block rounded-pill buy_now_btn' id='{$id}'>&#36;{$product_price} Buy Now</button>
                            </div>
                            </div>
                        </div>
                ";
            }
        }catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function fetchProductById($id) {
        $sql = 'SELECT * FROM products WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row;
    }
}

?>