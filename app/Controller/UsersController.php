<?php
App::uses('AppController','Controller');
class UsersController extends AppController
{
    var $uses = array('User');
    var $layout = 'admin';
    // var $name = "Users";
    // var $components = array('Session');
    //var $helpers = array('Paginator','Html'); 
    public function beforeFilter(){
        parent::beforeFilter();
    }

    // public function login(){
    //     $requestData = $this->request->data;
    //     if($this->Session->check("session")){
    //         $error = "The machine is already logged in. If you want to log in again, please logout";
    //         $this->apiResponse(400, $error);
    //     }
    //     else{
    //         if(isset($requestData['name']) && isset($requestData['password']) && !empty($requestData['name']) && !empty($requestData['password'])){
    //             $checkLogin = $this->User->find('all', array(
    //                 'conditions' => array(
    //                     'name' => $requestData['name'],
    //                     'password' => md5($requestData['password'])
    //                 )
    //             ));
    //             if(!empty($checkLogin)){
    //                 $response = $this->Session->write("session",$requestData['name']);
    //                 $this->apiResponse(200,$checkLogin);
    //             }
    //             else{
    //                 $error = "name and password fail";
    //                 $this->apiResponse(400,$error);
    //             }
    //         }
    //         else{
    //             $error = "Name and password are not empty";
    //             $this->apiResponse(400,$error);
    //         }
    //     }
    // }

    // public function logout(){
    //     if($this->Session->check("session")){
    //         // $name = $this->Session->read('session');
    //         $response = $this->Session->delete('session');
    //         $this->apiResponse(200,$response);
    //     }
    //     else{ 
    //         $error = "Not logged in yet";
    //         $this->apiResponse(400,$error);
    //     }
    // }

    public function admin_login(){
        $requestData = $this->request->data;
        if($requestData){;
            if($this->Auth->login()){
                die('123');
            }
            else{
                die('456');
            }
        }
    }
}