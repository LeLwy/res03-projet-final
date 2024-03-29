<?php

class Router{

    // public controllers
    
    private AboutController $aboutController;
    private AdoptionController $adoptionController;
    private AuthController $authController;
    private BlogController $blogController;
    private CatController $catController;
    private ContactController $contactController;
    private DiseaseController $diseaseController;
    private DonationController $donationController;
    private EventController $eventController;
    private FamilyController $familyController;
    private HomeController $homeController;
    private LoginController $loginController;
    private NotFoundController $notFoundController;
    private RegisterController $registerController;
    private UserController $userController;

    // private controllers

    private PrivateAdminController $privateAdminController;
    private PrivateAuthController $privateAuthController;
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
        $this->authController = new AuthController();
        $this->blogController = new BlogController();
        $this->catController = new CatController();
        $this->contactController = new ContactController();
        $this->diseaseController = new DiseaseController();
        $this->donationController = new DonationController();
        $this->eventController = new EventController();
        $this->familyController = new FamilyController();
        $this->homeController = new HomeController();
        $this->loginController = new LoginController();
        $this->notFoundController = new NotFoundController();
        $this->registerController = new RegisterController();
        $this->userController = new UserController();

        //private

        $this->privateAdminController = new PrivateAdminController();
        $this->privateAuthController = new PrivateAuthController();
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
                $routeAndParams["route"] = "a-propos";   
            }  
            else if($tab[0] === 'a-l-adoption' && !isset($tab[1])) // route vers la page a-l-adoption  
            {    
                $routeAndParams["route"] = "a-l-adoption";  
            }  
            else if($tab[0] === 'connexion' && !isset($tab[1])) // route vers la page de connexion  
            {    
                $routeAndParams["route"] = "connexion";  
            }  
            else if($tab[0] === 'check-connexion' && !isset($tab[1])) // route vers la page d'accueil si confirmation de connexion  
            {    
                $routeAndParams["route"] = "check-connexion";  
            }  
            else if($tab[0] === 'deconnexion' && !isset($tab[1])) // route vers la page d'accueil après déconnexion  
            {    
                $routeAndParams["route"] = "deconnexion";  
            }  
            else if($tab[0] === 'a-l-adoption' && $tab[1] !== null && !isset($tab[2])) // "route vers le profil d'un chat 
            {    
                $routeAndParams["route"] = "a-l-adoption";  
                $routeAndParams["chat-id"] = $tab[1];  
            }  
            else if($tab[0] === 'donation' && !isset($tab[1])) // route vers la page donation
            {    
                $routeAndParams["route"] = "donation";  
            }  
            else if($tab[0] === 'contact' && !isset($tab[1])) // route vers la page de contact  
            {    
                $routeAndParams["route"] = "contact";  
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
            else if($tab[0] === 'utilisateurs' && $tab[1] !== null && $tab[2] === "articles" && $tab[3] !== null && $tab[4] === "editer" && !isset($tab[5])) // route vers la page d'édition d'un article pour l'utilisateur
            {    
                $routeAndParams["route"] = "utilisateurs";  
                $routeAndParams["utilisateur-id"] = $tab[1];
                $routeAndParams["sub-route"] = $tab[2];
                $routeAndParams["article-id"] = $tab[3];
                $routeAndParams["methode"] = $tab[4];
            }  
            else if($tab[0] === 'utilisateurs' && $tab[1] !== null && $tab[2] === "articles" && $tab[3] !== null && $tab[4] === "supprimer" && !isset($tab[5])) // route vers la page de suppression d'un article pour l'utilisateur
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
            else if($tab[0] === 'admin' && $tab[1] === "index-des-chats-a-l-adoption" && $tab[2] !== null && $tab[3] === "ajouter-media" && !isset($tab[4])) // route vers la page d'ajout d'un media sur un chat pour l'administrateur
            { 
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["chat-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }   
            else if($tab[0] === 'admin' && $tab[1] === "index-des-chats-a-l-adoption" && $tab[2] !== null && $tab[3] === "supprimer-media" && $tab[4] !== null && !isset($tab[5])) // route vers la page de suppression d'un media sur un chat pour l'administrateur
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
            else if($tab[0] === 'admin' && $tab[1] === "index-des-familles" && $tab[2] !== null && $tab[3] === "ajouter-media" && !isset($tab[4])) // route vers la page d'ajout d'un media sur une famille pour l'administrateur
            { 
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["famille-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }   
            else if($tab[0] === 'admin' && $tab[1] === "index-des-familles" && $tab[2] !== null && $tab[3] === "supprimer-media" && $tab[4] !== null && !isset($tab[5])) // route vers la page de suppression d'un media sur une famille pour l'administrateur
            { 
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["famille-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
                $routeAndParams["media-id"] = $tab[4];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-maladies" && $tab[2] !== null && $tab[3] === "voir" && !isset($tab[4])) // route vers la page de détails d'une maladie pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["maladie-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-maladies" && $tab[2] !== null && $tab[3] === "editer" && !isset($tab[4])) // route vers la page d'édition d'une maladie pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["maladie-id"] = $tab[2];
                $routeAndParams["methode"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] === "index-des-maladies" && $tab[2] !== null && $tab[3] === "supprimer" && !isset($tab[4])) // route vers la page de suppression d'une maladie pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["sub-route"] = $tab[1];
                $routeAndParams["maladie-id"] = $tab[2];
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
        else if($routeTab["route"] === "contact") // condition(s) pour envoyer vers la page contact 
        {  
            $this->contactController->index($post);
            // appel de la méthode du controller pour afficher la page à propos  
        }  
        else if($routeTab["route"] === "donation") // condition(s) pour envoyer vers la page des dons 
        {  
            $this->donationController->index();
            // appel de la méthode du controller pour afficher la page à propos  
        } 
        else if($routeTab["route"] === "connexion") // condition(s) pour envoyer vers le formulaire de connexion 
        {  
            $this->authController->login();
            // appel de la méthode du controller pour afficher le formulaire de connexion  
        }  
        else if($routeTab["route"] === "check-connexion") // condition(s) pour envoyer vers la page d'accueil si connexion 
        {  
            $this->authController->checkLogin($post);
            // appel de la méthode du controller pour afficher la page d'accueil si connexion 
        }   
        else if($routeTab["route"] === "deconnexion") // condition(s) pour envoyer vers la page d'accueil apres deconnexion 
        {  
            $this->authController->logout();
            // appel de la méthode du controller pour afficher la page d'accueil si connexion 
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
        else if($routeTab["route"] === "evenements" && $routeTab["evenement-id"] === null) // condition(s) pour envoyer vers la liste des evenements 
        {  
            $this->eventController->index();
            // appel de la méthode du controller pour afficher la page familles (index des familles) 
        }    
        else if($routeTab["route"] === "evenements" && $routeTab["evenement-id"] !== null) // condition(s) pour envoyer vers le detail d'un evenement  
        {  
            $this->eventController->show(intval($routeTab["evenement-id"]));
            // appel de la méthode du controller pour afficher le detail d'un evenement  
        }    
        /***************************************************************** ACCES  D'UN BENEVOLE A SON PROFIL *******************************************************************************/
        
        else if($routeTab["route"] === "utilisateurs" && $routeTab["utilisateur-id"] !== null) // condition(s) pour envoyer vers le profil d'un utilisateur  
        {  
            // appel de la méthode du controller pour afficher le profil d'un utilisateur
            $this->privateUserController->profil(intval($routeTab["utilisateur-id"])); 
        }
        else if($routeTab["route"] === "utilisateurs" && $routeTab["utilisateur-id"] !== null && $routeTab["sub-route"] !== null && $routeTab["methode"] === 'creer') // condition(s) pour envoyer vers le formulaire de création d'un article pour l'utilisateur  
        {  
            // appel de la méthode du controller pour afficher le formulaire de création d'un article 
        }
        else if($routeTab["route"] === "utilisateurs" && $routeTab["utilisateur-id"] !== null && $routeTab["sub-route"] !== null && $routeTab['article-id'] !== null && $routeTab["methode"] === "editer") // condition(s) pour envoyer vers le formulaire d'édition d'un article pour l'utilisateur  
        {  
            // appel de la méthode du controller pour afficher le formulaire d'édition d'un article   
        }  

        /***************************************************************** ACCES  A L'INTERFACE D'ADMINISTRATION *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab["sub-route"] === null) // condition(s) pour envoyer vers la page d'accueil de l'admin 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                $this->privateAdminController->index();
            }else{

                $this->authController->login();
            }
            // appel de la méthode du controller pour afficher la page d'accueil de l'admin 
        }
        
        /***************************************************************** INDEX D'UN MODELE COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] !== null && $routeTab['methode'] === null && (isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur"))) // condition(s) pour envoyer vers l'index de l'un des modèles 
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

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-utilisateurs" && $routeTab['utilisateur-id'] !== null && $routeTab['methode'] === "voir" && (isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur"))) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            $this->privateUserController->show(intval($routeTab['utilisateur-id']));
            // appel de la méthode du controller pour afficher le profil d'un utilisateur
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-chats-a-l-adoption" && $routeTab['chat-id'] !== null && $routeTab['methode'] === "voir" && (isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur"))) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            $this->privateCatController->show(intval($routeTab['chat-id']));
            // appel de la méthode du controller pour afficher le profil d'un chat
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-articles" && $routeTab['article-id'] !== null && $routeTab['methode'] === "voir" && (isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur"))) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            // appel de la méthode du controller pour afficher le détail d'un aticle
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-familles" && $routeTab['famille-id'] !== null && $routeTab['methode'] === "voir" && (isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur"))) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            $this->privateFamilyController->show(intval($routeTab['famille-id']));
            // appel de la méthode du controller pour afficher le profil d'une famille
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-evenements" && $routeTab['evenement-id'] !== null && $routeTab['methode'] === "voir" && (isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur"))) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            $this->privateEventController->show(intval($routeTab['evenement-id']));
            // appel de la méthode du controller pour afficher le détail d'un evenement
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-maladies" && $routeTab['maladie-id'] !== null && $routeTab['methode'] === "voir" && (isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur"))) // condition(s) pour envoyer vers le profil d'un utilisateur 
        {  
            $this->privateDiseaseController->show(intval($routeTab['maladie-id']));
            // appel de la méthode du controller pour afficher le détail d'un evenement
        }  

        /***************************************************************** CREATION DES MODELES COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] !== null && $routeTab['methode'] === "creer") // condition(s) pour envoyer vers la page de création d'un modèle 
        {  
            if($routeTab['sub-route'] === "index-des-utilisateurs"){

                if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                    // 'appel de la méthode du controller pour creer un utilisateur';  
                    $this->privateUserController->create($post);
                }else{

                    $this->privateUserController->index();
                }
            }else if($routeTab['sub-route'] === "index-des-chats-a-l-adoption"){
                
                if(isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur")){

                    // 'appel de la méthode du controller pour creer un chat' 
                    $this->privateCatController->create($post);
                }
            }else if($routeTab['sub-route'] === "index-des-articles"){
                
                if(isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur")){

                    // appel de la méthode du controller pour creer un article  
                    $this->privatePostController->create($post);  
                }
            }else if($routeTab['sub-route'] === "index-des-familles"){
                
                if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                    // appel de la méthode du controller pour creer une famille  
                    $this->privateFamilyController->create($post);    
                }else{
                    
                    $this->privateFamilyController->index();
                }
            }else if($routeTab['sub-route'] === "index-des-evenements"){
                
                if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){
                    
                    // appel de la méthode du controller pour creer un evenement  
                    $this->privateEventController->create($post);  
                }else{
                    
                    $this->privateEventController->index();
                }
            }else if($routeTab['sub-route'] === "index-des-maladies"){
                
                if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                    // appel de la méthode du controller pour creer une maladie  
                    $this->privateDiseaseController->create($post);  
                }else{
                    
                    $this->privateDiseaseController->index();
                }
            }
        }
        
        /***************************************************************** EDITION DES MODELES COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-utilisateurs" && $routeTab['utilisateur-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'un utilisateur 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                // appel de la méthode du controller pour editer un utilisateur 
                $this->privateUserController->update($post, intval($routeTab['utilisateur-id'])); 
            }else{
                
                $this->privateUserController->index();
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-chats-a-l-adoption" && $routeTab['chat-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'un chat 
        {  
            if(isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur")){

                // appel de la méthode du controller pour editer un chat 
                $this->privateCatController->update($post, intval($routeTab['chat-id'])); 
            }             
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-articles" && $routeTab['article-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'un article 
        {  
            if(isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur")){

                // appel de la méthode du controller pour editer un article 
                $this->privatePostController->update($post, intval($routeTab['article-id'])); 
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-familles" && $routeTab['famille-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'une famille 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                // appel de la méthode du controller pour editer une famille 
                $this->privateFamilyController->update($post, intval($routeTab['famille-id'])); 
            }else{
                
                $this->privateFamilyController->index();
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-evenements" && $routeTab['evenement-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'un evenement 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                // appel de la méthode du controller pour editer un evenement 
                $this->privateEventController->update($post, intval($routeTab['evenement-id'])); 
            }else{
                
                $this->privateEventController->index();
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-maladies" && $routeTab['maladie-id'] !== null && $routeTab['methode'] === "editer") // condition(s) pour envoyer vers la page d'édition d'une maladie 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                // appel de la méthode du controller pour editer une maladie
                $this->privateDiseaseController->update($post, intval($routeTab['maladie-id'])); 
            }else{
                
                $this->privateDiseaseController->index();
            }
        }
        
        /************************************************************** SUPPRESSION DES MODELES COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-utilisateurs" && $routeTab['utilisateur-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'un utilisateur 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                // appel de la méthode du controller pour supprimer un utilisateur
                $this->privateUserController->delete(intval($routeTab['utilisateur-id']));
            }else{
                
                $this->privateUserController->index();
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-chats-a-l-adoption" && $routeTab['chat-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'un chat 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                $this->privateCatController->delete(intval($routeTab['chat-id']));
                // appel de la méthode du controller pour supprimer un chat
            }else{
                
                $this->privateCatController->index();
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-articles" && $routeTab['article-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'un article 
        {  
            if(isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur")){

                $this->privatePostController->delete(intval($routeTab['article-id']));
                // appel de la méthode du controller pour supprimer un article
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-familles" && $routeTab['famille-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'une famille 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                $this->privateFamilyController->delete(intval($routeTab['famille-id']));
                // appel de la méthode du controller pour supprimer une famille
            }else{
                
                $this->privateFamilyController->index();
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-evenements" && $routeTab['evenement-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'un evenement 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                $this->privateEventController->delete(intval($routeTab['evenement-id']));
                // appel de la méthode du controller pour supprimer un evenement
            }else{
                
                $this->privateEventController->index();
            }
        }  
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-maladies" && $routeTab['maladie-id'] !== null && $routeTab['methode'] === "supprimer") // condition(s) pour envoyer vers la page de suppression d'une maladie 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                $this->privateDiseaseController->delete(intval($routeTab['maladie-id']));
                // appel de la méthode du controller pour supprimer une maladie
            }else{
                
                $this->privateDiseaseController->index();
            }
        } 
        
        /************************************************************** AJOUT D'UN MEDIA SUR UN MODELE COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-chats-a-l-adoption" && $routeTab['chat-id'] !== null && $routeTab['methode'] === "ajouter-media") // condition(s) pour ajouter un media au chat 
        {  
            if(isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur")){
            
                if(isset($_FILES) && !empty($_FILES)){

                    $this->privateCatController->addMediaInCatMedias($post, intval($routeTab['chat-id']));
                // appel de la méthode du controller pour ajouter un media au chat
                }
            }
        }
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-familles" && $routeTab['famille-id'] !== null && $routeTab['methode'] === "ajouter-media") // condition(s) pour ajouter un media à la famille 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                if(isset($_FILES) && !empty($_FILES)){
    
                    $this->privateFamilyController->addMediaInFamilyMedias($post, intval($routeTab['famille-id']));
                // appel de la méthode du controller pour ajouter un media à la famille
                }
            }else{
                
                $this->privateFamilyController->show($routeTab['famille-id']);
            }
        }  

        /************************************************************** SUPPRESSION D'UN MEDIA SUR UN MODELE COTE ADMIN *******************************************************************************/

        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-chats-a-l-adoption" && $routeTab['chat-id'] !== null && $routeTab['methode'] === "supprimer-media" && $routeTab['media-id'] !== null) // condition(s) pour supprimer un media du chat 
        {  
            if(isset($_SESSION['role']) && ($_SESSION['role'] === "admin" || $_SESSION['role'] === "contributeur")){
                
                $this->privateCatController->deleteMediaInCatMedias(intval($routeTab['chat-id']), intval($routeTab['media-id']));
                // appel de la méthode du controller pour supprimer un media du chat
            }
        }
        else if($routeTab["route"] === "admin" && $routeTab['sub-route'] === "index-des-familles" && $routeTab['famille-id'] !== null && $routeTab['methode'] === "supprimer-media" && $routeTab['media-id'] !== null) // condition(s) pour supprimer un media du chat 
        {  
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){

                $this->privateFamilyController->deleteMediaInFamilyMedias(intval($routeTab['famille-id']), intval($routeTab['media-id']));
                // appel de la méthode du controller pour supprimer un media du chat
            }else{
                
                $this->privateFamilyController->show($routeTab['famille-id']);
            }
        }else{
            
            $this->notFoundController->index();
        }
    }
}