<?php
App::uses('AppController','Controller');
class CategoriesController extends AppController
{
    var $name = "Categories";
    var $components = array('Session');
    var $helpers = array('Paginator','Html'); 
    

    public function listCategory($page = 2){
        $requestQuery = $this->request->query;
        $query = array();
        if(isset($requestQuery['limit'])){
            $query['limit'] = (!empty($requestQuery['limit'])) ? $requestQuery['limit'] : 3;
        }
        if(isset($requestQuery['page'])){
            $query['page'] = (!empty($requestQuery['page'])) ? $requestQuery['page'] : 1;
        }
        if(isset($requestQuery['keyword']) && !empty($requestQuery['keyword'])){
            $query['conditions'] = array(
                'name like' => '%'.$requestQuery['keyword'].'%'
            );
        }
        if(isset($requestQuery['sort']) && !empty($requestQuery['sort'])){
            // if(strpos($requestQuery['sort'], '.'))
            $explode = explode('.', $requestQuery['sort']);
            $query['order'] = (!empty($explode['1'])) ? array($explode[0] => $explode[1]) : array($explode[0] => 'desc');
        } 
        $this->paginate = $query;
        $response = $this->paginate("Category");
        $this->apiResponse(200,$response);
    }

    public function searchCategory(){
        $requestData = $this->request->data;
        if($requestData && isset($requestData['keyword'])){ 
            $response = $this->Category->find('all', array(
                'conditions' => array(
                    'name like' => '%'.$requestData['keyword'].'%',
                    //'description like' => '%'.$requestData['keyword'].'%'
                )
            ));
            if(!empty($response)){ 
                $this->apiResponse(200,$response);
            }
            else{
                $errors = array('No results returned');
                $this->apiResponse(400,$errors);
            }
        }
        else{
            $errors = array('keyword does not exist');
            $this->apiResponse(400,$errors);
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