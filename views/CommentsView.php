<?php
require_once('./views/common/headerComments.php');
?>

<div class="bg-light">
    <?php $comments = array_reverse($comments);
    foreach ($comments as $ligne) : ?>
        <div class="container d-flex justify-content-end py-2 px-2">
            <div class="col-12 card mb-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="validation_OK_commentaire&amp;id=<?php Security::escapeOutput($ligne["id_comment"]) ?>" class="btn btn-success btn-block mx-2">Valider</a>
                            <a href="validation_NO_commentaire&amp;id=<?php Security::escapeOutput($ligne["id_comment"]) ?>" class="btn btn-secondary btn-block">Supprimer</a>
                        </div>
                        <div class="px-3 d-flex flex-column align-items-end">
                            <p class="bg-secondary rounded p-2 text-light m-2">Par <?php Security::escapeOutput($ligne['username']) ?> le <?php Security::escapeOutput($ligne['creation_date']) ?></p>
                            <div class="d-flex align-items-center justify-content-end">
                            <p class="m-2"><?php Security::escapeOutput($ligne['comment_content']) ?></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php
        if(empty($comments)){
            echo "<p class='text-center'>Il n'y a aucun commentaire en attente d'approbation</p>";
        }
    ?>
</div>