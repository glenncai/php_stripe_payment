<?php

/********************* Connect the DB in here *********************/

class DB {
    private const DBHSOT = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'stripe';

    // Public key from stripe
    public const STRIPE_PUB_KEY = 'pk_test_51IxOsuLSda4DLiyJa09U1hXiLPtNZV59tgznWuOKlFWIaOLrp42xcast8jKgQY16OD0QFh3yILluZ0DIQAPD8BdP00639GN4aH';

    // Secutiry key from stripe
    public const STRIPE_API_KEY = 'YOUR SECURITY API';

    private $dsn = 'mysql:host=' . self::DBHSOT . ';dbname=' . self::DBNAME . '';

    public $conn = null;

    public function __construct() {
        try {
            $this->conn = new PDO($this->dsn, self::DBUSER, self::DBPASS);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }

        return $this->conn;
    }
}

?>
