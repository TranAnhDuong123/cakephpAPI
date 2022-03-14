<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $autoRender = false;
	public $helpers = array('Form', 'Html', 'Time', 'Session', 'Js' => array('Jquery'));

	public $components = array(
		'Session',
		'Auth'=>array(
			'authenticate' => array(
				'Blowfish' => array(
					'userModel' => 'User',
					'fields' => array('name' => 'name', 'password' => 'password'),
				)
			),
			'loginAction' => array('admin'=>true, 'controller'=>'users', 'action'=>'login'),
			'loginRedirect' => array('admin'=>true, 'controller'=>'categories', 'action'=>'listCategory'),
			'logoutRedirect' => array('admin'=>true, 'controller'=>'users', 'action'=>'login'),
			'authError' => 'You can not access that page',
			'authorize' => array('Controller')
		)
	);

    // public function beforeFilter()
    // {
	// 	if ($this->request->is("options")) {
	// 		// Set the headers
	// 		$this->response->header('Access-Control-Max-Age','86400');
	// 		$this->response->header('Access-Control-Allow-Headers','Accept,Origin,User-Agent,Content-Type,Authorization');
	// 		$this->response->header('Access-Control-Allow-Methods','GET,POST,PUT,DELETE,OPTIONS');
	// 		$this->response->header('Access-Control-Allow-Origin','*');

	// 		$this->response->send();
	// 		$this->_stop();
	// 	} else {
	// 		$this->response->header('Access-Control-Allow-Methods','GET,POST,PUT,DELETE,OPTIONS');
	// 		$this->response->header('Access-Control-Allow-Origin','*');
	// 	}

	// 	parent::beforeFilter();
	// }

	public function beforeFilter(){
		if($this->params['prefix'] == "admin"){
            if($this->Auth->loggedIn()){
                $this->Auth->allow();
            }
        }else{
            $this->Auth->allow();
        }
		$this->set('current_user', $this->Auth->user());
	}

    public function apiResponse($status, $response){
        $this->response->type('json');
        $this->response->statusCode($status);
        $this->response->body(json_encode($response));
    }

	
}
