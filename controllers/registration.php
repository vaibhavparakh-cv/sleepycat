<?php

include(BASE_PATH.'models/user.php');

Class Registration
{
    protected $userObj;
    
    public function __construct()
    {
        $this->userObj = new User();
    }

    public function register($request)
    {
        if($this->validate($request)) {
            if($this->userObj->isNewUser($request)) {
                $response = $this->userObj->save($request);
                if($response) {
                    $_SESSION['message'] = 'User registered successfully!! Login to continue.';
                    $_SESSION['redirect'] = true;   
                    return true;
                } else {
                    $_SESSION['message'] = TRY_AGAIN;
                    $_SESSION['redirect'] = false;
                }
            } else {
                $_SESSION['message'] = USER_EXIST;
                $_SESSION['redirect'] = true;
            }
        } else {
            $_SESSION['message'] = INVALID_DETAILS;
            $_SESSION['redirect'] = false;
        }
        return false;
    }

    public function validate($request)
    {
        foreach($request as $key => $value) {
            if($key == 'email' && empty($value)) {
                return false;
            }

            if($key == 'password' && empty($value)) {
                return false;
            }

            if($key == 'first_name' && empty($value)) {
                return false;
            }
        }
        return true;
    }
}

?>