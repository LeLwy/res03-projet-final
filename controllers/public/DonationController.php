<?php 

class DonationController extends PublicAbstractController 
{
    
    public function index()
    {
        $pageInfos = [

            'title' => 'Dons pour l\'association - Homeless Kitten Association',
            'main_id' => 'donation'
        ];

        $this->render('donation', 'index', [$pageInfos]);
    }
}