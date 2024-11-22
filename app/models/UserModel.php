<?php

class UserModel {
    use Model;

    protected $table = 'users';
    
    public $allowedColumns = [
        'email',
        'password',
    ];

    public function validate($data) 
    {
        $this->errors = [];
        if(empty($data['email']))
        {
            $this->errors['email'] = "Email is reqired";
        } 
        else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Email is not valid";
        }

        // validate password
        if(empty($data['password']))
        {
            $this->errors['password'] = "Password is required";
        } 

        // validate term
        if(empty($data['terms']))
        {
            $this->errors['terms'] = "Please accept the term and conditions";
        } 
        
        if(empty($this->errors))
        {
            return true;
        }
        return false;
    }
}