<?php 

class HomeController extends PublicAbstractController
{

    public function index()
    {
        $pageInfos = [

            'title' => 'Accueil',
        ];

        $this->render('home', "index", [$pageInfos]);
    }
}