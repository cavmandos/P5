<?php
require_once('./views/common/headerUpdatePostView.php');
?>

<div class="bg-light">
    <div class="container py-4">
    <form>

  <!-- Title -->
  <div class="form-outline mb-4">
    <label class="form-label" for="title">Titre du post</label>
    <input type="text" id="title" class="form-control" />
  </div>

  <!-- Introduction -->
  <div class="form-outline mb-4">
    <label class="form-label" for="intro">Chapô</label>
    <textarea class="form-control" id="intro" rows="4"></textarea>
  </div>

  <!-- Article -->
  <div class="form-outline mb-4">
    <label class="form-label" for="text">Corps du post</label>
    <textarea class="form-control" id="text" rows="16"></textarea>
  </div>

  <!-- Buttons -->
  <div class="d-flex justify-content-around">
    <button type="submit" class="btn btn-secondary btn-block mb-4">Modifier</button>
    <button type="button" class="btn btn-secondary btn-block mb-4">Supprimer</button>
    <a href="commentaires" class="btn btn-warning btn-block mb-4">Commentaires</a>
  </div>
</form>
    </div>
</div>