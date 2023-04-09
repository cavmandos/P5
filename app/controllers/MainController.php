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

    //HOMEPAGE
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

    //POSTS PAGE
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

    //ACCOUNT PAGE
    public function accountPage(){
        $data_page = [
            "page_description" => "Page de connexion ou de création de compte",
            "page_title" => "BlogFL - Compte",
            "view" => "./views/AccountView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //ADMIN PAGE
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

    //CREATE POST PAGE
    public function createPostPage(){
        $data_page = [
            "page_description" => "Page de création d'un post",
            "page_title" => "BlogFL - Créer un post",
            "view" => "./views/CreatePostView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //CREATE ACCOUNT PAGE
    public function createAccountPage(){
        $data_page = [
            "page_description" => "Page de création d'un compte",
            "page_title" => "BlogFL - Créer un compte",
            "view" => "./views/CreateAccountView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //UPDATE POST PAGE
    public function updatePostPage(){
        $data_page = [
            "page_description" => "Page de modification d'un post",
            "page_title" => "BlogFL - Modifier un post",
            "view" => "./views/UpdatePostView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //COMMENTS PAGE
    public function commentsPage(){
        $data_page = [
            "page_description" => "Page de modération des commentaires",
            "page_title" => "BlogFL - Modérer les commentaires",
            "view" => "./views/CommentsView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //POST PAGE
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
            $newToken = Security::getRandomToken();
            $this->mainManager->setTokenDB($email, $newToken);
            Toolbox::showAlert("Vous êtes bien connecté", Toolbox::COULEUR_VERTE);
            $_SESSION['login'] = [
                "email" => $email,
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
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    //ADMIN CHECK
    public function checkAdmin(){
        $res = $this->mainManager->isAdmin($_SESSION['login']['email']);
        return $res;
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

    //REGISTRATION
    public function validateRegistration($email, $password, $firstname, $lastname, $username){
        if($this->mainManager->isAccountAvailable($email)){
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            if($this->mainManager->createAccountDB($email, $passwordHash, $firstname, $lastname, $username)){
                Toolbox::showAlert("Le compte a bien été créé ! Bienvenue à Twin Peaks !", Toolbox::COULEUR_VERTE);
                header("Location:compte");
            } else {
                Toolbox::showAlert("Erreur lors de la création du compte", Toolbox::COULEUR_ORANGE);
                header("Location:nouvel-utilisateur");
            };
        } else {
            Toolbox::showAlert("Ce mail est déjà utilisé par un autre compte.", Toolbox::COULEUR_ROUGE);
            header("Location:nouvel-utilisateur");
        }
    }
}