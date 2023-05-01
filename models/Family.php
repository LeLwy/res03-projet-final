<?php

class Family{

    private ?int $id;
    private string $name;
    private string $description;
    private ?array $members;
    private array $cats;
    private array $medias;
    private string $mainMediaUrl;

    public function __construct(string $name, string $description){

        $this->id = null;
        $this->name = $name;
        $this->description = $description;
        $this->members = [];
        $this->cats = [];
        $this->medias = [];
        $this->mainMediaUrl = 'assets/medias/images/cat-statue.jpg';
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

    public function setMembers(array $members) : void
    {
        $this->members = $members;
    }

    public function getCats() : array
    {
        return $this->cats;
    }

    public function setCats(array $cats) : void
    {
        $this->cats = $cats;
    }

    public function getMedias() : array
    {
        return $this->medias;
    }

    public function setMedias(array $medias) : void
    {
        $this->medias = $medias;
    }

    public function addMember(User $user) : void
    {
        $this->members[] = $user;
    }

    public function addCat(Cat $cat) : void
    {
        $this->cats[] = $cat;
    }

    public function getMainMediaUrl() : string
    {
        return $this->mainMediaUrl;
    }

    public function setMainMediaUrl(string $url) : void
    {
        $this->mainMediaUrl = $url;
    }
}