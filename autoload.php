<?php

    // call to the router

    require "services/Router.php";

    // call to models

    require "models/Cat.php";
    require "models/Disease.php";
    require "models/Event.php";
    require "models/Family.php";
    require "models/Media.php";
    require "models/Post.php";
    require "models/User.php";

    // call to controllers

    // public

    require "controllers/public/PublicAbstractController.php";
    require "controllers/public/AboutController.php";
    require "controllers/public/AdoptionController.php";
    require "controllers/public/BlogController.php";
    require "controllers/public/ContactController.php";
    require "controllers/public/DonationController.php";
    require "controllers/public/HomeController.php";
    require "controllers/public/LoginController.php";
    require "controllers/public/RegisterController.php";

    // private

    require "controllers/private/PrivateAbstractController.php";
    require "controllers/private/CatController.php";
    require "controllers/private/DiseaseController.php";
    require "controllers/private/EventController.php";
    require "controllers/private/FamilyController.php";
    require "controllers/private/UserController.php";
    
    // call to managers

    require "managers/AbstractManager.php";
    require "managers/AdminManager.php";
    require "managers/CatManager.php";
    require "managers/DiseaseManager.php";
    require "managers/EventManager.php";
    require "managers/FamilyManager.php";
    require "managers/MediaManager.php";
    require "managers/PostManager.php";
    require "managers/UserManager.php";