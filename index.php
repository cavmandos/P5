<?php
session_start();

require_once('./app/controllers/MainController.php');
require_once('./app/controllers/SecureClass.php');
$mainController = new MainController();

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
            $validate = $mainController->validateSession();
            if(!Security::isAllowed() && !$validate == 1){
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            } else {
                $mainController->adminPage();
            } 
        break;

        case "inscription" :
            $mainController->registerPage();
        break;

        case "nouvel-utilisateur" :
            $mainController->createAccountPage();
        break;

        case "nouveau-post" :
            $validate = $mainController->validateSession();
            if(!Security::isAllowed() && !$validate == 1){
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            } else {
                $mainController->createPostPage();
            }  
        break;

        case "modifier-post" :
            $validate = $mainController->validateSession();
            if(!Security::isAllowed() && !$validate == 1 ){
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            } else {
                $mainController->updatePostPage();
            } 
        break;

        case "commentaires" :
            $validate = $mainController->validateSession();
            if(!Security::isAllowed() && !$validate == 1){
                Toolbox::showAlert("Vous n'êtes pas autorisé à entrer ici", Toolbox::COULEUR_ROUGE);
                header("Location:accueil");
            } else {
                $mainController->commentsPage();
            } 
        break;

        case "article" :
            $mainController->singlePostPage();
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

