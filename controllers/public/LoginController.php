<?php 

class LoginController extends PublicAbstractController
{
    
    public function index()
    {
        $this->render("form", "login", []);
    }
}