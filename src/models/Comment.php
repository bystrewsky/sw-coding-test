<?php

class Comment {
    private $db;
    private $tableName = 'sweetwater_test';


    public function __construct(PDO $db) {
       $this->db = $db;
    }

    public function getAllComments() {
        $query = $this->db->prepare("SELECT * FROM `".$this->tableName."`");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}

?>