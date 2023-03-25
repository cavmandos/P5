<?php

require_once('./app/controllers/MainController.php');
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
            $mainController->adminPage();
        break;
        case "inscription" :
            $mainController->registerPage();
        break;
        case "creation" :
            $mainController->createPostPage();
        break;
        case "nouvel-utilisateur" :
            $mainController->createAccountPage();
        break;
        case "nouveau-post" :
            $mainController->createPostPage();
        break;
        case "modifier-post" :
            $mainController->updatePostPage();
        break;
        case "commentaires" :
            $mainController->commentsPage();
        break;

        default : throw new Exception("La page n'existe pas");
    }
    
} catch (Exception $e) {
    $error = $e->getMessage();
}

