<?php 

class RegisterController extends PublicAbstractController
{
    
    public function index()
    {
        $this->render("form", "register", []);
    }
}