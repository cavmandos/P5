<?php
require_once('./views/common/headerUpdatePostView.php');
?>

<div class="bg-light">
  <div class="container py-4">
    <form id="update-post" method="POST" action="validation_modifier_post&amp;id=<?php Security::escapeOutput($datas[0]["id_post"]) ?>">

      <!-- Title -->
      <div class="form-outline mb-4">
        <label class="form-label" for="title">Titre du post</label>
        <input type="text" id="title" class="form-control" name="title" value="<?php Security::escapeOutput($datas[0]["title"]) ?>"  />
      </div>

      <!-- Introduction -->
      <div class="form-outline mb-4">
        <label class="form-label" for="intro">Chapô</label>
        <textarea class="form-control" id="intro" rows="4" name="intro" ><?php Security::escapeOutput($datas[0]["summary"]) ?></textarea>
      </div>

      <!-- Article -->
      <div class="form-outline mb-4">
        <label class="form-label" for="text">Corps du post</label>
        <textarea class="form-control" id="text" rows="16" name="text" ><?php Security::escapeOutput($datas[0]["content"]) ?></textarea>
      </div>

      <!-- Buttons -->
      <div class="d-flex justify-content-around">
        <button type="submit" class="btn btn-secondary btn-block mb-4">Modifier</button>
        <a href="validation_supprimer_post&amp;id=<?php Security::escapeOutput($datas[0]["id_post"]) ?>" class="btn btn-secondary btn-block mb-4">Supprimer</a>
        <a href="commentaires&amp;id=<?php Security::escapeOutput($datas[0]["id_post"]) ?>" class="btn btn-warning btn-block mb-4">Commentaires</a>
      </div>
    </form>
  </div>
</div>