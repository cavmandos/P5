<?php
require_once('./views/common/headerAdmin.php');
?>

<div class="bg-light">
    <div class="container my-4">
        <!-- New Post -->
        <div class="card mb-5">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <p>Envie d'impressionner la galerie ?</p>
                    <a href="nouveau-post" class="btn btn-secondary rounded">Créer un post</a>
                </div>
            </div>
        </div>
        <!-- Posts -->
        <?php $datas = array_reverse($datas);
        foreach ($datas as $ligne) : ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <h2 class="card-title"><?= $ligne['title'] ?></h2>
                        <a href="modifier-post&amp;id=<?= $ligne['id'] ?>" class="btn btn-warning rounded-2 p-2">Modifier / Supprimer</a>
                    </div>
                    <p class="card-text"><?= $ligne['summary'] ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Par <?= $ligne['username'] ?> le <?= $ligne['creation_date'] ?></p>
                        <a href="article&amp;id=<?= $ligne['id'] ?>" class="btn btn-secondary rounded">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>