<?php
App::uses('AppController','Controller');
class CategoriesController extends AppController
{
    public function listCategory(){
        $categories = $this->Category->find('all');
        $this->response->type('json');
		$this->response->statusCode(200);
		$this->response->body(json_encode($categories));
        return $this->response->send();
    }

    public function addCategory(){
        $requestData = $this->request->data; 
        $response = $this->Category->save($requestData);
        $this->response->type('json');
        $this->response->statusCode(200);
        $this->response->body(json_encode($response));
        return $this->response->send();
    }

    public function editCategory($id){
        $this->Category->id = $id;
        $requestData = $this->request->data;
        $response = $this->Category->save($requestData);
        $this->response->type('json');
        $this->response->statusCode(200);
        $this->response->body(json_encode($response));
        return $this->response->send();
    }

    public function delCategory($id){
        $categories = $this->Category->delete($id);
        $this->response->type('json');
        $this->response->statusCode(200);
        $this->response->body(json_encode($categories));
        return $this->response->send();
    }
}