<?php

namespace Config;

/**
 * Example connection config to a "System" database
 */

class Body extends NFMConfig {
    
    public function getConnections() {
        
        $oHead = new \Config\Head();
        $pdoList = $oHead->getConnections();
        $pdoHead = $pdoList[0];
        
        $sql = "SELECT * FROM body_dbs";
        $res = $pdoHead->query($sql);
        
        $bodyPdoList = array();
        foreach ($res->fetchAll() as $row) {
            $host = $row->host;
            $name = $row->name;
            $user = $row->user;
            $pass = $row->pass;
            $dsn = "mysql:host=$host;dbname=$name";
            $bodyPdoList[] = new PDO($dsn, $user, $pass);
        }
        
        return $bodyPdoList;        
    }
}