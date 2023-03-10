<?php 

class PostManager extends AbstractManager{

    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM posts');
        $query->execute();
        $post = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $post;
    }

    public function getPostById(int $id) : Post
    {
        $query = $this->db->prepare('SELECT * FROM posts WHERE id = :id');
        
        $parameters = [
        'id' => $id
        ];
        
        $query->execute($parameters);
        
        $post = $query->fetch(PDO::FETCH_ASSOC);
        
        $newPost= new Post($post['title'], $post['content']);
        
        $newPost->setId($post['id']);
        
        return $newPost;
    }
    
    public function insertPost(Post $post) : Post
    {
        $query = $this->db->prepare('INSERT INTO posts VALUES(:id, :title, :content)');
        
        $parameters = [
        'id' => null,
        'title' => $post->getTitle(),
        'content' => $post->getContent()
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $post->setId($id);

        $newPost = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getPostById($id);
        
    }
    
    public function updatePost(Post $post) : Post
    {
        $query = $this->db->prepare('UPDATE posts SET title = :newTitle, content = :newContent WHERE id = :id');
        
        $parameters = [
        'id' => $post->getId(),
        'newTitle' => $post->getTitle(),
        'newContent' => $post->getContent()
        ];
        
        $query->execute($parameters);

        $newPost = $query->fetch(PDO::FETCH_ASSOC);
        return $newPost;
        
    }
}