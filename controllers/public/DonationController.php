<?php 

class DonationController extends PublicAbstractController 
{
    
    public function index()
    {
        $this->render('donation', []);
    }
}