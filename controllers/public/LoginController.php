<?php 

class LoginController extends PublicAbstractController
{
    
    public function index()
    {
        require "../templates/public/login_form.phtml";
    }
}