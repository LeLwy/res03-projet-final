<?php

class Event{

    private ?int $id;
    private string $name;
    private  string $description;
    private  string $location;

    public function __construct(string $name, string $description, string $location){

        $this->id = null;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
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

    public function getLocation() : string
    {
        return $this->location;
    }

    public function setLocation(string $location) : void
    {
        $this->location = $location;
    }
}