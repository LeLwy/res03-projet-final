<?php 

class DonationController extends PublicAbstractController 
{
    
    public function index()
    {
        $pageInfos = [

            'title' => 'Dons pour l\'association',
        ];

        $this->render('donation', 'index', [$pageInfos]);
    }
}