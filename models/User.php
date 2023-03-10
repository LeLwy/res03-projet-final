<?php

class User{

    private ?int $id;
    private string $username;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $address;
    private string $role;
    private string $password;
    private Family $family;

    public function __construc(string $username, string $firstName, string $lastName, string $email, string $address, string $role, string $password){

        $this->id = null;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->address = $address;
        $this->role = $role;
        $this->password = $password;
        $this->family = null;
    }
    
    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }
    
    public function getUsername() : string
    {
        return $this->username;
    }

    public function setUsername(string $username) : void
    {
        $this->username = $username;
    }

    public function getFirstName() : string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName) : void
    {
        $this->firstName = $firstName;
    }

    public function getLastName() : string
    {
        return $this->lastName;
    }
    
    public function setLastName(string $lastName) : void
    {
        $this->lastName = $lastName;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }

    public function getAddress() : string
    {
        return $this->address;
    }

    public function setAddress(string $address) : void
    {
        $this->address = $address;
    }

    public function getRole() : string
    {
        return $this->role;
    }

    public function setRole(string $role) : void
    {
        $this->role = $role;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }

    public function getFamily() : Family
    {
        return $this->family;
    }

    public function setFamily(Family $family) : void
    {
        $this->family = $family;
    }

}