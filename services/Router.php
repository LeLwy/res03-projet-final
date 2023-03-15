<?php

class Router{

    // public controllers
    
    private AboutController $aboutController;
    private AdoptionController $adoptionController;
    private BlogController $blogController;
    private CatController $catController;
    private DiseaseController $diseaseController;
    private DonationController $donationController;
    private EventController $eventController;
    private FamilyController $familyController;
    private HomeController $homeController;
    private LoginController $loginController;
    private RegisterController $registerController;
    private UserController $userController;

    // private controllers

    private PrivateCatController $privateCatController;
    private PrivateDiseaseController $privateDiseaseController;
    private PrivateEventController $privateEventController;
    private PrivateFamilyController $privateFamilyController;
    private PrivatePostController $privatePostController;
    private PrivateUserController $privateUserController;

    public function __construct()
    {
        //public

        $this->aboutController = new AboutController();
        $this->adoptionController = new AdoptionController();
        $this->blogController = new BlogController();
        $this->catController = new CatController();
        $this->diseaseController = new DiseaseController();
        $this->donationController = new DonationController();
        $this->eventController = new EventController();
        $this->familyController = new FamilyController();
        $this->homeController = new HomeController();
        $this->loginController = new LoginController();
        $this->registerController = new RegisterController();
        $this->userController = new UserController();

        //private

        $this->privateCatController = new PrivateCatController();
        $this->privateDiseaseController = new PrivateDiseaseController();
        $this->privateEventController = new PrivateEventController();
        $this->privateFamilyController = new PrivateFamilyController();
        $this->privatePostController = new PrivatePostController();
        $this->privateUserController = new PrivateUserController();

    }

    private function splitRouteAndParameters(string $route) : array  
    {  
        $routeAndParams = [];  
        $routeAndParams["route"] = null;  
        $routeAndParams["utilisateur-id"] = null;  
        $routeAndParams["chat-id"] = null;  
        $routeAndParams["article-id"] = null;  
        $routeAndParams["famille-id"] = null;  
        $routeAndParams["evenement-id"] = null;  
        $routeAndParams["sub-route"] = null;  
        $routeAndParams["methode"] = null;    
    
        if(strlen($route) > 0) // si la chaine de la route n'est pas vide (donc si ça n'est pas la home)  
        {  
            $tab = explode("/", $route);  
    
            if($tab[0] === 'a-propos') // route vers la page a-propos  
            {    
                $routeAndParams["route"] = "about";   
            }  
            else if($tab[0] === 'a-l-adoption' && $tab[1] === null) // route vers la page a-l-adoption  
            {    
                $routeAndParams["route"] = "a-l-adoption";  
            }  
            else if($tab[0] === 'a-l-adoption' && $tab[1] !== null) // "route vers le profil d'un chat 
            {    
                $routeAndParams["route"] = "";  
                $routeAndParams["chat-id"] = $tab[1];  
            }  
            else if($tab[0] === 'donation') // route vers la page donation
            {    
                $routeAndParams["route"] = "donation";  
            }  
            else if($tab[0] === 'nous-rejoindre') // route vers la page nous-rejoindre  
            {    
                $routeAndParams["route"] = "nous-rejoindre";  
            }  
            else if($tab[0] === 'evenements' && $tab[1] === null) // route vers la page évènements  
            {    
                $routeAndParams["route"] = "evenements";  
            }  
            else if($tab[0] === 'evenements' && $tab[1] !== null) // route vers la page d'un évènement 
            {    
                $routeAndParams["route"] = "evenements";  
                $routeAndParams["evenement-id"] = $tab[1];
            }  
            else if($tab[0] === 'blog' && $tab[1] === null) // route vers la page blog  
            {    
                $routeAndParams["route"] = "blog";  
            }  
            else if($tab[0] === 'blog' && $tab[1] !== null) // route vers la page d'un article de blog 
            {    
                $routeAndParams["route"] = "blog";  
                $routeAndParams["article-id"] = $tab[1];
            }  
            else if($tab[0] === 'familles' && $tab[1] === null) // route vers la page familles  
            {    
                $routeAndParams["route"] = "familles";  
            }  
            else if($tab[0] === 'familles' && $tab[1] !== null) // route vers la page de profil d'une famille 
            {    
                $routeAndParams["route"] = "familles";  
                $routeAndParams["famille-id"] = $tab[1];
            }  
            else if($tab[0] === 'utilisateurs' && $tab[1] !== null && $tab[2] === null) // route vers la page de profil d'un utilisateur 
            {    
                $routeAndParams["route"] = "utilisateurs";  
                $routeAndParams["utilisateur-id"] = $tab[1];
            }  
            else if($tab[0] === 'utilisateurs' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "creer") // route vers la page de création d'un article pour l'utilisateur
            {    
                $routeAndParams["route"] = "utilisateurs";  
                $routeAndParams["utilisateur-id"] = $tab[1];
                $routeAndParams["sub-route"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'utilisateur' && $tab[1] !== null && $tab[2] !== null && $tab[3] !== null && $tab[4] === "editer") // route vers la page d'édition d'un article pour l'utilisateur
            {    
                $routeAndParams["route"] = "utilisateurs";  
                $routeAndParams["utilisateur-id"] = $tab[1];
                $routeAndParams["sub-route"] = $tab[2];
                $routeAndParams["article-id"] = $tab[3];
                $routeAndParams["methode"] = $tab[4];
            }  
            else if($tab[0] === 'utilisateur' && $tab[1] !== null && $tab[2] !== null && $tab[3] !== null && $tab[4] === "supprimer") // route vers la page de suppression d'un article pour l'utilisateur
            {    
                $routeAndParams["route"] = "utilisateurs";  
                $routeAndParams["utilisateur-id"] = $tab[1];
                $routeAndParams["sub-route"] = $tab[2];
                $routeAndParams["article-id"] = $tab[3];
                $routeAndParams["methode"] = $tab[4];
            }  
            else if($tab[0] === 'admin' && $tab[1] === null) // route vers la page principale du profil administrateur  
            {    
                $routeAndParams["route"] = "admin";  
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] === null) // route vers l'index d'un type de modèle pour l'administrateur 
            {    
                $routeAndParams["route"] = "admin";  
                $routeAndParams["sub-route"] = $tab[1];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] === "creer") // route vers la page de création d'un type de modèle pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["methode"] = $tab[2];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "editer") // route vers la page d'édition d'un utilisateur pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["utilisateur-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "supprimer") // route vers la page de suppression d'un utilisateur pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["utilisateur-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "editer") // route vers la page d'édition d'un chat pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["chat-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "supprimer") // route vers la page de suppression d'un chat pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["chat-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "editer") // route vers la page d'édition d'un article pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["article-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "supprimer") // route vers la page de suppression d'un article pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["article-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "editer") // route vers la page d'édition d'un évènement pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["evenement-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "supprimer") // route vers la page de suppression d'un évènement pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["evenement-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "editer") // route vers la page d'édition d'une famille pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["famille-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "supprimer") // route vers la page de suppression d'une famille pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["famille-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            } 
        }  
        else  
        {  
            $routeAndParams["route"] = ""; // redirection vers la page d'erreur 404
        }  
    
        return $routeAndParams;  
    }

    public function checkRoute(string $route) : void  
    {  
        $routeTab = $this->splitRouteAndParameters($route);
        var_dump($routeTab);  
    
        if($routeTab["route"] === "") // condition(s) pour envoyer vers la page d'accueil  
        {  
            $this->homeController->index();
            // appel de la méthode du controlleur pour afficher la page d'accueil  
        }  
        else if($routeTab["route"] === "a-propos") // condition(s) pour envoyer vers la page à propos 
        {  
            $this->aboutController->index();
            // appel de la méthode du controlleur pour afficher la page à propos  
        }  
        else if($routeTab["route"] === "a-l-adoption" && $routeTab["chat-id"] === null) // condition(s) pour envoyer vers la liste des chats à l'adoption  
        {  
            $this->adoptionController->index();
            // appel de la méthode du controlleur pour afficher la page à l'adoption (index des chats)
        }  
        else if($routeTab["route"] === "a-l-adoption" && $routeTab["chat-id"] !== null) // condition(s) pour envoyer vers le profil d'un chat à l'adoption  
        {  
            $this->adoptionController->show(intval($routeTab["chat-id"]));
            // appel de la méthode du controlleur pour afficher le profil d'un chat  
        }  
        else if($routeTab["route"] === "blog" && $routeTab["article-id"] === null) // condition(s) pour envoyer vers la liste des articles du blog  
        {  
            $this->blogController->index();
            // appel de la méthode du controlleur pour afficher le blog (index des articles)
        }    
        else if($routeTab["route"] === "blog" && $routeTab["article-id"] !== null) // condition(s) pour envoyer vers le détail d'un article du blog  
        {  
            $this->blogController->show(intval($routeTab["article-id"]));
            // appel de la méthode du controlleur pour afficher le détail d'un article  
        }  
        else if($routeTab["route"] === "familles" && $routeTab["famille-id"] === null) // condition(s) pour envoyer vers la liste des famille 
        {  
            $this->familyController->index();
            // appel de la méthode du controlleur pour afficher la page familles (index des familles) 
        }    
        else if($routeTab["route"] === "familles" && $routeTab["famille-id"] !== null) // condition(s) pour envoyer vers le profil d'une famille  
        {  
            $this->familyController->show(intval($routeTab["famille-id"]));
            // appel de la méthode du controlleur pour afficher le profil d'un famille  
        }    
        else if($routeTab["route"] === "utilisateurs" && $routeTab["utilisateur-id"] !== null) // condition(s) pour envoyer vers le profil d'un utilisateur  
        {  
            // appel de la méthode du controlleur pour afficher le profil d'un utilisateur  
        }
        else if($routeTab["route"] === "utilisateurs" && $routeTab["utilisateur-id"] !== null && $routeTab["sub-route"] !== null && $routeTab["methode"] === 'creer') // condition(s) pour envoyer vers le formulaire de création d'un article pour l'utilisateur  
        {  
            // appel de la méthode du controlleur pour afficher le formulaire de création d'un article 
        }
        else if($routeTab["route"] === "utilisateurs" && $routeTab["utilisateur-id"] !== null && $routeTab["sub-route"] !== null && $routeTab['article-id'] !== null && $routeTab["methode"] === "editer") // condition(s) pour envoyer vers le formulaire d'édition d'un article pour l'utilisateur  
        {  
            // appel de la méthode du controlleur pour afficher le formulaire d'édition d'un article   
        }  
        else if($routeTab["route"] === "admin" && $routeTab["sub-route"] === null) // condition(s) pour envoyer vers la page d'accueil de l'admin 
        {  
            $this->userController->index();
            // appel de la méthode du controlleur pour afficher la page d'accueil de l'admin 
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] !== null && $routeTab['methode'] === null) // condition(s) pour envoyer vers l'index de l'un des modèles 
        {  
            echo 'on est ici';
            if($routeTab['sub-route'] === "utilisateurs"){

                // appel de la méthode du controlleur pour afficher les utilisateurs  
            }else if($routeTab['sub-route'] === "chats"){

                // appel de la méthode du controlleur pour afficher les chats  
            }else if($routeTab['sub-route'] === "articles"){

                // appel de la méthode du controlleur pour afficher les articles  
            }else if($routeTab['sub-route'] === "familles"){

                // appel de la méthode du controlleur pour afficher les familles  
            }else if($routeTab['sub-route'] === "evenements"){

                // appel de la méthode du controlleur pour afficher les evenements  
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "utilisateurs" && $routeTab['utilisateur-id'] !== null) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controlleur pour afficher le profil d'un utilisateur
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "chats" && $routeTab['chat-id'] !== null) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controlleur pour afficher le profil d'un chat
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "articles" && $routeTab['article-id'] !== null) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controlleur pour afficher le détail d'un aticle
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "familles" && $routeTab['famille-id'] !== null) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controlleur pour afficher le profil d'une famille
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "evenements" && $routeTab['evenement-id'] !== null) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controlleur pour afficher le détail d'un evenement
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] !== null && $routeTab['methode'] === "creer") // condition(s) pour envoyer vers la page de création d'un utilisateur 
        {  
            if($routeTab['sub-route'] === "utilisateurs"){

                echo 'appel de la méthode du controlleur pour creer un utilisateur';  
            }else if($routeTab['sub-route'] === "chats"){
                
                echo 'appel de la méthode du controlleur pour creer un chat';  
                $this->privateCatController->create();
            }else if($routeTab['sub-route'] === "articles"){

                // appel de la méthode du controlleur pour creer un article  
            }else if($routeTab['sub-route'] === "familles"){

                // appel de la méthode du controlleur pour creer un famille  
            }else if($routeTab['sub-route'] === "evenements"){

                // appel de la méthode du controlleur pour creer un evenement  
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page de création d'un utilisateur 
        {  
            if($routeTab['sub-route'] === "utilisateurs"){

                // appel de la méthode du controlleur pour editer un utilisateur  
            }else if($routeTab['sub-route'] === "chats"){

                // appel de la méthode du controlleur pour editer un chat  
            }else if($routeTab['sub-route'] === "articles"){

                // appel de la méthode du controlleur pour editer un article  
            }else if($routeTab['sub-route'] === "familles"){

                // appel de la méthode du controlleur pour editer un famille  
            }else if($routeTab['sub-route'] === "evenements"){

                // appel de la méthode du controlleur pour editer un evenement  
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de création d'un utilisateur 
        {  
            if($routeTab['sub-route'] === "utilisateurs"){

                // appel de la méthode du controlleur pour supprimer un utilisateur  
            }else if($routeTab['sub-route'] === "chats"){

                // appel de la méthode du controlleur pour supprimer un chat  
            }else if($routeTab['sub-route'] === "articles"){

                // appel de la méthode du controlleur pour supprimer un article  
            }else if($routeTab['sub-route'] === "familles"){

                // appel de la méthode du controlleur pour supprimer un famille  
            }else if($routeTab['sub-route'] === "evenements"){

                // appel de la méthode du controlleur pour supprimer un evenement  
            }
        }
    }
}