<?php

class TEMPLATE_SYSTEM {

    private $dsn = "mysql:host=localhost;dbname=test1";
    private $user = "testuser";
    private $pass = "testpassword";

	/**
	 * Build and return an array of PDO connections
	 * @return array
	 */
    public function getConnections() {
        // return an array of PDO connections
        throw new \Exception("The system TEMPLATE_SYSTEM has not been set up");
		$db = new PDO($this->dsn, $this->user, $this->pass);
		return array($db);
    }

    public function check(PDO $conn) {
        // return true if $conn is valid
        return false;
    }

}
