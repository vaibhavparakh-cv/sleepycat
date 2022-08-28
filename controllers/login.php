<?php

include(BASE_PATH.'models/user.php');

Class Login
{
    protected $userObj;
    
    public function __construct()
    {
        $this->userObj = new User();
    }

    public function login($request)
    {
        if($this->validate($request)) {
            if($this->userObj->isValidUser($request)) {
                $_SESSION['message'] = 'User logged in succesfully';
                $_SESSION['redirect'] = true;
                $_SESSION['user_code'] = md5($request['password']);
                $_SESSION['user_email'] = $request['email'];
                $this->checkRememberMe($request);
                return true;
            } else {
                $_SESSION['message'] = USER_NOT_FOUND;
                $_SESSION['redirect'] = false;
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
        }
        return true;
    }

    public function checkRememberMe($request)
    {
        if(isset($request['remember_me']) && $request['remember_me']) {
            $_SESSION['user_login_created'] = time();
        }
    }
}

?>