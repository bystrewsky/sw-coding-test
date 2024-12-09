<?php
require __DIR__ . '/../models/Comment.php';
require __DIR__ . '/../controllers/CommentController.php';

class App {
    private $db;

    public function __construct() {
        $this->connectDatabase();
    }

    private function connectDatabase() {
        $db_config = require __DIR__ . '/../../config/db.php';

        try {
            $this->db = new PDO( 
                "mysql:host={$db_config['host']};dbname={$db_config['dbname']}",
                $db_config['username'],
                $db_config['password'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die('Failed to connect to the database: ' . $e->getMessage());
        }
    }

    public function run() {
        $commentModel = new Comment($this->db);
        $commentController = new CommentController($commentModel);
        
        // Uncomment one of the following lines to populate/reset Ship Date
        
        // $commentController->resetShipDate();
        $commentController->populateShipDate();
        
        $commentController->index();
    }
}

?>