<?php
class User extends AppModel{
    var $name = "User";
    public $validate = array(
        'username' =>array(
            'too long'=>array(
                'rule' => array('between', 5, 32),
                'message' => 'Username must be more than 5 characters'
            ),
            'not empty' => array(
                'rule' => 'notBlank',
                'message' => 'Username is not empty'
            ),
            'duplicate username' => array(
                'rule'=>'isUnique',
                'message' => 'Username already has users'
            )
        ),
        'password' => array(
            'too long' => array(
                'rule' => array('between', 6, 32),
                'message' => 'Password must be between 6 and 32 characters'
            ),
            'not empty' => array(
                'rule' => 'notBlank',
                'message' => 'Password does not empty'
            ),
            'Match Password' => array(
                'rule' => 'matchPasswords',
                'message' => 'Password does not match'
            )
        ),
        'email' => array(
            'valid email' => array(
                'rule' => 'email',
                'message' => 'Enter a valid email address'
            ),
            'duplicate email' => array(
                'rule'=>'isUnique',
                'message' => 'Email already has users'
            )
        ),
        'name' => array(
            'not empty' => array(
                'rule' => 'notBlank',
                'message' => 'Name does not blank'
            )
        )
    );

    function checkLogin($name,$password){
        $sql = "select name,password from users where name='$name' and password='$password'";
        $this->query($sql);
        if($this->getNumRows()==0){
            return false;
        }
        else{
            return true;
        }
    }
}