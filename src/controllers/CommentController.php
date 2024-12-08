<?php
enum CommentCategory: String {
    case Candy = 'Candy';
    case Calls = 'Calls';
    case Referral = 'Referral';
    case Signature = 'Signature';
    case Misc = 'Miscellaneous';
}

class CommentController {
    private $model;

    public function __construct(Comment $commentModel)
    {
        $this->model = $commentModel;
    }
    public function index() {
        $comments = $this->model->getAllComments();
        return require __DIR__ .'/../views/main.php';
    }
}

?>