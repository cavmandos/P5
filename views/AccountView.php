<?php
    require_once('./views/common/headerAccount.php');
?>

<div class="loginForm">
    <form class="form-signin">
    <div class="d-flex align-items-center mb-3">
        <img class="mx-2" src="./public/assets/img/Logo2.png" alt="Logo du blog" width="30" height="30">
        <h2 class="h3 mb-0 font-weight-normal mx-1">J'ai un compte</h2>
    </div>
    <label for="inputEmail" class="sr-only">Adresse email</label>
    <input type="email" id="inputEmail" class="form-control mb-2" placeholder="Adresse email" required autofocus>
    <label for="inputPassword" class="sr-only">Mot de passe</label>
    <input type="password" id="inputPassword" class="form-control mb-3" placeholder="Mot de passe" required>
    <button class="btn btn-lg btn-secondary btn-block rounded-pill mx-auto w-100" type="submit">Se connecter</button>
    </form>
</div>

<div class="py-5">
<div class="d-flex flex-column flex-md-row align-items-center justify-content-center mb-3">
        <h2 class="h3 mb-0 font-weight-normal mx-3">Je n'ai pas encore de compte</h2>
        <p class="text-center"><a class="btn btn-lg btn-secondary btn-block rounded-pill mx-auto" href="nouvel-utilisateur">Créer un compte</a></p>
    </div>
</div>