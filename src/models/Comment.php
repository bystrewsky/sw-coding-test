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

    public function populateShipDate() {
        $getCommentsQuery = $this->db->prepare("SELECT * FROM `".$this->tableName."` WHERE `comments` LIKE :keyword");
        $updateQuery = $this->db->prepare("UPDATE `".$this->tableName."` SET `shipdate_expected` = :shipdate WHERE `orderid` = :id");

        $getCommentsQuery->execute(['keyword'=>'%Ship Date:%']);

        $comments = $getCommentsQuery->fetchAll(PDO::FETCH_OBJ);

        foreach ($comments as $comment) {
            $datePattern = '/Expected Ship Date: (\d{2}\/\d{2}\/\d{2})/';
            if (preg_match($datePattern, $comment->comments, $matches)) {
                $date = $matches[1];

                $updateQuery->execute(['shipdate'=>date('Y-d-m H:i:s', strtotime($date)), 'id'=>$comment->orderid]);
            }
        }
    }

    public function resetShipDate() {
        $query = $this->db->prepare("UPDATE `".$this->tableName."` SET `shipdate_expected` = NULL WHERE `orderid` > 0");
        $query->execute();
    }

}

?>