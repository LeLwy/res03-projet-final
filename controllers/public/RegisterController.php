<?php 

class RegisterController extends PublicAbstractController
{
    
    public function index()
    {
        require "../templates/public/register_form.phtml";
    }
}