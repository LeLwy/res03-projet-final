<?php

class Cat{

    private ?int $id;
    private string $name;
    private string $age;
    private string $sex;
    private string $color;
    private string $description;
    private string $isSterilized;
    private ?Family $family;
    private array $medias;
    private ?string $mainMediaUrl;
    
    public function __construct(string $name, string $age, string $sex, string $color, string $description, string $isSterilized){
        
        $this->id = null;
        $this->name = $name;
        $this->age = $age;
        $this->sex = $sex;
        $this->color = $color;
        $this->description = $description;
        $this->isSterilized = $isSterilized;
        $this->family = null;
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
    
    public function getAge() : string
    {
        return $this->age;
    }

    public function setAge(int $age) : void
    {
        $this->age = $age;
    }
    
    public function getSex() : string
    {
        return $this->sex;
    }

    public function setSex(int $sex) : void
    {
        $this->sex = $sex;
    }
    
    public function getColor() : string
    {
        return $this->color;
    }

    public function setColor(int $color) : void
    {
        $this->color = $color;
    }
    
    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(int $description) : void
    {
        $this->description = $description;
    }
    
    public function getIsSterilized() : string
    {
        return $this->isSterilized;
    }

    public function setIsSterilized(int $isSterilized) : void
    {
        $this->isSterilized = $isSterilized;
    }
    
    public function getFamily() : Family
    {
        return $this->family;
    }

    public function setFamily(Family $family) : void
    {
        $this->family = $family;
    }
    
    public function getFamilyName() : string
    {
        return $this->family->getName();
    }
    
    public function getFamilyId() : int
    {
        return $this->family->getId();
    }

    public function getMedias() : array
    {
        return $this->medias;
    }

    public function setMedias(array $medias) : void
    {
        $this->medias = $medias;
    }

    public function addMedias(Media $media) : void
    {
        $this->medias[] = $media;
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