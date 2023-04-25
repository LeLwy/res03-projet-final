<?php  
 
class AuthController extends PublicAbstractController {  

    private UserManager $userManager;
  
    public function __construct()  
    {  
        $this->userManager = new UserManager();
    }  
    
    /* Pour la page d'inscription */  
    public function register() : void  
    {  
        // render la page avec le formulaire d'inscription  
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
    public function checkLogin($post) : void  
    {  
        // vÃ©rifier que le formulaire a Ã©tÃ© soumis  
        if(isset($post['loginFormName'])){

            // rÃ©cupÃ©rer les champs du formulaire
            if(isset($post["email"])&&!empty($post["email"])
            && isset($post["password"]) && !empty($post["password"])){  

                // utiliser le manager pour vÃ©rifier si un utilisateur avec cet email existe
                $verifiedEmail = $this->userManager->verifyExistingEmail($post['email']);
                if($verifiedEmail){

                    var_dump($verifiedEmail);
                    $userToConnect = $this->userManager->getUserByEmail($post["email"]);  
                    // si il existe, vÃ©rifier son mot de passe
                    if($userToConnect !== null){
    
                        $verifiedPassword = password_verify($post["password"], $userToConnect->getPassword());
                    }else{
    
                        $errorMessage = "Aucun utilisateur enregistré sous cette adresse";
                        // si il n'existe pas renvoyer vers la page de connexion
                        $this->render("form", "login", [$errorMessage]);
                    }        
                    // si il est bon, connecter l'utilisateur
                    if($verifiedPassword && $userToConnect->getStatus() === "actif"){
    
                        $_SESSION["isConnected"] = true;
                        $_SESSION["id"] = $userToConnect->getId();
                        $_SESSION["firstName"] = $userToConnect->getFirstName();
                        $_SESSION["lastName"] = $userToConnect->getLastName();
                        $_SESSION["email"] = $userToConnect->getEmail();
                        $_SESSION["address"] = $userToConnect->getAddress();
                        $_SESSION["media_id"] = $userToConnect->getMediaId();
                        $_SESSION["family_id"] = $userToConnect->getFamilyId();
                        $_SESSION["role"] = $userToConnect->getRole();
                        $_SESSION["status"] = $userToConnect->getStatus();
    
                        if($_SESSION['role'] === "contributeur"){

                            header('Location: /res03-projet-final/utilisateurs/'.$_SESSION['id']);
                            
                        }else if($_SESSION['role'] === "admin"){

                            header('Location: /res03-projet-final/admin');
                        }
    
                    }        
                }else{
    
                    $errorMessage = "Les informations saisies sont incorrectes";
                    // si il n'existe pas renvoyer vers la page de connexion
                    $this->render("form", "login", [$errorMessage]);  
                }
            // si il n'est pas bon renvoyer sur la page de connexion    
            }else{

                $errorMessage = "Veuillez remplir les champs du formulaire";
                // si il n'existe pas renvoyer vers la page de connexion
                $this->render("form", "login", [$errorMessage]);  
            }
        }

    }
    public function logout()
    {
        
        session_destroy();
        header('Location: /res03-projet-final');
    }
}