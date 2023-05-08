<?php
require_once('./views/common/headerPosts.php');
?>

<div class="bg-light">
    <div class="container py-4">
        <?php $datas = array_reverse($datas);
        foreach ($datas as $ligne) :
            $date = htmlspecialchars($ligne['creation_date'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $date = date("d.m.Y", strtotime($date));
        ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($ligne['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></h2>
                    <p class="card-text"><?= htmlspecialchars($ligne['summary'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Par <?= htmlspecialchars($ligne['username'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?> le <?= $date ?></p>
                        <a href="article&amp;id=<?= htmlspecialchars($ligne['id_post'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?>" class="btn btn-secondary stretched-link rounded">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>