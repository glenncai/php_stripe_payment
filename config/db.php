<?php

session_start();

// simulate the login pattern
// If set, it means that the customer has been logined in.
$setEmail = true;

if ($setEmail) {
    $_SESSION["email"] = "user@email.com";
}else {
    $_SESSION["email"] = "";
}


/********************* Connect the DB in here *********************/

class DB {
    private const DBHSOT = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'stripe';

    // Sender email
    public const USERNAME = 'YOUR GOOGLE EMAIL';

    // Sender password
    public const PASSWORD = 'YOUR PASSWORD';

    // Public key from stripe
    public const STRIPE_PUB_KEY = 'YOUR PUBLIC KEY';

    // Secutiry key from stripe
    public const STRIPE_API_KEY = 'YOUR SECRET KEY';

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
