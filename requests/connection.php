<?php

Class Connection
{
    public $connection = [
        'server'   => 'sql6.freemysqlhosting.net',
        'user'     => 'sql6515721',
        'password' => 'cfiBnVixit',
        'db'       => 'sql6515721',
    ];
    
    public function connect()
    {
        try 
        {
            $conn = new PDO("mysql:host=" . $this->connection['server'] . ";dbname=" . $this->connection['db'], $this->connection['user'], $this->connection['password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch(PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
}

?>