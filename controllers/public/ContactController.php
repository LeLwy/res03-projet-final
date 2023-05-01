<?php 

class ContactController extends PublicAbstractController
{

    public function index()
    {
        $pageInfos = [

            'title' => 'Contacter l\'association - Homeless Kitten Association',
            'main_id' => 'contact'
        ];

        $this->render('form', 'contact', [$pageInfos]);
    }
}