<?php 

class HomeController extends AbstractController
{

    public function home()
    {
        require "templates/public/home.phtml";
    }
}