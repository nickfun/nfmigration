<?php

namespace Config;

/**
 * Example connection config to a "System" database
 */

class Head extends NFMConfig {
    
    public function getConnections() {
        $dsn = "mysql:host=localhost;dbname=system";
        $pdo = new PDO($dsn, "root", "");
        return array($pdo);
    }
}