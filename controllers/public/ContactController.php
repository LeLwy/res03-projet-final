<?php 

class ContactController extends PublicAbstractController
{

    public function index()
    {
        $this->render('form', 'contact', []);
    }
}