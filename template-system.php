<?php

class TEMPLATE_SYSTEM {

    private $dsn = "mysql:host=localhost;dbname=test1";
    private $user = "testuser";
    private $pass = "testpassword";

    public function getConnections() {
        // return an array of PDO connections
        throw new \Exception("The system TEMPLATE_SYSTEM has not been set up");
    }

    public function check(PDO $conn) {
        // return true if $conn is valid
        return false;
    }

}
