<?php

enum CommentCategory: String {
    case CANDY = 'Candy';
    case CALLS = 'Calls';
    case REFERRAL = 'Referral';
    case SIGNATURE = 'Signature';
    case MISC = 'Miscellaneous';
}

class CommentController {
    private $model;
    private $categorySearchPatterns = [
        CommentCategory::CANDY->value => '/candy|smarties|tootsie|taffy/',
        CommentCategory::CALLS->value => '/call me|please call|phone call/',
        CommentCategory::REFERRAL->value => '/referred|referral/',
        CommentCategory::SIGNATURE->value => '/signature/',
    ];


    public function __construct(Comment $commentModel)
    {
        $this->model = $commentModel;
    }
    
    public function index() {
        $commentsUnsorted = $this->model->getAllComments();

        $commentsByCategory = [
            CommentCategory::CANDY->value => [],
            CommentCategory::CALLS->value => [],
            CommentCategory::REFERRAL->value => [],
            CommentCategory::SIGNATURE->value => [],
            CommentCategory::MISC->value => []
        ];

        foreach ($commentsUnsorted as $comment) { 
            $text = strtolower($comment->comments);
            
            //this allows to add more categories/search patterns and keep this piece of code unchanged
            foreach ($this->categorySearchPatterns as $key => $searchPattern) {
                if(preg_match($searchPattern, $text)) {
                    $commentsByCategory[$key][] = $comment;
                    continue 2;
                }
            }

            $commentsByCategory[CommentCategory::MISC->value][] = $comment;
        }

        return require __DIR__ .'/../views/main.php';
    }

    public function populateShipDate() {
        $this->model->populateShipDate();
    }

    public function resetShipDate() {
        $this->model->resetShipDate();
    }
}

?>