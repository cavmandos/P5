<?php
require_once './views/common/headerSinglePost.php';
$date = date("d.m.Y", strtotime($datas[0]['creation_date']));
?>

<div class="bg-light">
    <div class="container py-4 px-2">
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title text-center"><?= Security::escapeOutput($datas[0]['title']) ?></h2>
                <div class="d-flex align-items-center justify-content-center">
                    <p class="text-secondary mt-0">Par <?= Security::escapeOutput($datas[0]['username']) ?> le <?= Security::escapeOutput($date) ?></p>
                </div>
                <p class="card-text h4"><?= Security::escapeOutput($datas[0]['summary']) ?></p>
                <p class="card-text"><?= Security::escapeOutput($datas[0]['content']) ?></p>
            </div>
        </div>
    </div>
    <?php $comments = array_reverse($comments);
    foreach ($comments as $ligne) :
        $date2 = date("d.m.Y", strtotime($ligne['creation_date']));
    ?>
        <div class="container d-flex justify-content-end py-2 px-2">
            <div class="col-12 col-md-10 card mb-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-end">
                        <p class="bg-secondary rounded p-2 text-light m-2">Par <?= Security::escapeOutput($ligne['username']) ?> le <?= Security::escapeOutput($date2) ?></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <p class="m-2"><?= Security::escapeOutput($ligne['comment_content']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php
    $session = $_SESSION['login'];
    if (isset($session) === TRUE) {
        $idPost = Security::escapeOutput($datas[0]["id_post"]);
        echo '<div class="container py-4">
        <form id="create-comment" method="POST" action="validation_nouveau_commentaire&amp;id=' . $idPost . '">
        <!-- Comment -->
        <div class="form-outline mb-4">
            <label class="form-label" for="comment">Votre commentaire</label>
            <textarea class="form-control" name="comment" id="comment" rows="4" required></textarea>
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-secondary btn-block mb-4">Commenter</button>
        </form>
    </div>';
    }
    ?>
</div>