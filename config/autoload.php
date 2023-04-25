<?php

    // call to the services

    require "services/Router.php";
    require "services/RandomStringGenerator.php";
    require "services/Uploader.php";

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
    require "controllers/public/AuthController.php";
    require "controllers/public/BlogController.php";
    require "controllers/public/CatController.php";
    require "controllers/public/ContactController.php";
    require "controllers/public/DiseaseController.php";
    require "controllers/public/DonationController.php";
    require "controllers/public/EventController.php";
    require "controllers/public/FamilyController.php";
    require "controllers/public/HomeController.php";
    require "controllers/public/LoginController.php";
    require "controllers/public/PostController.php";
    require "controllers/public/RegisterController.php";
    require "controllers/public/UserController.php";

    // private

    require "controllers/private/PrivateAbstractController.php";
    require "controllers/private/PrivateAdminController.php";
    require "controllers/private/PrivateAuthController.php";
    require "controllers/private/PrivateCatController.php";
    require "controllers/private/PrivateDiseaseController.php";
    require "controllers/private/PrivateEventController.php";
    require "controllers/private/PrivateFamilyController.php";
    require "controllers/private/PrivatePostController.php";
    require "controllers/private/PrivateUserController.php";
    
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