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

    private PrivateAdminController $privateAdminController;
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

        $this->privateAdminController = new PrivateAdminController();
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
        $routeAndParams["maladie-id"] = null;  
        $routeAndParams["media-id"] = null;  
        $routeAndParams["sub-route"] = null;  
        $routeAndParams["methode"] = null;    
    
        if(strlen($route) > 0) // si la chaine de la route n'est pas vide (donc si ça n'est pas la home)  
        {  
            $tab = explode("/", $route);
    
            if($tab[0] === 'a-propos' && !isset($tab[1])) // route vers la page a-propos  
            {    
                $routeAndParams["route"] = "about";   
            }  
            else if($tab[0] === 'a-l-adoption' && !isset($tab[1])) // route vers la page a-l-adoption  
            {    
                $routeAndParams["route"] = "a-l-adoption";  
            }  
            else if($tab[0] === 'a-l-adoption' && $tab[1] !== null && !isset($tab[2])) // "route vers le profil d'un chat 
            {    
                $routeAndParams["route"] = "";  
                $routeAndParams["chat-id"] = $tab[1];  
            }  
            else if($tab[0] === 'donation' && !isset($tab[1])) // route vers la page donation
            {    
                $routeAndParams["route"] = "donation";  
            }  
            else if($tab[0] === 'nous-rejoindre' && !isset($tab[1])) // route vers la page nous-rejoindre  
            {    
                $routeAndParams["route"] = "nous-rejoindre";  
            }  
            else if($tab[0] === 'evenements' && !isset($tab[1])) // route vers la page évènements  
            {    
                $routeAndParams["route"] = "evenements";  
            }  
            else if($tab[0] === 'evenements' && $tab[1] !== null && !isset($tab[2])) // route vers la page d'un évènement 
            {    
                $routeAndParams["route"] = "evenements";  
                $routeAndParams["evenement-id"] = $tab[1];
            }  
            else if($tab[0] === 'blog' && !isset($tab[1])) // route vers la page blog  
            {    
                $routeAndParams["route"] = "blog";  
            }  
            else if($tab[0] === 'blog' && $tab[1] !== null && !isset($tab[2])) // route vers la page d'un article de blog 
            {    
                $routeAndParams["route"] = "blog";  
                $routeAndParams["article-id"] = $tab[1];
            }  
            else if($tab[0] === 'familles' && !isset($tab[1])) // route vers la page familles  
            {    
                $routeAndParams["route"] = "familles";  
            }  
            else if($tab[0] === 'familles' && $tab[1] !== null && !isset($tab[2])) // route vers la page de profil d'une famille 
            {    
                $routeAndParams["route"] = "familles";  
                $routeAndParams["famille-id"] = $tab[1];
            }  
            else if($tab[0] === 'utilisateurs' && $tab[1] !== null && !isset($tab[2])) // route vers la page de profil d'un utilisateur 
            {    
                $routeAndParams["route"] = "utilisateurs";  
                $routeAndParams["utilisateur-id"] = $tab[1];
            }  
            else if($tab[0] === 'utilisateurs' && $tab[1] !== null && $tab[2] !== null && $tab[3] === "creer" && !isset($tab[4])) // route vers la page de création d'un article pour l'utilisateur
            {    
                $routeAndParams["route"] = "utilisateurs";  
                $routeAndParams["utilisateur-id"] = $tab[1];
                $routeAndParams["sub-route"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'utilisateur' && $tab[1] !== null && $tab[2] === "articles" && $tab[3] !== null && $tab[4] === "editer" && !isset($tab[5])) // route vers la page d'édition d'un article pour l'utilisateur
            {    
                $routeAndParams["route"] = "utilisateurs";  
                $routeAndParams["utilisateur-id"] = $tab[1];
                $routeAndParams["sub-route"] = $tab[2];
                $routeAndParams["article-id"] = $tab[3];
                $routeAndParams["methode"] = $tab[4];
            }  
            else if($tab[0] === 'utilisateur' && $tab[1] !== null && $tab[2] === "articles" && $tab[3] !== null && $tab[4] === "supprimer" && !isset($tab[5])) // route vers la page de suppression d'un article pour l'utilisateur
            {    
                $routeAndParams["route"] = "utilisateurs";  
                $routeAndParams["utilisateur-id"] = $tab[1];
                $routeAndParams["sub-route"] = $tab[2];
                $routeAndParams["article-id"] = $tab[3];
                $routeAndParams["methode"] = $tab[4];
            }  
            else if($tab[0] === 'admin' && !isset($tab[1])) // route vers la page principale du profil administrateur  
            {    
                $routeAndParams["route"] = "admin";  
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && !isset($tab[2])) // route vers l'index d'un type de modèle pour l'administrateur 
            {    
                $routeAndParams["route"] = "admin";  
                $routeAndParams["sub-route"] = $tab[1];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] === "creer" && !isset($tab[3])) // route vers la page de création d'un type de modèle pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["methode"] = $tab[2];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-utilisateurs" && $tab[2] !== null && $tab[3] === "voir" && !isset($tab[4])) // route vers la page de détails d'un utilisateur pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["utilisateur-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-utilisateurs" && $tab[2] !== null && $tab[3] === "editer" && !isset($tab[4])) // route vers la page d'édition d'un utilisateur pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["utilisateur-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-utilisateurs" && $tab[2] !== null && $tab[3] === "supprimer" && !isset($tab[4])) // route vers la page de suppression d'un utilisateur pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["utilisateur-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-chats-a-l-adoption" && $tab[2] !== null && $tab[3] === "voir" && !isset($tab[4])) // route vers la page de détails d'un chat pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["chat-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-chats-a-l-adoption" && $tab[2] !== null && $tab[3] === "editer" && !isset($tab[4])) // route vers la page d'édition d'un chat pour l'administrateur
            {    
                var_dump($tab);
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["chat-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-chats-a-l-adoption" && $tab[2] !== null && $tab[3] === "supprimer" && !isset($tab[4])) // route vers la page de suppression d'un chat pour l'administrateur
            { 
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["chat-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }   
            else if($tab[0] === 'admin' && $tab[1] === "index-des-chats-a-l-adoption" && $tab[2] !== null && $tab[3] === "ajouter-media" && !isset($tab[4])) // route vers la page de suppression d'un chat pour l'administrateur
            { 
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["chat-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }   
            else if($tab[0] === 'admin' && $tab[1] === "index-des-chats-a-l-adoption" && $tab[2] !== null && $tab[3] === "supprimer-media" && $tab[4] !== null && !isset($tab[5])) // route vers la page de suppression d'un chat pour l'administrateur
            { 
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["chat-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
                $routeAndParams["media-id"] = $tab[4];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-articles" && $tab[2] !== null && $tab[3] === "voir" && !isset($tab[4])) // route vers la page de détails d'un article pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["article-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-articles" && $tab[2] !== null && $tab[3] === "editer" && !isset($tab[4])) // route vers la page d'édition d'un article pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["article-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-articles" && $tab[2] !== null && $tab[3] === "supprimer" && !isset($tab[4])) // route vers la page de suppression d'un article pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["article-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-evenements" && $tab[2] !== null && $tab[3] === "voir" && !isset($tab[4])) // route vers la page de détails d'un évènement pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["evenement-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-evenements" && $tab[2] !== null && $tab[3] === "editer" && !isset($tab[4])) // route vers la page d'édition d'un évènement pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["evenement-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-evenements" && $tab[2] !== null && $tab[3] === "supprimer" && !isset($tab[4])) // route vers la page de suppression d'un évènement pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["evenement-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-familles" && $tab[2] !== null && $tab[3] === "voir" && !isset($tab[4])) // route vers la page de détails d'une famille pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["famille-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-familles" && $tab[2] !== null && $tab[3] === "editer" && !isset($tab[4])) // route vers la page d'édition d'une famille pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["famille-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-familles" && $tab[2] !== null && $tab[3] === "supprimer" && !isset($tab[4])) // route vers la page de suppression d'une famille pour l'administrateur
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
        $post = $_POST; 
    
        if($routeTab["route"] === "") // condition(s) pour envoyer vers la page d'accueil  
        {  
            $this->homeController->index();
            // appel de la méthode du controller pour afficher la page d'accueil  
        }  
        else if($routeTab["route"] === "a-propos") // condition(s) pour envoyer vers la page à propos 
        {  
            $this->aboutController->index();
            // appel de la méthode du controller pour afficher la page à propos  
        }  
        else if($routeTab["route"] === "a-l-adoption" && $routeTab["chat-id"] === null) // condition(s) pour envoyer vers la liste des chats à l'adoption  
        {  
            $this->adoptionController->index();
            // appel de la méthode du controller pour afficher la page à l'adoption (index des chats)
        }  
        else if($routeTab["route"] === "a-l-adoption" && $routeTab["chat-id"] !== null) // condition(s) pour envoyer vers le profil d'un chat à l'adoption  
        {  
            $this->adoptionController->show(intval($routeTab["chat-id"]));
            // appel de la méthode du controller pour afficher le profil d'un chat  
        }  
        else if($routeTab["route"] === "blog" && $routeTab["article-id"] === null) // condition(s) pour envoyer vers la liste des articles du blog  
        {  
            $this->blogController->index();
            // appel de la méthode du controller pour afficher le blog (index des articles)
        }    
        else if($routeTab["route"] === "blog" && $routeTab["article-id"] !== null) // condition(s) pour envoyer vers le détail d'un article du blog  
        {  
            $this->blogController->show(intval($routeTab["article-id"]));
            // appel de la méthode du controller pour afficher le détail d'un article  
        }  
        else if($routeTab["route"] === "familles" && $routeTab["famille-id"] === null) // condition(s) pour envoyer vers la liste des famille 
        {  
            $this->familyController->index();
            // appel de la méthode du controller pour afficher la page familles (index des familles) 
        }    
        else if($routeTab["route"] === "familles" && $routeTab["famille-id"] !== null) // condition(s) pour envoyer vers le profil d'une famille  
        {  
            $this->familyController->show(intval($routeTab["famille-id"]));
            // appel de la méthode du controller pour afficher le profil d'un famille  
        }    
        else if($routeTab["route"] === "utilisateurs" && $routeTab["utilisateur-id"] !== null) // condition(s) pour envoyer vers le profil d'un utilisateur  
        {  
            // appel de la méthode du controller pour afficher le profil d'un utilisateur  
        }
        else if($routeTab["route"] === "utilisateurs" && $routeTab["utilisateur-id"] !== null && $routeTab["sub-route"] !== null && $routeTab["methode"] === 'creer') // condition(s) pour envoyer vers le formulaire de création d'un article pour l'utilisateur  
        {  
            // appel de la méthode du controller pour afficher le formulaire de création d'un article 
        }
        else if($routeTab["route"] === "utilisateurs" && $routeTab["utilisateur-id"] !== null && $routeTab["sub-route"] !== null && $routeTab['article-id'] !== null && $routeTab["methode"] === "editer") // condition(s) pour envoyer vers le formulaire d'édition d'un article pour l'utilisateur  
        {  
            // appel de la méthode du controller pour afficher le formulaire d'édition d'un article   
        }  
        else if($routeTab["route"] === "admin" && $routeTab["sub-route"] === null) // condition(s) pour envoyer vers la page d'accueil de l'admin 
        {  
            $this->privateAdminController->index();
            // appel de la méthode du controller pour afficher la page d'accueil de l'admin 
        }
        
        /***************************************************************** INDEX D'UN MODELE COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] !== null && $routeTab['methode'] === null) // condition(s) pour envoyer vers l'index de l'un des modèles 
        {  
            if($routeTab['sub-route'] === "les-utilisateurs"){

                $this->privateUserController->index();
                // appel de la méthode du controller pour afficher les utilisateurs  
            }else if($routeTab['sub-route'] === "index-des-chats-a-l-adoption"){

                $this->privateCatController->index();
                // appel de la méthode du controller pour afficher les chats  
            }else if($routeTab['sub-route'] === "index-des-utilisateurs"){

                $this->privateUserController->index();
                // appel de la méthode du controller pour afficher les chats  
            }else if($routeTab['sub-route'] === "index-des-articles"){

                $this->privatePostController->index();
                // appel de la méthode du controller pour afficher les articles  
            }else if($routeTab['sub-route'] === "index-des-familles"){

                $this->privateFamilyController->index();
                // appel de la méthode du controller pour afficher les familles  
            }else if($routeTab['sub-route'] === "index-des-evenements"){

                $this->privateEventController->index();
                // appel de la méthode du controller pour afficher les evenements  
            }else if($routeTab['sub-route'] === "index-des-maladies"){

                $this->privateDiseaseController->index();
                // appel de la méthode du controller pour afficher les maladies  
            }
        }  

        /***************************************************************** DETAILS D'UN MODELE COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-utilisateurs" && $routeTab['utilisateur-id'] !== null && $routeTab['methode'] === "voir") // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controller pour afficher le profil d'un utilisateur
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-chats-a-l-adoption" && $routeTab['chat-id'] !== null && $routeTab['methode'] === "voir") // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            $this->privateCatController->show(intval($routeTab['chat-id']));
            // appel de la méthode du controller pour afficher le profil d'un chat

            // $this->privateCatController->addMediaInCatMedias($post, intval($routeTab['chat-id']));
            // appel de la méthode du controller pour ajouter un media au chat
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-articles" && $routeTab['article-id'] !== null && $routeTab['methode'] === "voir") // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controller pour afficher le détail d'un aticle
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-familles" && $routeTab['famille-id'] !== null && $routeTab['methode'] === "voir") // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controller pour afficher le profil d'une famille
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-evenements" && $routeTab['evenement-id'] !== null && $routeTab['methode'] === "voir") // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controller pour afficher le détail d'un evenement
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-maladies" && $routeTab['evenement-id'] !== null && $routeTab['methode'] === "voir") // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controller pour afficher le détail d'un evenement
        }  

        /***************************************************************** CREATION DES MODELES COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] !== null && $routeTab['methode'] === "creer") // condition(s) pour envoyer vers la page de création d'un modèle 
        {  
            if($routeTab['sub-route'] === "index-des-utilisateurs"){

                $this->privateUserController->create($post);
                // 'appel de la méthode du controller pour creer un utilisateur';  
            }else if($routeTab['sub-route'] === "index-des-chats-a-l-adoption"){
                
                // 'appel de la méthode du controller pour creer un chat' 
                $this->privateCatController->create($post);
            }else if($routeTab['sub-route'] === "index-des-articles"){

                // appel de la méthode du controller pour creer un article  
                $this->privatePostController->create($post);  
            }else if($routeTab['sub-route'] === "index-des-familles"){

                // appel de la méthode du controller pour creer un famille  
                $this->privateFamilyController->create($post);    
            }else if($routeTab['sub-route'] === "index-des-evenements"){

                // appel de la méthode du controller pour creer un evenement  
                $this->privateEventController->create($post);  
            }else if($routeTab['sub-route'] === "index-des-maladies"){

                // appel de la méthode du controller pour creer une maladie  
                $this->privateDiseaseController->create($post);  
            }
        }
        
        /***************************************************************** EDITION DES MODELES COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-utilisateurs" && $routeTab['utilisateur-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'un utilisateur 
        {  
            // appel de la méthode du controller pour editer un utilisateur 
            $this->privateUserController->update($post, intval($routeTab['utilisateur-id'])); 
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-chats-a-l-adoption" && $routeTab['chat-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'un chat 
        {  
            // appel de la méthode du controller pour editer un chat 
            $this->privateCatController->update($post, intval($routeTab['chat-id'])); 
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-articles" && $routeTab['article-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'un article 
        {  
            // appel de la méthode du controller pour editer un article 
            $this->privatePostController->update($post, intval($routeTab['article-id'])); 
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-familles" && $routeTab['famille-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'une famille 
        {  
            // appel de la méthode du controller pour editer une famille 
            $this->privateFamilyController->update($post, intval($routeTab['famille-id'])); 
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-evenements" && $routeTab['evenement-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'un evenement 
        {  
            // appel de la méthode du controller pour editer un evenement 
            $this->privateEventController->update($post, intval($routeTab['evenement-id'])); 
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-maladies" && $routeTab['maladie-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'une maladie 
        {  
            // appel de la méthode du controller pour editer une maladie
            $this->privatePostController->update($post, intval($routeTab['maladie-id'])); 
        }
        
        /************************************************************** SUPPRESSION DES MODELES COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-utilisateurs" && $routeTab['utilisateur-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'un utilisateur 
        {  
            $this->privateUserController->delete(intval($routeTab['utilisateur-id']));
            // appel de la méthode du controller pour supprimer un utilisateur
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-chats-a-l-adoption" && $routeTab['chat-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'un chat 
        {  
            $this->privateCatController->delete(intval($routeTab['chat-id']));
            // appel de la méthode du controller pour supprimer un chat
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-articles" && $routeTab['article-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'un article 
        {  
            $this->privatePostController->delete(intval($routeTab['article-id']));
            // appel de la méthode du controller pour supprimer un article
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-familles" && $routeTab['famille-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'une famille 
        {  
            $this->privateFamilyController->delete(intval($routeTab['famille-id']));
            // appel de la méthode du controller pour supprimer une famille
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-evenements" && $routeTab['evenement-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'un evenement 
        {  
            $this->privateEventController->delete(intval($routeTab['evenement-id']));
            // appel de la méthode du controller pour supprimer un evenement
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-maladies" && $routeTab['maladie-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'une maladie 
        {  
            $this->privateDiseaseController->delete(intval($routeTab['maladie-id']));
            // appel de la méthode du controller pour supprimer une maladie
        } 
        
        /************************************************************** AJOUT D'UN MEDIA SUR UN MODELE COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-chats-a-l-adoption" && $routeTab['chat-id'] !== null && $routeTab['methode'] === "ajouter-media") // condition(s) pour ajouter un media au chat 
        {  
            if(isset($_FILES) && !empty($_FILES)){
            
                $this->privateCatController->addMediaInCatMedias($post, intval($routeTab['chat-id']));
            // appel de la méthode du controller pour ajouter un media au chat
            }
        }  

        /************************************************************** SUPPRESSION D'UN MEDIA SUR UN MODELE COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-chats-a-l-adoption" && $routeTab['chat-id'] !== null && $routeTab['methode'] === "supprimer-media" && $routeTab['media-id'] !== null) // condition(s) pour supprimer un media du chat 
        {  
            $this->privateCatController->deleteMediaInCatMedias(intval($routeTab['chat-id']), intval($routeTab['media-id']));
            // appel de la méthode du controller pour supprimer un media du chat
        }
    }
}