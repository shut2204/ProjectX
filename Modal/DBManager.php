<?php

namespace Database;
require_once 'ConferenceDAO.php';

class DBManager
{
    private $dbn;

    private static ?DBManager $instance = null;

    public static function getInstance(): self
    {
        if (!self::$instance){
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->connect();
    }

    private function connect(): void
    {
        $config = require_once 'config.php';

        $dsn = 'mysql:host='. $config['host'].';dbname='.$config['db_name'].';charset='.$config['charset'];
        try {
            $this->dbn = new \PDO($dsn, $config['username'], $config['password']);
        }catch (\Exception $e){
            echo $e->getMessage();
        }

    }

    public function execute($sql){
        $sth = $this->dbn->prepare($sql);

        return $sth->execute();
    }

    public function getDbn()
    {
        return $this->dbn;
    }

    public function query($sql): array
    {
        $sth = $this->dbn->prepare($sql);

        $sth->execute();

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if ($result === false){
            return [];
        }

        return $result;
    }
}