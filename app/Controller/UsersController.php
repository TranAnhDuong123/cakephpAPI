<?php
class UsersController extends AppController
{
    var $name = "Users";
    var $components = array('Session');
    var $helpers = array('Paginator','Html'); 

    public function login(){
        $requestData = $this->request->data;
        if($this->Session->check("session")){
            $error = "The machine is already logged in. If you want to log in again, please log out";
            $this->apiResponse(400, $error);
        }
        else{
            if(isset($requestData['name']) && isset($requestData['password']) && !empty($requestData['name']) && !empty($requestData['password'])){
                $name = $requestData['name'];
                $password = md5($requestData['password']);
                if($this->User->checkLogin($name,$password)){
                    $response = $this->Session->write("session",$name);
                    $this->apiResponse(200,$response);
                }
                else{
                    $error = "name and password fail";
                    $this->apiResponse(400,$error);
                }
            }
            else{
                $error = "Name and password are not empty";
                $this->apiResponse(400,$error);
            }
        }
    }

    public function logout(){
        if($this->Session->check("session")){
            // $name = $this->Session->read('session');
            $response = $this->Session->delete('session');
            $this->apiResponse(200,$response);
        }
        else{ 
            $error = "Not logged in yet";
            $this->apiResponse(400,$error);
        }
    }

}