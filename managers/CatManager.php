<?php

class CatManager extends AbstractManager{

    private function getCatFamilyById(int $id) : Family
    {

        $query = $this->db->prepare('SELECT * FROM families WHERE id = :id');

        $parameters = [
            'id' => intval($id)
            ];

        $query->execute($parameters);

        $family = $query->fetch(PDO::FETCH_ASSOC);

        $newFamily = new Family($family['name'], $family['description']);

        $newFamily->setId($family['id']);

        return $newFamily;
    }
    
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT c_info.* FROM cats AS c_info JOIN families AS f_info ON c_info.families_id = f_info.id');
        $query->execute();
        $cats = $query->fetchAll(PDO::FETCH_ASSOC);

        $catsArray = [];
        
        foreach($cats as $cat){

            $newCat = new Cat($cat['name'], $cat['age'], $cat['sex'], $cat['color'], $cat['description'], $cat['is_sterilized']);
            $newCat->setId($cat['id']);
            $newCat->setFamily($this->getCatFamilyById($cat['families_id']));
            $catsArray[] = $newCat;
        }

        return $catsArray;
    }

    public function findLastThreeCats() : array
    {
        $query = $this->db->prepare('SELECT c_info.* FROM cats AS c_info JOIN families AS f_info ON c_info.families_id = f_info.id  ORDER BY c_info.id DESC LIMIT 3');
        $query->execute();
        $cats = $query->fetchAll(PDO::FETCH_ASSOC);

        $catsArray = [];
        
        foreach($cats as $cat){

            $newCat = new Cat($cat['name'], $cat['age'], $cat['sex'], $cat['color'], $cat['description'], $cat['is_sterilized']);
            $newCat->setId($cat['id']);
            $newCat->setFamily($this->getCatFamilyById($cat['families_id']));
            $catsArray[] = $newCat;
        }

        return $catsArray;
    }

    public function getCatById(int $id) : Cat
    {
        $query = $this->db->prepare('SELECT * FROM cats WHERE cats.id = :id');
        
        $parameters = [
        'id' => intval($id)
        ];
        
        $query->execute($parameters);
        
        $cat = $query->fetch(PDO::FETCH_ASSOC);
        
        $newCat = new Cat($cat['name'], $cat['age'], $cat['sex'], $cat['color'], $cat['description'], $cat['is_sterilized']);

        $newCat->setId($cat['id']);
        $newCat->setFamily($this->getCatFamilyById($cat['families_id']));
        
        return $newCat;
        
    }
    
    public function insertCat(Cat $cat) : Cat
    {
        $query = $this->db->prepare('INSERT INTO cats VALUES(:id, :name, :age, :sex, :color, :description, :isSterilized, :family)');

        $parameters = [
        'id' => null,
        'name' => $this->cleanString($cat->getName()),
        'age' => $this->cleanString($cat->getAge()),
        'sex' => $this->cleanString($cat->getSex()),
        'color' => $this->cleanString($cat->getColor()),
        'description' => $this->cleanString($cat->getDescription()),
        'isSterilized' => $this->cleanString($cat->getIsSterilized()),
        'family' => intval($cat->getFamilyId())
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $cat->setId($id);

        $newCat = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getCatById($id);
        
    }

    public function addMediaOnCat(int $catId, int $mediaId) : void
    {
        $query = $this->db->prepare('INSERT INTO cats_medias VALUES(:cats_id, :medias_id)');

        $parameters = [
            'cats_id' => intval($catId),
            'medias_id' => intval($mediaId)
        ];

        $query->execute($parameters);
    }
    
    public function updateCat(Cat $cat) : void
    {
        $query = $this->db->prepare('UPDATE cats SET name = :newName, age = :newAge, sex = :newSex, color = :newColor, description = :newDescription, is_sterilized = :newIsSterilized, families_id = :newFamily WHERE id = :id');
        
        $parameters = [
        'id' => intval($cat->getId()),
        'newName' => $this->cleanString($cat->getName()),
        'newAge' => $this->cleanString($cat->getAge()),
        'newSex' => $this->cleanString($cat->getSex()),
        'newColor' => $this->cleanString($cat->getColor()),
        'newDescription' => $this->cleanString($cat->getDescription()),
        'newIsSterilized' => $this->cleanString($cat->getIsSterilized()),
        'newFamily' => intval($cat->getFamilyId())
        ];
        
        $query->execute($parameters);
    }

    public function deleteCat(Cat $cat) : array
    {
        $query = $this->db->prepare('DELETE FROM cats WHERE id = :id AND families_id = :family_id');
        
        $parameters = [
        'id' => intval($cat->getId()),
        'family_id' => intval($cat->getFamilyId())
        ];
        
        $query->execute($parameters);

        return $this->findAll();
    }

    public function deleteMediasOnCat(Cat $cat) : void
    {
        $query = $this->db->prepare('DELETE FROM cats_medias WHERE cats_id = :cats_id');

        $parameters = [

            'cats_id' => intval($cat->getId())
        ];

        $query->execute($parameters);
    }

    public function deleteMediaOnCatsMedias(Cat $cat, Media $media)
    {
        $query = $this->db->prepare('DELETE FROM cats_medias WHERE cats_id = :cats_id AND medias_id = :medias_id');

        $parameters = [

            'cats_id' => intval($cat->getId()),
            'medias_id' => intval($media->getId())
        ];

        $query->execute($parameters);
    }
}