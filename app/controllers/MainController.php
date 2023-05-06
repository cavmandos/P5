<?php

require_once './app/models/MainManager.php';
require_once './app/controllers/ToolboxClass.php';

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

    //HomePage
    public function homePage(){
        $datas = $this->mainManager->getDatas();
        $data_page = [
            "page_description" => "Page d'accueil du Blog de Franck Lebeau",
            "page_title" => "BlogFL - Accueil",
            "datas"=> $datas,
            "view" => "./views/HomeView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //Posts page
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

    //Account page
    public function accountPage(){
        $email = filter_var($_SESSION['login']['email'], FILTER_SANITIZE_EMAIL);
        $datas = $this->mainManager->getUser($email);
        $data_page = [
            "page_description" => "Page de connexion ou de création de compte",
            "page_title" => "BlogFL - Compte",
            "datas" => $datas,
            "page_javascript" => ['profil.js'],
            "view" => "./views/AccountView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //Admin Page
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

    //Create post page
    public function createPostPage(){
        $data_page = [
            "page_description" => "Page de création d'un post",
            "page_title" => "BlogFL - Créer un post",
            "view" => "./views/CreatePostView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //Create account page
    public function createAccountPage(){
        $data_page = [
            "page_description" => "Page de création d'un compte",
            "page_title" => "BlogFL - Créer un compte",
            "view" => "./views/CreateAccountView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //Update post page
    public function updatePostPage($id){
        $datas = $this->mainManager->getPost($id);
        $data_page = [
            "page_description" => "Page de modification d'un post",
            "page_title" => "BlogFL - Modifier un post",
            "datas" => $datas,
            "view" => "./views/UpdatePostView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //Comments page
    public function commentsPage($id){
        $comments = $this->mainManager->getCommentsNotOK($id);
        $data_page = [
            "page_description" => "Page de modération des commentaires",
            "page_title" => "BlogFL - Modérer les commentaires",
            "comments" => $comments,
            "view" => "./views/CommentsView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //Post page
    public function singlePostPage($id){
        $datas = $this->mainManager->getPost($id);
        $comments = $this->mainManager->getCommentsOK($id);
        $data_page = [
            "page_description" => "Article de blog",
            "page_title" => "BlogFL - Article",
            "datas" => $datas,
            "comments" => $comments,
            "view" => "./views/SinglePostView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }

    //Login
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

    //Check session/DB tokens
    public function validateSession(){
        if(isset($_SESSION['login']['email'])){
            $email = htmlspecialchars($_SESSION['login']['email']);
            $token1 = htmlspecialchars($_SESSION['login']['token']);
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

    //Check admin status
    public function checkAdmin(){
        $email = htmlspecialchars($_SESSION['login']['email']);
        $res = $this->mainManager->isAdmin($email);
        return $res;
    }

    //Logout
    public function logoutPage(){
        $email = htmlspecialchars($_SESSION['login']['email']);
        $this->mainManager->removeTokenDB($email);
        Toolbox::showAlert("Vous êtes maintenant déconnecté", Toolbox::COULEUR_VERTE);
        header('Location:compte');
        session_destroy();
        unset($_SESSION);
    }

    //Register
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

    //Update email
    public function updateEmail($email){
        if($this->mainManager->isAccountAvailable($email)){
            if($this->mainManager->updateMailUser($_SESSION['login']['email'],$email)){
                Toolbox::showAlert("Votre email a bien été mis à jour", Toolbox::COULEUR_VERTE);
                $_SESSION['login']['email'] = $email;
            } else {
                Toolbox::showAlert("La mise à jour a echoué", Toolbox::COULEUR_ORANGE);
            };
            header("Location:compte");
        } else {
            Toolbox::showAlert("Ce mail est déjà utilisé par un autre compte",Toolbox::COULEUR_ROUGE);
            header("Location:compte");
        }
    }

    //Delete account
    public function deleteAccount(){
        if($this->mainManager->deleteUserAccount($_SESSION['login']['email'])){
            Toolbox::showAlert("La suppression du compte est effectuée", Toolbox::COULEUR_VERTE);
            $this->logoutPage();
        } else {
            Toolbox::showAlert("La suppression n'a pas été effectuée", Toolbox::COULEUR_ORANGE);
            header("Location:compte");
        };
    }

    //Create a new post
    public function createPost($title, $summary, $content){
        $email = htmlspecialchars($_SESSION['login']['email']);
        $user = $this->mainManager->getIdUser($email);
        $user = $user[0]['id_user'];
        if($this->mainManager->createPostDB($title, $summary, $content, $user)){
            Toolbox::showAlert("Le post a bien été créé ! ", Toolbox::COULEUR_VERTE);
            header("Location:posts");
        } else {
            Toolbox::showAlert("Erreur lors de la création du post", Toolbox::COULEUR_ORANGE);
            header("Location:nouveau-post");
        };
    }

    //Update a post
    public function updatePost($id, $title, $summary, $content){
        if($this->mainManager->updatePostDB($id, $title, $summary, $content)){
            Toolbox::showAlert("Le post a bien été modifié ! ", Toolbox::COULEUR_VERTE);
            header("Location:article&id=".$id."");
        } else {
            Toolbox::showAlert("Erreur lors de la modification du post", Toolbox::COULEUR_ORANGE);
            header("Location:modifier-post&id=".$id."");
        };
    }

    //Delete a post
    public function deletePost($id){
        if($this->mainManager->deletePostDB($id)){
            Toolbox::showAlert("Le post a bien été supprimé ! ", Toolbox::COULEUR_VERTE);
            header("Location:posts");
        } else {
            Toolbox::showAlert("Erreur lors de la suppression du post", Toolbox::COULEUR_ORANGE);
            header("Location:modification-post");
        };
    }

    //Create a comment
    public function createComment($id, $comment){
        $email = htmlspecialchars($_SESSION['login']['email']);
        $user = $this->mainManager->getIdUser($email);
        $user = $user[0]['id_user'];
        if($this->mainManager->createCommentDB($id, $comment, $user)){
            Toolbox::showAlert("Le commentaire a bien été créé ! Il sera soumis à validation par nos équipes. ", Toolbox::COULEUR_VERTE);
            header("Location:article&id=".$id."");
        } else {
            Toolbox::showAlert("Erreur lors de la création du commentaire", Toolbox::COULEUR_ORANGE);
            header("Location:article&id=".$id."");
        };
    }

    //Delete a comment
    public function deleteComment($id){
        if($this->mainManager->deleteCommentDB($id)){
            Toolbox::showAlert("Le commentaire a bien été supprimé ! ", Toolbox::COULEUR_VERTE);
            header("Location:posts");
        } else {
            Toolbox::showAlert("Erreur lors de la suppression du commentaire", Toolbox::COULEUR_ORANGE);
            header("Location:posts");
        };
    }

    //Confirm a comment
    public function confirmComment($id){
        if($this->mainManager->confirmCommentDB($id)){
            Toolbox::showAlert("Le commentaire a bien été validé ! ", Toolbox::COULEUR_VERTE);
            header("Location:posts");
        } else {
            Toolbox::showAlert("Erreur lors de la confirmation du commentaire", Toolbox::COULEUR_ORANGE);
            header("Location:modification-post&id=".$id."");
        };
    }

    //Send an email
    public function sendEmail($firstname, $lastname, $email, $subject) {
        $to = "adresse@mail.com";
        $from = $email;
        $first_name = $firstname;
        $last_name = $lastname;
        $title = "BlogFL - Message du formulaire";
        $title2 = "BlogFL - Copie de votre envoi via notre formulaire";
        $message = $first_name . " " . $last_name . " a écrit ceci :" . "\n\n" . $subject;
        $message2 = "Voici une copie de votre message " . $first_name . "\n\n" . $subject;

        $headers = "From:" . $from;
        $headers2 = "From:" . $to;
        if(mail($to,$title,$message,$headers)){
            mail($from,$title2,$message2,$headers2);
            Toolbox::showAlert("Votre message a bien été envoyé !", Toolbox::COULEUR_VERTE);
            header("Location:accueil");
        } else {
            Toolbox::showAlert("Il y a eu un problème lors de l'envoi de votre message", Toolbox::COULEUR_ROUGE);
            header("Location:accueil");
        }
    }
}