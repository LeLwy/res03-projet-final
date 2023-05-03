<?php 

class NotFoundController extends PublicAbstractController
{

    public function index()
    {

        $pageInfos = [

            'title' => 'Homeless Kitten Association - Page introuvable',
            'main_id' => '404'
        ];
        
        $this->render('404', "index", [$pageInfos]);
    }
}