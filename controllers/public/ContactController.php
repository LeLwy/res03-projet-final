<?php 

class ContactController extends PublicAbstractController
{

    public function index()
    {
        require "../templates/public/contact_form.phtml";
    }
}