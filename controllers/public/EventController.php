<?php

class EventController extends PublicAbstractController
{
    
    public function index(){

        $this->render('event', 'index', []);
    }

    public function show(int $id)
    {

    }
}