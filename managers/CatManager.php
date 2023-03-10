<?php

class CatManager extends AbstractManager{
    
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM cats');
        $query->execute();
        $cats = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $cats;
    }

    public function getCatById(int $id) : Cat
    {
        $query = $this->db->prepare('SELECT * FROM cats WHERE id = :id');
        
        $parameters = [
        'id' => $id
        ];
        
        $query->execute($parameters);
        
        $cat = $query->fetch(PDO::FETCH_ASSOC);
        
        $newCat = new Cat($cat['name'], $cat['age'], $cat['sex'], $cat['color'], $cat['is_sterilized']);
        
        $newCat->setId($cat['id']);
        $newCat->setFamily($cat['family']);
        
        return $newCat;
    }
    
    public function insertCat(Cat $cat) : Cat
    {
        $query = $this->db->prepare('INSERT INTO users VALUES(:id, :name, :age, :sex, :color, :isSterilized, :family)');
        
        $parameters = [
        'id' => null,
        'name' => $cat->getName(),
        'age' => $cat->getAge(),
        'sex' => $cat->getSex(),
        'color' => $cat->getColor(),
        'isSterilized' => $cat->getIsSterilized(),
        'family' => $cat->getFamily()
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $cat->setId($id);

        $newCat = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getCatById($id);
        
    }
    
    public function updateCat(Cat $cat) : Cat
    {
        $query = $this->db->prepare('UPDATE users SET name = :newName, age = :newAge, sex = :newSex, color = :newColor, isSterilized = :newIsSterilized, family = newFamily WHERE id = :id');
        
        $parameters = [
        'id' => $cat->getId(),
        'newName' => $cat->getName(),
        'newAge' => $cat->getAge(),
        'newSex' => $cat->getSex(),
        'newColor' => $cat->getColor(),
        'newIsSterilized' => $cat->getIsSterilized(),
        'newFamily' => $cat->getFamily()
        ];
        
        $query->execute($parameters);

        $newCat = $query->fetch(PDO::FETCH_ASSOC);
        return $newCat;
        
    }
}