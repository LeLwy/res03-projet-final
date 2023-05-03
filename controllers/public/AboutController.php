<?php 

class AboutController extends PublicAbstractController
{

    public function index()
    {
        $pageInfos = [

            'title' => 'Homeless Kitten Association - À propos',
            'main_id' => 'about'
        ];

        $this->render('about', 'index', [$pageInfos]);
    }
}