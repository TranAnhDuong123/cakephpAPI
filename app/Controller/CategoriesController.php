<?php
App::uses('AppController','Controller');
class CategoriesController extends AppController
{
    public function listCategory(){
        $response = $this->Category->find('all');
        $this->apiResponse(200,$response);
    }

    public function addCategory(){
        $requestData = $this->request->data; 
        $response = $this->Category->save($requestData);
        $this->apiResponse(200,$response);
    }

    public function editCategory($id){
        $this->Category->id = $id;
        $requestData = $this->request->data;
        $response = $this->Category->save($requestData);
        $this->apiResponse(200,$response);
    }

    public function delCategory($id){
        $response = $this->Category->delete($id);
        $this->apiResponse(200,$response);
    }
}