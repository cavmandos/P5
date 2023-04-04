<?php

require_once('./app/models/MainManager.php');
require_once('./app/controllers/ToolboxClass.php');
require_once('./app/controllers/ToolboxClass.php');

class MainController {

    private $mainManager;

    public function __construct()
    {
        $this->mainManager = new MainManager();
    }

    private function genereratePage($data){
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }
    public function homePage(){

        $datas = $this->mainManager->getDatas();
        //$users = $this->mainManager->getUsers();

        $data_page = [
            "page_description" => "Page d'accueil du Blog de Franck Lebeau",
            "page_title" => "BlogFL - Accueil",
            "datas"=> $datas,
            //"users"=> $users,
            "view" => "./views/HomeView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }
    public function postsPage(){

        $datas = $this->mainManager->getDatas();

        $data_page = [
            "page_description" => "Page des posts - Liste de tous les posts",
            "page_title" => "BlogFL - Posts",
            "datas"=> $datas,
            "view" => "./views/PostsView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }
    public function accountPage(){

        $data_page = [
            "page_description" => "Page de connexion ou de création de compte",
            "page_title" => "BlogFL - Compte",
            "view" => "./views/AccountView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }
    public function registerPage(){
        $data_page = [
            "page_description" => "Page de création du compte",
            "page_title" => "BlogFL - Création du compte",
            "view" => "./views/RegisterView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }
    public function adminPage(){

        $datas = $this->mainManager->getDatas();

        $data_page = [
            "page_description" => "Page d'administration du blog",
            "page_title" => "BlogFL - Administration",
            "datas"=> $datas,
            "view" => "./views/AdminView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }
    public function createPostPage(){
        $data_page = [
            "page_description" => "Page de création d'un post",
            "page_title" => "BlogFL - Créer un post",
            "view" => "./views/CreatePostView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }
    public function createAccountPage(){
        $data_page = [
            "page_description" => "Page de création d'un compte",
            "page_title" => "BlogFL - Créer un compte",
            "view" => "./views/CreateAccountView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }
    public function updatePostPage(){
        $data_page = [
            "page_description" => "Page de modification d'un post",
            "page_title" => "BlogFL - Modifier un post",
            "view" => "./views/UpdatePostView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }
    public function commentsPage(){
        $data_page = [
            "page_description" => "Page de modération des commentaires",
            "page_title" => "BlogFL - Modérer les commentaires",
            "view" => "./views/CommentsView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    public function singlePostPage(){

        $datas = $this->mainManager->getDatas();

        $data_page = [
            "page_description" => "Article de blog",
            "page_title" => "BlogFL - Article",
            "datas" => $datas,
            "view" => "./views/SinglePostView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //LOGIN
    public function validateLogin($email, $password){
        if($this->mainManager->isCombinationValid($email, $password)){
            $rank = $this->mainManager->isAdmin($email);
            $newToken = Security::getRandomToken();
            $this->mainManager->setTokenDB($email, $newToken);
            Toolbox::showAlert("Vous êtes bien connecté", Toolbox::COULEUR_VERTE);
            $_SESSION['login'] = [
                "email" => $email,
                "rank" => $rank,
                "token" => $newToken,
            ];
            header("Location:compte");
        } else {
            Toolbox::showAlert("Combinaison Email/Mot de passe non valide", Toolbox::COULEUR_ROUGE);
            header("Location:compte");
        }
    }

    //SESSION
    public function validateSession(){
        if(isset($_SESSION['login']['email'])){
            $email = $_SESSION['login']['email'];
            $token1 = $_SESSION['login']['token'];
            $token2 = $this->mainManager->verifyToken($email);
            if($token1===$token2){
                return true;
            } else {
                return false;
            }
        }
    }

    //LOGOUT
    public function logoutPage(){
        $email = $_SESSION['login']['email'];
        $this->mainManager->removeTokenDB($email);
        Toolbox::showAlert("Vous êtes maintenant déconnecté", Toolbox::COULEUR_VERTE);
        session_destroy();
        unset($_SESSION);
        header('Location:accueil');
    }
}