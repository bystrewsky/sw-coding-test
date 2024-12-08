<!DOCTYPE html>
<html>
    <head>
        <title>Comments</title>
    </head>
    <body>
        <div class="main-wrapper">
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <?= $comment->comments ?>
                </div>
            <?php endforeach; ?>
        </div>  
    </body>
    <?php

    ?>
</html>