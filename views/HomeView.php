<?php require_once('./views/common/header.php'); ?>

<div class="bg-light">
    <div class="container py-4">
        <!-- Display only 3 posts -->
        <?php for($i=0; $i<3; $i++) : ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><?= $datas[$i]['title'] ?></h2>
                    <p class="card-text"><?= $datas[$i]['summary'] ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Par <?= $datas[$i]['username'] ?> le <?= $datas[$i]['creation_date'] ?></p>
                        <a href="article" class="btn btn-secondary stretched-link rounded">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endfor; ?>

        <div class="row my-4 justify-content-around">
            <div class="col-lg-5 col-12 border rounded p-5 bg-white">
                <div class="d-flex flex-column align-items-center justify-content-around">
                    <img src="./public/assets/img/photo.jpg" class="rounded-circle" alt="Photo d'un curieux personnage" height="120px">
                    <p class="h3 my-3">Franck Lebeau</p>
                    <p class="my-1">Développeur PHP/Symfony</p>
                    <a href="#" class="btn btn-secondary mt-5 rounded">Télécharger le CV</a>
                </div>
            </div>
            <div class="col-lg-6 col-12 border rounded p-5 bg-white mt-4 mt-lg-0">
                <h3>Contactez-moi</h3>
                <form id="create-account">
                    <div class="form-floating">
                        <input class="form-control" id="firstname" type="text" placeholder="Entrez votre prénom..." required />
                        <label for="firstname">Prénom</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" id="lastname" type="text" placeholder="Entrez votre nom..." required />
                        <label for="lastname">Nom</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" id="email" type="email" placeholder="Entrez votre adresse email..." required />
                        <label for="email">Adresse email</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" id="subject" placeholder="Ecrire sa demande" style="height:200px" required></textarea>
                        <label for="email">Votre demande</label>
                    </div>
                    <br />
                    <button class="btn btn-secondary text-uppercase rounded" id="submitButton" type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</div>