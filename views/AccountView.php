<?php

require_once './views/common/headerAccount.php';
$login = empty($_SESSION['login']) ? $_SESSION['login'] : FALSE;

if (isset($login) === FALSE) {
    echo '<div class="loginForm">
        <form method="POST" action="validation_login" class="form-signin">
            <div class="d-flex align-items-center mb-3">
                <img class="mx-2" src="./public/assets/img/Logo2.png" alt="Logo du blog" width="30" height="30">
                <h2 class="h3 mb-0 font-weight-normal mx-1">J\'ai un compte</h2>
            </div>
            <label for="email" class="sr-only">Adresse email</label>
            <input type="email" id="email" name="email" class="form-control mb-2" placeholder="Adresse email" required autofocus>
            <label for="password" class="sr-only">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control mb-3" placeholder="Mot de passe" required>
            <button class="btn btn-lg btn-secondary btn-block rounded-pill mx-auto w-100" type="submit">Se connecter</button>
        </form>
    </div>
    
    <!-- Create account -->
    <div class="py-5">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center mb-3">
            <h2 class="h3 mb-0 font-weight-normal mx-3">Je n\'ai pas encore de compte</h2>
            <p class="text-center"><a class="btn btn-lg btn-secondary btn-block rounded-pill mx-auto" href="nouvel-utilisateur">Créer un compte</a></p>
        </div>
    </div>';
} else {
    $firstname = Security::escapeOutput($datas[0]["first_name"]);
    $email = Security::escapeOutput($datas[0]["email"]);
    echo '<div class="bg-light">
    <div class="container py-4">
        <h2 class="text-center">Bonjour '.$firstname.'</h2>
        <div id="mail" class="d-flex justify-content-center align-items-center">
        <p class="text-center my-3 mx-2">Votre email : '.$email.'</p>
            <button class="btn btn-primary rounded px-3" id="btnUpdateMail">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
            </button>
        </div>
        <div id="updateMail" class="d-none">
            <form method="POST" action="validation_modification_mail">
                <div class="row justify-content-center align-items-center">
                    <label for="email" class="col-md-2 col-12 col-form-label text-center">Modifier :</label>
                    <div class="col-md-5 col-9">
                        <input type="email" class="form-control" name="email" value="'.$email.'" />
                    </div>
                    <div class="col-2">
                        <button class="btn btn-success rounded px-3" id="btnConfirmUpdate" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-center my-3">
            <button id="btnDeleteAccount" class="btn btn-danger">Supprimer son compte</button>
        </div>
        <div id="deleteAccount" class="d-none my-2">
            <div class="alert alert-danger d-flex flex-column justify-content-center align-items-center">
                <p class="my-1">Veuillez confirmez la suppression du compte</p>
                <a href="suppression_compte" class="btn btn-danger">Je supprime</a>
            </div>
        </div>
        <p class="text-center my-2">Votre statut : ';
    if ($datas[0]["is_admin"] == 1) {
        echo "administrateur";
    } else {
        echo "inscrit";
    };
    echo '</p>
        <p class="text-center"><a class="btn btn-lg btn-secondary btn-block rounded-pill mx-auto" href="deconnexion">Se déconnecter</a></p>
    </div>
    </div>';
}
