<?php
require_once('./views/common/headerPosts.php');
?>

<div class="bg-light">
    <div class="container py-4">
        <?php $datas = array_reverse($datas);
        foreach ($datas as $ligne) : 
        $title = htmlspecialchars($ligne['title']);
        $summary = htmlspecialchars($ligne['summary']);
        $username = htmlspecialchars($ligne['username']);
        $creationDate = htmlspecialchars($ligne['creation_date']);
        $idPost = htmlspecialchars($ligne['id_post']);
        ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><?= $title ?></h2>
                    <p class="card-text"><?= $summary ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Par <?= $username ?> le <?= $creationDate ?></p>
                        <a href="article&amp;id=<?= $idPost ?>" class="btn btn-secondary stretched-link rounded">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>