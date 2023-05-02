<?php require_once('./views/common/header.php'); ?>

<div class="bg-light">
    <div class="container py-4">
        <!-- Display only 3 lasts posts -->
        <?php $datas = array_slice($datas, -3);
        foreach(array_reverse($datas) as $ligne) : ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($ligne['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></h2>
                    <p class="card-text"><?= htmlspecialchars($ligne['summary'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p>Par <?= htmlspecialchars($ligne['username'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?> le <?= htmlspecialchars($ligne['creation_date'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></p>
                        <a href="article&amp;id=<?= htmlspecialchars($ligne['id_post'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?>" class="btn btn-secondary stretched-link rounded">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="row my-4 justify-content-around">
            <div class="col-lg-5 col-12 border rounded p-5 bg-white">
                <div class="d-flex flex-column align-items-center justify-content-around">
                    <img src="./public/assets/img/photo.jpg" class="rounded-circle" alt="Photo d'un curieux personnage" height="120px">
                    <p class="h3 my-3">Franck Lebeau</p>
                    <p class="my-1">Développeur PHP/Symfony</p>
                    <p><a href="./public/CV_Lebeau.pdf" class="btn btn-secondary mt-5 rounded" target="_blank">Télécharger le CV</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-12 border rounded p-5 bg-white mt-4 mt-lg-0">
                <h3>Contactez-moi</h3>
                <form id="create-account" method="POST" action="validation_formulaire">
                    <div class="form-floating">
                        <input class="form-control" id="firstname" type="text" name="firstname" placeholder="Entrez votre prénom..." required />
                        <label for="firstname">Prénom</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" id="lastname" type="text" name="lastname" placeholder="Entrez votre nom..." required />
                        <label for="lastname">Nom</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" id="email" type="email" name="email" placeholder="Entrez votre adresse email..." required />
                        <label for="email">Adresse email</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" id="subject" name="subject" placeholder="Ecrire sa demande" style="height:200px" required></textarea>
                        <label for="email">Votre demande</label>
                    </div>
                    <div class="mt-4">
                        <img src="./app/models/Captcha.php" onclick="this.src='./app/models/Captcha.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
                        <input type="text" id="captcha" name="captcha" required/>
                    </div>
                    <br />
                    <button class="btn btn-secondary text-uppercase rounded" id="submitButton" type="submit">Envoyer</button>
                </form>

            </div>
        </div>
    </div>
</div>