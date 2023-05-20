<?php

session_start();

require_once './app/controllers/MainController.php';
require_once './app/controllers/SecureClass.php';
$mainController = new MainController();
require_once './sendemail.php';

// Security checks
$validate = $mainController->validateSession();
$admin = $mainController->checkAdmin();
$visitor = Security::isAllowed();

// Router
try {
    if (empty($_GET['page'])) {
        $page = "accueil";
    } else {
        $get = htmlspecialchars(stripslashes($_GET['page']));
        $url = explode('/', filter_var($get), FILTER_SANITIZE_URL);
        $page = $url[0];
    }
    switch ($page) {
        case "accueil":
            $mainController->homePage();
            break;

        case "posts":
            $mainController->postsPage();
            break;

        case "compte":
            $mainController->accountPage();
            break;

        case "admin":
            if ($admin == 1 && $validate == 1 && $visitor == 1) {
                $mainController->adminPage();
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }
            break;

        case "nouvel-utilisateur":
            $mainController->createAccountPage();
            break;

        case "validation_nouveau_compte":
            if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['confirm-password'])) {
                $email = htmlspecialchars(stripslashes($_POST['email']));
                $password = htmlspecialchars(stripslashes($_POST['password']));
                $firstname = htmlspecialchars(stripslashes($_POST['firstname']));
                $lastname = htmlspecialchars(stripslashes($_POST['lastname']));
                $username = htmlspecialchars(stripslashes($_POST['username']));
                $confirmPassword = htmlspecialchars(stripslashes($_POST['confirm-password']));

                if ($password === $confirmPassword) {
                    $mainController->validateRegistration($email, $password, $firstname, $lastname, $username);
                } else {
                    Toolbox::showAlert("Le mot de passe et sa confirmation ne sont pas identiques", Toolbox::COULEUR_ROUGE);
                    header("Location:nouvel-utilisateur");
                }
            } else {
                Toolbox::showAlert("Tous les champs sont obligatoires pour l'inscription", Toolbox::COULEUR_ROUGE);
                header("Location:nouvel-utilisateur");
            }
            break;

        case "validation_modification_mail":
            $email = htmlspecialchars($_POST['email']);
            $mainController->updateEmail($email);
            break;

        case "suppression_compte":
            $mainController->deleteAccount();
            break;

        case "nouveau-post":
            if ($admin == 1 && $validate == 1 && $visitor == 1) {
                $mainController->createPostPage();
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }
            break;

        case "validation_nouveau_post":
            if (!empty($_POST['title']) && !empty($_POST['intro']) && !empty($_POST['text'])) {
                $title = htmlspecialchars($_POST['title']);
                $intro = htmlspecialchars($_POST['intro']);
                $text = htmlspecialchars($_POST['text']);
                $mainController->createPost($title, $intro, $text);
            } else {
                Toolbox::showAlert("Tous les champs sont obligatoires pour publier un post", Toolbox::COULEUR_ROUGE);
                header("Location:nouveau-post");
            }
            break;

        case "modifier-post":
            if ($admin == 1 && $validate == 1 && $visitor == 1) {
                $id = htmlspecialchars(filter_var($_GET['id'], FILTER_VALIDATE_INT));
                $mainController->updatePostPage($id);
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }
            break;

        case "validation_modifier_post":
            if ($admin == 1 && $validate == 1 && $visitor == 1) {
                if (!empty($_POST['title']) || !empty($_POST['intro']) || !empty($_POST['text'])) {
                    $id = htmlspecialchars(filter_var($_GET['id'], FILTER_VALIDATE_INT));
                    $title = htmlspecialchars($_POST['title']);
                    $intro = htmlspecialchars($_POST['intro']);
                    $text = htmlspecialchars($_POST['text']);
                    $mainController->updatePost($id, $title, $intro, $text);
                } else {
                    Toolbox::showAlert("Tous les champs sont obligatoires pour publier un post", Toolbox::COULEUR_ROUGE);
                    header("Location:nouveau-post");
                }
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à faire ceci", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }
            break;

        case "validation_supprimer_post":
            if ($admin == 1 && $validate == 1 && $visitor == 1) {
                $id = htmlspecialchars(filter_var($_GET['id'], FILTER_VALIDATE_INT));
                $mainController->deletePost($id);
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à faire ceci", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }
            break;

        case "commentaires":
            $id = htmlspecialchars(filter_var($_GET['id'], FILTER_VALIDATE_INT));
            if ($admin == 1 && $validate == 1 && $visitor == 1) {
                $mainController->commentsPage($id);
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }
            break;

        case "validation_NO_commentaire":
            if ($admin == 1 && $validate == 1 && $visitor == 1) {
                $id = htmlspecialchars(filter_var($_GET['id'], FILTER_VALIDATE_INT));
                $mainController->deleteComment($id);
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à faire ceci", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }
            break;

        case "validation_OK_commentaire":
            if ($admin == 1 && $validate == 1 && $visitor == 1) {
                $id = htmlspecialchars(filter_var($_GET['id'], FILTER_VALIDATE_INT));
                $mainController->confirmComment($id);
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à faire ceci", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }
            break;

        case "validation_nouveau_commentaire":
            if ($validate == 1 && $visitor == 1) {
                if (!empty($_POST['comment'])) {
                    $id = htmlspecialchars(filter_var($_GET['id'], FILTER_VALIDATE_INT));
                    $comment = htmlspecialchars($_POST['comment']);
                    $mainController->createComment($id, $comment);
                } else {
                    Toolbox::showAlert("Il faut... euh... un commentaire, pour publier... un commentaire", Toolbox::COULEUR_ROUGE);
                    header("Location:posts");
                }
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à faire ceci", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }
            break;

        case "article":
            $id = htmlspecialchars(filter_var($_GET['id'], FILTER_VALIDATE_INT));
            $mainController->singlePostPage($id);
            break;

        case "validation_login":
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $mainController->validateLogin($email, $password);
            } else {
                header('Location:compte');
            }
            break;

        case "validation_formulaire":
            if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['captcha'])) {
                if (isset($_POST['captcha'])) {
                    if ($_POST['captcha'] == $_SESSION['code']) {
                        $firstname = htmlspecialchars($_POST['firstname']);
                        $lastname = htmlspecialchars($_POST['lastname']);
                        $email = htmlspecialchars($_POST['email']);
                        $subject = htmlspecialchars($_POST['subject']);
                        SendEmail($firstname, $lastname, $email, $subject);
                    } else {
                        Toolbox::showAlert("Votre code pour valider le formulaire est erroné", Toolbox::COULEUR_ROUGE);
                        header("Location:accueil");
                    }
                }
            } else {
                Toolbox::showAlert("Tous les champs sont obligatoires pour nous transmettre un message", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }
            break;

        case "deconnexion":
            $mainController->logoutPage();
            break;

        default:
            throw new Exception("La page n'existe pas");
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    print_r($error);
}
