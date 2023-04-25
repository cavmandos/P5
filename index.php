<?php

session_start();

require_once './app/controllers/MainController.php';
require_once './app/controllers/SecureClass.php';
$mainController = new MainController();

//SECURITY FONCTIONS
$validate = $mainController->validateSession();
$admin = $mainController->checkAdmin();
$visitor = Security::isAllowed();

try {
    if(empty($_GET['page'])){
        $page = "accueil";
    } else {
        $url = explode('/', filter_var($_GET['page']), FILTER_SANITIZE_URL);
        $page = $url[0];
    }
    
    switch($page){
        case "accueil" :
            $mainController->homePage();
        break;

        case "posts" :
            $mainController->postsPage();
        break;

        case "compte" :
            $mainController->accountPage();
        break;

        case "admin" :
            if($admin == 1 && $validate == 1 && $visitor == 1){
                $mainController->adminPage();
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            } 
        break;

        case "nouvel-utilisateur" :
            $mainController->createAccountPage();
        break;

        case "validation_nouveau_compte":
            if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['confirm-password'])){
                $email = Security::secureHTML($_POST['email']);
                $password = Security::secureHTML($_POST['password']);
                $firstname = Security::secureHTML($_POST['firstname']);
                $lastname = Security::secureHTML($_POST['lastname']);
                $username = Security::secureHTML($_POST['username']);
                $confirmPassword = Security::secureHTML($_POST['confirm-password']);

                if($password===$confirmPassword){
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
            $mainController->updateEmail(Security::secureHTML($_POST['email']));
        break;

        case "suppression_compte":
            $mainController->deleteAccount();
        break;

        case "nouveau-post" :
            if($admin == 1 && $validate == 1 && $visitor == 1){
                $mainController->createPostPage();
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            }  
        break;

        case "validation_nouveau_post":
            if(!empty($_POST['title']) && !empty($_POST['intro']) && !empty($_POST['text'])){
                $title = Security::secureHTML($_POST['title']);
                $intro = Security::secureHTML($_POST['intro']);
                $text = Security::secureHTML($_POST['text']);
                $mainController->createPost($title, $intro, $text);
            } else {
                Toolbox::showAlert("Tous les champs sont obligatoires pour publier un post", Toolbox::COULEUR_ROUGE);
                header("Location:nouveau-post");
            }
        break;

        case "modifier-post" :
            if($admin == 1 && $validate == 1 && $visitor == 1){
                $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
                $mainController->updatePostPage($id);
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            } 
        break;

        case "validation_modifier_post":
            if($admin == 1 && $validate == 1 && $visitor == 1){
                if(!empty($_POST['title']) || !empty($_POST['intro']) || !empty($_POST['text'])){
                    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
                    $title = Security::secureHTML($_POST['title']);
                    $intro = Security::secureHTML($_POST['intro']);
                    $text = Security::secureHTML($_POST['text']);
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
            if($admin == 1 && $validate == 1 && $visitor == 1){
                $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
                $mainController->deletePost($id);
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à faire ceci", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            } 
        break;

        case "commentaires" :
            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
            if($admin == 1 && $validate == 1 && $visitor == 1){
                $mainController->commentsPage($id);
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            } 
        break;

        case "validation_NO_commentaire" :
            if($admin == 1 && $validate == 1 && $visitor == 1){
                $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
                $mainController->deleteComment($id);
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à faire ceci", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            } 
        break;

        case "validation_OK_commentaire" :
            if($admin == 1 && $validate == 1 && $visitor == 1){
                $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
                $mainController->confirmComment($id);
            } else {
                Toolbox::showAlert("Vous n'êtes pas autorisé à faire ceci", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            } 
        break;

        case "validation_nouveau_commentaire" :
            if($validate == 1 && $visitor == 1){
                if(!empty($_POST['comment'])){
                    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
                    $comment = Security::secureHTML($_POST['comment']);
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

        case "article" :
            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
            $mainController->singlePostPage($id);
        break;

        case "validation_login" :
            if (!empty($_POST['email']) && !empty($_POST['password']) ) {
                $email = Security::secureHTML($_POST['email']);
                $password = Security::secureHTML($_POST['password']);
                $mainController->validateLogin($email, $password);
            } else {
                header('Location:compte');
            }
        break;

        case "deconnexion" :
            $mainController->logoutPage();
        break;

        default : throw new Exception("La page n'existe pas");
    }
    
} catch (Exception $e) {
    $error = $e->getMessage();
}
