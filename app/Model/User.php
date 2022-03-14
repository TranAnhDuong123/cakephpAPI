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

    public function beforeSave($options = array()) {
        // Use bcrypt
        if (isset($this->data['User']['password'])) {
            $hash = Security::hash($this->data['User']['password'], 'blowfish');
            $this->data['User']['password'] = $hash;
        }
        return true;
    }
    public function matchPasswords($data){
        if($this->data['User']['password']==$this->data['User']['confirm_password']){
            return true;
        }
        $this->invalidate('confirm_password', 'Không trùng khớp mật khẩu');
        return false;
    }
    public function checkPassword($data){
        $currentUser = $this->find('first', array('conditions'=>array('User.id= '.AuthComponent::user('id'))));
        $hashPass = Security::hash($data['currentpassword'], 'blowfish', $currentUser['User']['password']);
        if($currentUser['User']['password'] == $hashPass){
            return true;
        }
        return false;
    }
}
