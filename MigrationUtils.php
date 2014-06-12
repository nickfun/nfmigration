<?php

class MigrationUtils {

    public $systemDir = "./systems/";
    private $systems;
    private $config;

    function __construct() {
        $systems = array();
        $this->config = array(
            'migration_table' => 'nfm_migrations'
        );
    }

    function getSystemsList() {

        $list = array();
        $d = dir("./systems");
        while ($file = $d->read()) {
            if (substr($file, -4) == ".php") {
                $list[] = substr($file, 0, -4);
            }
        }
        return $list;
    }

    /**
     * @TODO test this
     */
    function getSystem($name) {
        if (!isset($this->systems[$name])) {
            $filename = $this->systemDir . $name . ".php";
            if (!file_exists($filename)) {
                throw new \Exception("No system: $name");
            }
            require_once $filename;
            $s = new $name();
            $this->systems[$name] = $s;
        }
        return $this->systems[$name];
    }
    
    /**
     * @TODO test
     * @param \PDO $pdo
     * @return boolean
     */
    function isAlreadyInstalled(\PDO $pdo) {
        $sql = "show tables;";
        $tableName = $this->config['migration_table'];
        $stm = $pdo->prepare($sql);
        $res = $stm->execute();
        $rows = $stm->fetchAll(PDO::FETCH_COLUMN);
        foreach ($rows as $row) {
            if ($row[0] == $tableName) {
                return true;
            }
        }
        return false;
    }
    
    /** 
     * Install migration system 
     * @TODO test
     */
    function installMigrations(\PDO $pdo) {
        $TABLE_NAME = $this->config['migration_table'];
        $sql = <<<END_SQL
                create table if not exists $TABLE_NAME (
                    name varchar(255) NOT NULL,
                    batch integer NOT NULL,
                    primary key (name)
                );
END_SQL;
        $stm = $pdo->prepare($sql);
        return $stm->execute();
    }

}
