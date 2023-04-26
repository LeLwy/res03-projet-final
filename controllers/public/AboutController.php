<?php 

class AboutController extends PublicAbstractController
{

    public function index()
    {
        $pageInfos = [

            'title' => 'À propos',
        ];

        $this->render('about', 'index', [$pageInfos]);
    }
}