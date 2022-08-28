<?php

// db connection
include(BASE_PATH.'requests/connection.php');

Class User 
{
    public $fillable = [
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'password' => null
    ];

    private $pdo;

    private $table = 'app_users';

    public function __construct()
    {
        $connectionObj = new Connection;
        $this->pdo = $connectionObj->connect();
    }

    public function save($request)
    {
        try 
        {
            // prepare data 
            $this->prepareDataToSave($request);
            
            // get column string
            $colString = implode(',', array_keys($this->fillable));
            
            // insert data
            $sql = "INSERT INTO  " . $this->table . " (" . $colString . ") VALUES (:first_name, :last_name, :email, :password)";
            return $this->pdo->prepare($sql)->execute($this->fillable);
        } 
        catch (\Throwable $th) 
        {
            throw $th;
        }

    }

    public function isNewUser($request)
    {
        try 
        {
            $response = null;
            if(isset($request['email']) && !empty($request['email'])) {
                $stmt = $this->pdo->prepare("SELECT * FROM " . $this->table . " WHERE email = :email");
                $stmt->execute([
                    'email' => $request['email'],
                ]); 
                $response = $stmt->fetch();
            } else {
                return false;
            }
    
            return empty($response) ? true : false;
        } 
        catch (\Throwable $th) 
        {
            throw $th;
        }
    }

    public function isValidUser($request)
    {
        try 
        {
            $response = null;
            $stmt = $this->pdo->prepare("SELECT count('id') AS count FROM " . $this->table . " WHERE email = :email AND password = :password");
            $stmt->execute([
                'email' => $request['email'],
                'password' => md5($request['password']),
            ]); 
            $response = $stmt->fetch();
            return !empty($response) && $response['count'] === 1 ? true : false;
        }
        catch (\Throwable $th) 
        {
            throw $th;
        }
    }

    public function getUser()
    {
        try 
        {
            $response = null;
            $stmt = $this->pdo->prepare("SELECT * FROM " . $this->table . " WHERE email = :email AND password = :password");
            $stmt->execute([
                'email' => $_SESSION['user_email'],
                'password' => $_SESSION['user_code'],
            ]); 
            return $stmt->fetch();
        }
        catch (\Throwable $th) 
        {
            throw $th;
        }
    }

    public function prepareDataToSave($request)
    {
        foreach($this->fillable as $key => $value) {
            $request[$key] = ($key === 'password' ? md5($request[$key]) : $request[$key]); 
            $this->fillable[$key] = trim($request[$key]);
        }
    }
}

?>