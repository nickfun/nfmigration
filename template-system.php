<?php

class TEMPLATE_SYSTEM {
    private $dsn = "mysql:host=localhost;dbname=test1";
    private $user = "test";
    private $pass = "testpassword";
    public function getConnection() {
        throw new \Exception("The system TEMPLATE_SYSTEM has not been set up");
    }
    public function check() {
        return false;
    }
}
