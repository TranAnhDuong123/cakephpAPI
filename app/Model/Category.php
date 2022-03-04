<?php
class Category extends AppModel {
    var $name='Category';
    public $actsAs = array('Tree');
    public $validate = array(
        'name' =>array(
            'not empty' => array(
                'rule' => 'notBlank',
                'message' => 'Name is required'
            )
        ),
        'id' => array(
            'Match Id' => array(
                'rule' => 'matchId',
                'message' => 'ID match failed'
            ),
            'not empty' => array(
                'rule' => 'notBlank',
                'message' => 'ID is required'
            )
        )
    );
}