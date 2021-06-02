<?php

class Util {
    // Sanitizing inputs
    public function filterInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    // Method for displaying success & error message
    public function showMessage($type, $message) {
        return '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
        <strong>' . $message . '</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        ';
    }
}

?>