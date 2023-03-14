<?php

    session_start();

    require "config/autoload.php";

    $router = new Router;

    $router->checkRoute();