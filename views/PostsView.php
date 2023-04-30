<?php
require_once('./views/common/headerPosts.php');
?>

<div class="bg-light">
    <div class="container py-4">
        <?php $datas = array_reverse($datas);
        foreach ($datas as $ligne):
        $title = $ligne['title']; $summary = $ligne['summary']; $username = $ligne['username']; $creationDate = $ligne['creation_date']; $idPost = $ligne['id_post'];
        ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>
                    <p class="card-text"><?= htmlspecialchars($summary, ENT_QUOTES, 'UTF-8') ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Par <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?> le <?= htmlspecialchars($creationDate, ENT_QUOTES, 'UTF-8') ?></p>
                        <a href="article&amp;id=<?= htmlspecialchars($idPost, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-secondary stretched-link rounded">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>