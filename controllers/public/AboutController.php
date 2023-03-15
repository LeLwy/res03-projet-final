<?php 

class AboutController extends PublicAbstractController
{

    public function index()
    {
        $this->render('about', 'index', []);
    }
}