<?php

require "./../controllers/AboutController.php";
require "./../controllers/BlogController.php";
require "./../controllers/CatController.php";
require "./../controllers/DiseaseController.php";
require "./../controllers/DonationController.php";
require "./../controllers/EventController.php";
require "./../controllers/FamilyController.php";
require "./../controllers/HomeController.php";
require "./../controllers/LoginController.php";
require "./../controllers/RegisterController.php";
require "./../controllers/UserController.php";

class Router{
    
    private AboutController $aboutController;
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

   public function checkRoute(){


       if(isset($_GET["path"])){

           $route = explode("/",$_GET["path"]);

           /* / */
           if($route[0]=== ""){

            $this->homeController->index();

            /* /a-l-adoption */
            /* /a-l-adoption/id */ 
           }else if($route[0]=== "a-l-adoption"){

            if(!isset($route[1])){

                $this->catController->index();

            }else if(isset($route[1]) && count($route) === 2){

                $id = intval($route[1]);

                $this->catController->show($id);
            }
            
            /* /a-propos */
           }else if($route[0]=== "a-propos"){

            $this->aboutController->index();
            
            /* /evenements */
            /* evenements/id */
           }else if($route[0]=== "evenements"){

            if(!isset($route[1])){

                $this->eventController->index();

            }else if(isset($route[1]) && count($route) === 2){

                $id = intval($route[1]);

                $this->eventController->show($id);
            }
            
           }else if($route[0]=== "les-familles"){

            if(!isset($route[1])){

                $this->familyController->index();

            }else if(isset($route[1]) && count($route) === 2){

                $id = intval($route[1]);

                $this->familyController->show($id);
            }
            
           }else if($route[0]=== "dons"){

            $this->donationController->index();
            
           }else if($route[0]=== "se-connecter"){

            $this->loginController->index();
            
           }else if($route[0]=== "s-inscrire"){

            $this->registerController->index();
            
           }
        }
    }
}