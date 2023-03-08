<?php 

class CatController extends AbstractController
{
    


    public function show(int $id)
    {

    }

    public function showAll(){

        require "templates/public/cats_index.phtml";
    }
}