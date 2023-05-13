<?php
require_once './views/common/headerCreatePost.php';
?>

<div class="bg-light">
  <div class="container py-4">
    <form id="create-post" method="POST" action="validation_nouveau_post">
      <!-- Title -->
      <div class="form-outline mb-4">
        <label class="form-label" for="title">Titre du post</label>
        <input type="text" id="title" name="title" class="form-control" required/>
      </div>
      <!-- Introduction -->
      <div class="form-outline mb-4">
        <label class="form-label" for="intro">Chapô</label>
        <textarea class="form-control" name="intro" id="intro" rows="4" required></textarea>
      </div>
      <!-- Article -->
      <div class="form-outline mb-4">
        <label class="form-label" for="text">Corps du post</label>
        <textarea class="form-control" id="text" name="text" rows="16" required></textarea>
      </div>
      <!-- Submit button -->
      <button type="submit" class="btn btn-secondary btn-block mb-4">Publier</button>
    </form>
  </div>
</div>