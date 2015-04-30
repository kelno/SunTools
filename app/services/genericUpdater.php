<?php

/** 
Generic updater, not a service to be used by itself.
*/

ini_set('display_errors', 'on');
error_reporting(E_ALL);

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require("$root/suntools/dbconfig.php");

class GenericUpdater
{
    protected $tables;
    protected $args;
    protected $fieldList;
    protected $handler;

    public function __construct( array $tableNames, array $_args ) {
        global $host, $worlddb, $user, $password;

        try 
        {
            $this->handler = new PDO('mysql:host='.$host.';dbname='.$worlddb, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) 
        {
            echo $e->getMessage();
            die();
        }

        $this->tables = $tableNames;
        $this->$args = $_args;

        $this->fieldList = array();
        self::fillFieldList();
        self::checkArguments();
    }

    protected function fillFieldList()
    {
        $this->fieldList = array();

        foreach ($this->tables as $table)
        {
            $query = $this->handler->prepare("DESCRIBE {$table}");
            $query->execute();
            $this->fieldList = array_merge($this->fieldList, $query->fetchAll(PDO::FETCH_COLUMN));
        }
    }

    protected function checkArguments()
    {
        if(count($this->$args) == 0)
        {
            echo "No arguments given.";
            die();
        }

        foreach (array_keys($this->$args) as $getKey)
        {
            if(!in_array($getKey, $this->fieldList))
            {
                echo "Argument {$getKey} not in tables fields.";
                die();
            }
        }
    }

    public function apply()
    {
        echo "apply!<br/>";
    }
};