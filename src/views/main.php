<!DOCTYPE html>
<html>
    <head>
        <title>Comments</title>
    </head>
    <body>
        <div class="main-wrapper">
            <?php foreach ($commentsByCategory as $category=>$comments): ?>
                <div class="category">
                    <h3>Comments category: <?= $category ?></h3>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment">
                            <?= $comment->comments // looks confusing because text column in the table is called 'comments', but we can pretend it says $comment->text ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>  
    </body>
    <?php

    ?>
</html>