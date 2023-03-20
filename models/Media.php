<?php

class Media{

    private int $id;
    private string $type;
    private string $name;
    private string $description;
    private string $url;

    public function __construct(string $type, string $name, string $description, string $url){

        $this->id = null;
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function setType(string $type) : void
    {
        $this->type = $type;
    }

    public function getName() : string
    {
        return $this->name;        
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    public function getUrl() : string
    {
        return $this->url;
    }

    public function setUrl(string $url) : void
    {
        $this->url = $url;
    }
}