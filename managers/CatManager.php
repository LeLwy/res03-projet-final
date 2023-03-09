<?php

class CatManager extends AbstractManager{
    
    public function getAllCats() : array
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
                
                return $newCat;
            }
    
    }