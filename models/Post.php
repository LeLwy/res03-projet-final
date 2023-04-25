<?php

class Post{

    private ?int $id;
    private string $title;
    private string $content;
    private string $date;
    private ?User $author;

    public function __construct(string $title, string $content, string $date){

        $this->id = null;
        $this->title = $title;
        $this->content = $content;
        $this->date = $date;
        $this->author = null;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function setContent(string $content) : void
    {
        $this->content = $content;
    }

    public function getDate() : string
    {
        return $this->date;
    }

    public function setDate(string $date) : void
    {
        $this->date = $date;
    }

    public function getAuthor() : User
    {
        return $this->author;
    }

    public function setAuthor(User $author) : void
    {
        $this->author = $author;
    }

    public function getAuthorName() : string
    {
        return $this->author->getFirstName()." ".$this->author->getLastName();
    }

    public function getAuthorId() : int
    {
        return $this->author->getId();
    }
}