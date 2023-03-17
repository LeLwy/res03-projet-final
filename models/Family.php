<?php

class Family{

    private ?int $id;
    private string $name;
    private string $description;
    private array $members;
    private array $cats;

    public function __construct(string $name, string $description){

        $this->id = null;
        $this->name = $name;
        $this->description = $description;
        $this->members = [];
        $this->cats = [];
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

    public function getMembers() : array
    {
        return $this->members;
    }

    public function setMembers(string $members) : void
    {
        $this->members = $members;
    }

    public function getCats() : array
    {
        return $this->cats;
    }

    public function setCats(string $cats) : void
    {
        $this->cats = $cats;
    }

    public function addMember(User $user) : void
    {
        $this->members[] = $user;
    }

    public function addCat(Cat $cat) : void
    {
        $this->cats[] = $cat;
    }
}