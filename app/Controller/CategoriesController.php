<?php
App::uses('AppController','Controller');
class CategoriesController extends AppController
{
    var $name = "Categories";
    var $components = array('Session');
    var $helpers = array('Paginator','Html'); 
    

    public function listCategory($page = 2){
        $requestQuery = $this->request->query;
        if(isset($requestQuery['limit']) && !empty($requestQuery['limit'])){
            $response = $this->Category->find('all');
            $this->paginate = array(
                'limit' => $requestQuery['limit'],
                'order' => array('id' => 'desc'),
                'page' => $requestQuery['page'],
            );
            $response = $this->paginate("Category");
            $this->apiResponse(200,$response);
        }
        else{
            $response = $this->Category->find('all');
            $this->apiResponse(200,$response);
        }
    }

    public function addCategory(){
        $requestData = $this->request->data; 
        $this->Category->set($requestData);
        if($requestData && isset($requestData['name'])){       
            if($this->Category->valid()== TRUE){
                $response = $this->Category->save($requestData);
                $this->apiResponse(200,$response);
            }else{
                $error = $this->Category->validationErrors;
                $this->apiResponse(400,$error);
            }
        }
        else{
            $errors = array('Name does not exist');
            $this->apiResponse(400,$errors);
        }
    }

    public function editCategory($id){
        $result = $this->Category->findById($id);
        if(!empty($result)){
            $this->Category->id = $id;
            $requestData = $this->request->data;
            $this->Category->set($requestData);
            if($requestData && isset($requestData['name'])){       
                if($this->Category->valid()== TRUE){
                    $response = $this->Category->save($requestData);
                    $this->apiResponse(200,$response);
                }else{
                    $error = $this->Category->validationErrors;
                    $this->apiResponse(400,$error);
                }
            }
            else{
                $errors = array('Name does not exist');
                $this->apiResponse(400,$errors);
            }
        }
        else{
            $errors = array('ID match failed');
            $this->apiResponse(400,$errors);
        }

    }

    public function delCategory($id){
        $result = $this->Category->findById($id);
        if(!empty($result)){
            $response = $this->Category->delete($id);
            $this->apiResponse(200,$response);
        }
        else{
            $errors = array('ID match failed');
            $this->apiResponse(400,$errors);
        }
    }
}