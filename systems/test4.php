<?php

class test4 {
    public $dsn = "mysql:host=localhost;dbname=games";
    public $user = "root";
    public $pass = "securedatabase";
    public function getConnection() {
        return new PDO($this->dsn, $this->user, $this->pass);
    }
    public function check() {
        $db = $this->getConnection();
        $sql = "select 8 as answer;";
        $st = $db->prepare($sql);
        $st->execute();
        $array = $st->fetchAll(PDO::FETCH_ASSOC);
        return $array[0]["answer"] == 8;
    }
}
