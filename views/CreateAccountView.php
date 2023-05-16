<?php
    require_once './views/common/headerCreateAccount.php';
?>

<main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p>Créer son compte, afin de commenter les posts du BlogFL.<br />
                    Vos commentaires seront soumis à validation par nos modérateurs.</p>
                        <div class="my-5">
                            <form id="create-account" method="POST" action="validation_nouveau_compte">
                                <div class="form-floating">
                                    <input class="form-control" id="firstname" type="text" name="firstname" placeholder="Entrez votre prénom..." required />
                                    <label for="firstname">Prénom</label>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="lastname" type="text" name="lastname" placeholder="Entrez votre nom..." required/>
                                    <label for="lastname">Nom</label>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="username" type="text" name="username" placeholder="Entrez votre pseudo..." required/>
                                    <label for="username">Pseudo</label>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Entrez votre adresse email..." required />
                                    <label for="email">Adresse email</label>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="password" type="password" name="password" placeholder="Entrez votre mot de passe..." required />
                                    <label for="password">Mot de passe</label>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="confirm-password" type="password" name="confirm-password" placeholder="Confirmez votre mot de passe..." required />
                                    <label for="confirm-password">Confirmation du mot de passe</label>
                                </div>
                                <br />
                                <button class="btn btn-secondary text-uppercase rounded" id="submitButton" type="submit">S'inscrire</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>