<?php 

class HomeController extends PublicAbstractController
{

    public function index()
    {
        $this->render('home', "", []);
    }
}