<?php

class MainController {

    private function genereratePage($data){
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }
    public function homePage(){
        $data_page = [
            "page_description" => "Page d'accueil du Blog de Franck Lebeau",
            "page_title" => "BlogFL - Accueil",
            "view" => "./views/HomeView.php",
            "template" => "./views/common/template.php",
        ];
        $this->genereratePage($data_page);
    }
    public function postsPage(){
        $data_page = [
            "page_description" => "Page des posts - Liste de tous les posts",
            "page_title" => "BlogFL - Posts",
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
        $data_page = [
            "page_description" => "Page d'administration du blog",
            "page_title" => "BlogFL - Administration",
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
}