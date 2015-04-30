<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

class GenericUpdater
{
    protected $tables;
    protected $getArgs;
    protected $fieldList;
    protected $handler;

    public function __construct( array $tableNames, array $getargs ) {
        global $host, $worlddb, $user, $password;

        try 
        {
            $this->handler = new PDO('mysql:host='.$host.';dbname='.$worlddb, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) 
        {
            //echo $e->getMessage();
            die();
        }

        $this->tables = $tableNames;
        $this->getArgs = $getargs;

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
        if(count($this->getArgs) == 0)
        {
            echo "No arguments given.";
            //http_response_code(400); //bad request
            die();
        }

        foreach (array_keys($this->getArgs) as $getKey)
        {
            if(!in_array($getKey, $this->fieldList))
            {
                echo "Argument {$getKey} not in tables fields.";
                //http_response_code(400); //bad request
                die();
            }
        }
    }

    public function apply()
    {

    }
};