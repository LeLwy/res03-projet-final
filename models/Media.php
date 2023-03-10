<?php

class Media{

    private int $id;
    private string $type;
    private string $format;
    private string $description;
    private string $url;
    private string $source;

    public function __construct(string $type, string $format, string $description, string $url, string $source){

        $this->id = null;
        $this->type = $type;
        $this->format = $format;
        $this->description = $description;
        $this->url = $url;
        $this->source = $source;
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

    public function getFormat() : string
    {
        return $this->format;        
    }

    public function setFormat(string $format) : void
    {
        $this->format = $format;
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

    public function getSource() : string
    {
        return $this->source;
    }

    public function setSource(string $source) : void
    {
        $this->source = $source;
    }
}