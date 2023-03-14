<?php

class Router{
    
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


    // public constructor
    public function __construct()
    {

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
        $routeAndParams["model"] = null;  
        $routeAndParams["method"] = null;    
    
        if(strlen($route) > 0) // si la chaine de la route n'est pas vide (donc si ça n'est pas la home)  
        {  
            $tab = explode("/", $route);  
    
            if($tab[0] === 'a-propos') // route vers la page a-propos  
            {    
                $routeAndParams["route"] = "about";   
            }  
            else if($tab[0] === 'a-l-adoption') // route vers la page a-l-adoption  
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
            else if($tab[0] === 'evenements') // route vers la page évènements  
            {    
                $routeAndParams["route"] = "evenements";  
            }  
            else if($tab[0] === 'evenements' && $tab[1] !== null) // route vers la page d'un évènement 
            {    
                $routeAndParams["route"] = "evenements";  
                $routeAndParams["evenement-id"] = $tab[1];
            }  
            else if($tab[0] === 'blog') // route vers la page blog  
            {    
                $routeAndParams["route"] = "blog";  
            }  
            else if($tab[0] === 'blog' && $tab[1] !== null) // route vers la page d'un article de blog 
            {    
                $routeAndParams["route"] = "blog";  
                $routeAndParams["article-id"] = $tab[1];
            }  
            else if($tab[0] === 'familles') // route vers la page familles  
            {    
                $routeAndParams["route"] = "familles";  
            }  
            else if($tab[0] === 'familles' && $tab[1] !== null) // route vers la page de profil d'une famille 
            {    
                $routeAndParams["route"] = "familles";  
                $routeAndParams["famille-id"] = $tab[1];
            }  
            else if($tab[0] === 'utilisateur' && $tab[1] !== null) // route vers la page de profil d'un utilisateur 
            {    
                $routeAndParams["route"] = "utilisateur";  
                $routeAndParams["utilisateur-id"] = $tab[1];
            }  
            else if($tab[0] === 'utilisateur' && $tab[1] !== null && $tab[2] !== null && $tab[3] !== null) // route vers la page de création d'un article pour l'utilisateur
            {    
                $routeAndParams["route"] = "utilisateur";  
                $routeAndParams["utilisateur-id"] = $tab[1];
                $routeAndParams["model"] = $tab[2];
                $routeAndParams["method"] = $tab[3];
            }  
            else if($tab[0] === 'utilisateur' && $tab[1] !== null && $tab[2] !== null && $tab[3] !== null && $tab[4] !== null) // route vers la page d'édition d'un article pour l'utilisateur
            {    
                $routeAndParams["route"] = "utilisateur";  
                $routeAndParams["utilisateur-id"] = $tab[1];
                $routeAndParams["model"] = $tab[2];
                $routeAndParams["article-id"] = $tab[3];
                $routeAndParams["method"] = $tab[4];
            }  
            else if($tab[0] === 'admin') // route vers la page principale du profil administrateur  
            {    
                $routeAndParams["route"] = "admin";  
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null) // route vers l'index d'un type de modèle pour l'administrateur 
            {    
                $routeAndParams["route"] = "admin";  
                $routeAndParams["model"] = $tab[1];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null) // route vers la page de création d'un type de modèle pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["model"] = $tab[1];
                $routeAndParams["method"] = $tab[2];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] !== null) // route vers la page d'édition d'un utilisateur pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["model"] = $tab[1];
                $routeAndParams["utilisateur-id"] = $tab[2];
                $routeAndParams["method"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] !== null) // route vers la page d'édition d'un chat pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["model"] = $tab[1];
                $routeAndParams["chat-id"] = $tab[2];
                $routeAndParams["method"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] !== null) // route vers la page d'édition d'un article pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["model"] = $tab[1];
                $routeAndParams["article-id"] = $tab[2];
                $routeAndParams["method"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] !== null) // route vers la page d'édition d'un évènement pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["model"] = $tab[1];
                $routeAndParams["evenement-id"] = $tab[2];
                $routeAndParams["method"] = $tab[3];
            }  
            else if($tab[0] === 'admin' && $tab[1] !== null && $tab[2] !== null && $tab[3] !== null) // route vers la page d'édition d'une famille pour l'administrateur
            {    
                $routeAndParams["route"] = "admin";
                $routeAndParams["model"] = $tab[1];
                $routeAndParams["famille-id"] = $tab[2];
                $routeAndParams["method"] = $tab[3];
            } 
        }  
        else  
        {  
            $routeAndParams["route"] = "404"; // redirection vers la page d'erreur 404
        }  
    
        return $routeAndParams;  
    }

    public function checkRoute(string $route) : void  
    {  
        $routeTab = $this->splitRouteAndParameters($route);  
    
        if($routeTab["route"] === "") // condition(s) pour envoyer vers la page d'accueil  
        {  
            // appeler la méthode du controlleur pour afficher la home  
        }  
        else if($routeTab["route"] === "a-propos") // condition(s) pour envoyer vers la page à propos 
        {  
            // appeler la méthode du controlleur pour afficher les produits  
        }  
        else if($routeTab["route"] === "a-l-adoption" && $routeTab["chat-id"] === null) // condition(s) pour envoyer vers la liste des chats à l'adoption  
        {  
            // appeler la méthode du controlleur pour afficher les produits d'une catégorie  
        }  
        else if($routeTab["route"] === "a-l-adoption" && $routeTab["chat-id"] !== null) // condition(s) pour envoyer vers le profil d'un chat à l'adoption  
        {  
            // appeler la méthode du controlleur pour afficher les produits d'une catégorie  
        }  
        else if($routeTab["route"] === "blog" && $routeTab["article-id"] === null) // condition(s) pour envoyer vers la liste des articles du blog  
        {  
            // appeler la méthode du controlleur pour afficher le détail d'un produit  
        }    
        else if($routeTab["route"] === "blog" && $routeTab["article-id"] !== null) // condition(s) pour envoyer vers le détail d'un article du blog  
        {  
            // appeler la méthode du controlleur pour afficher les produits d'une catégorie  
        }  
        else if($routeTab["route"] === "familles" && $routeTab["famille-id"] === null) // condition(s) pour envoyer vers la liste des famille 
        {  
            // appeler la méthode du controlleur pour afficher le détail d'un produit  
        }    
        else if($routeTab["route"] === "familles" && $routeTab["famille-id"] !== null) // condition(s) pour envoyer vers le profil d'une famille  
        {  
            // appeler la méthode du controlleur pour afficher les produits d'une catégorie  
        }
    }
}