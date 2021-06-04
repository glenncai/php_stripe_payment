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
                                <img src='assets/uploads/{$product_image}' alt='{$product_name}' class='card-img-top p-3'>
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

    // existing payment order method
    public function existingOrders($session_id) {
        $sql = 'SELECT * FROM orders WHERE session_id = :session_id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':session_id', $session_id, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    // insert payment details into database
    public function insertPaymentInfo($customer_name, $customer_email, $item_name, $item_number, $item_price, $currency, $txn_id, $payment_status, $session_id) {
        $sql = 'INSERT INTO orders (name, email, item_name, item_number, item_price, currency, txn_id, payment_status, session_id) VALUES (:name, :email, :item_name, :item_number, :item_price, :currency, :txn_id, :payment_status, :session_id)';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $customer_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $customer_email, PDO::PARAM_STR);
        $stmt->bindParam(':item_name', $item_name, PDO::PARAM_STR);
        $stmt->bindParam(':item_number', $item_number, PDO::PARAM_STR);
        $stmt->bindParam(':item_price', $item_price, PDO::PARAM_STR);
        $stmt->bindParam(':currency', $currency, PDO::PARAM_STR);
        $stmt->bindParam(':txn_id', $txn_id, PDO::PARAM_STR);
        $stmt->bindParam(':payment_status', $payment_status, PDO::PARAM_STR);
        $stmt->bindParam(':session_id', $session_id, PDO::PARAM_STR);

        $stmt->execute();
        return true;
    }

    public function getOrders() {
        $sql = 'SELECT * FROM orders';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        while ($row = $stmt->fetch()) {
            $order_id = $row->id;
            $customer_name = $row->name;
            $customer_email = $row->email;
            $item_name = $row->item_name;
            $item_number = $row->item_number;
            $item_price = number_format($row->item_price, 0, '.', ',');
            $currency = $row->currency;
            $txn_id = $row->txn_id;
            $payment_status = $row->payment_status;
            $paidDate = $row->created;

            echo  "
                        <tr>
                            <th scope='row'>{$order_id}</th>
                            <td>{$customer_name}</td>
                            <td>{$customer_email}</td>
                            <td>{$item_number}</td>
                            <td>{$item_name}</td>
                            <td>{$item_price}</td>
                            <td>{$currency}</td>
                            <td>{$txn_id}</td>
                            <td>{$payment_status}</td>
                            <td>{$paidDate}</td>
                        </tr>
            ";
        }
    }

    public function error() {
        if (!empty($_SESSION['error'])) {
            $errorMessage = $_SESSION['error'];

            echo "
                <div class='alert alert-danger' role='alert'>
                    {$errorMessage}
                </div>
            ";
        }
    }

}

?>