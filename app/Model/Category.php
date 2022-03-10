<?php
class Category extends AppModel {
    var $name='Category';
    public $actsAs = array('Tree');
    function valid(){
        $this->validate = array(
           "name" => array(
                "rule" => "notBlank",
                "message" => "Name not empty !",
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
        if($this->validates($this->validate)) // nếu dữ liệu đã được validate (hợp lệ)
            return TRUE;
        else
            return FALSE;
    }
    function checkLogin($name,$description){
        $sql = "select name,description from categories where name='$name' and description='$description'";
        $this->query($sql);
        if($this->getNumRows()==0){
            return false;
        }
        else{
            return true;
        }
    }
}