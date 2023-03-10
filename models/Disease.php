<?php

class Disease{

    private ?int $id;
    private string $name;
    private  string $description;
    private  string $treatment;

    public function __construct(string $name, string $description, string $treatment){

        $this->id = null;
        $this->name = $name;
        $this->description = $description;
        $this->treatment = $treatment;
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

    public function getTreatment() : string
    {
        return $this->treatment;
    }

    public function setTreatment(string $treatment) : void
    {
        $this->treatment = $treatment;
    }
}