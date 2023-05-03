<?php  
 
class PrivateAuthController extends PrivateAbstractController {  

    private UserManager $userManager;
  
    public function __construct()  
    {  
        $this->userManager = new UserManager();
    }  
    
    /* Pour la page d'inscription */  
    public function register() : void  
    {  
        // render la page avec le formulaire d'inscription  
        $this->render("user", "create", []);
    }  
    
    /* Pour vÃ©rifier l'inscription */  
    public function checkRegister($post) : void  
    {  
        // vÃ©rifier que le formulaire a Ã©tÃ© soumis  
        if(isset($post['RegisterFormName']));
        // rÃ©cupÃ©rer les champs du formulaire    
        // chiffrer le mot de passe    
        // appeler le manager pour crÃ©er l'utilisateur en base de donnÃ©es   
        // connecter l utilisateur    
        // le renvoyer vers l'accueil
    }  
    
    /* Pour la page de connexion */  
    public function login() : void  
    {  
        // render la page avec le formulaire de connexion  
        $this->render("form", "login", []);  
    } 
    
    /* Pour vÃ©rifier la connexion */  
    public function checkLogin() : void  
    {  
        // vÃ©rifier que le formulaire a Ã©tÃ© soumis  
        // rÃ©cupÃ©rer les champs du formulaire    
        // utiliser le manager pour vÃ©rifier si un utilisateur avec cet email existe    
        // si il existe, vÃ©rifier son mot de passe        
            // si il est bon, connecter l'utilisateur        
            // si il n'est pas bon renvoyer sur la page de connexion    
        // si il n'existe pas renvoyer vers la page de connexion
    }
}