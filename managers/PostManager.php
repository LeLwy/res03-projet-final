<?php 

class PostManager extends AbstractManager{

    public function getPostAuthorById(int $userId) : User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');

        $parameters = [

            'id' => $userId
        ];

        $query->execute($parameters);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        $author = new User($user['first_name'], $user['last_name'], $user['email'], $user['address'], $user['password'], $user['media_id'], $user['family_id']);

        $author->setId($user['id']);

        return $author;
    }

    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM posts');
        $query->execute();
        $posts = $query->fetchAll(PDO::FETCH_ASSOC);

        $postsArray = [];

        foreach($posts as $post){

            $newPost = new Post($post['title'], $post['content'], $post['date'], $post['users_id']);
            $newPost->setId($post['id']);
            $newPost->setAuthor($this->getPostAuthorById($post['users_id']));

            $postsArray[] = $newPost;
        }
        
        return $postsArray;
    }

    public function getPostById(int $id) : Post
    {
        $query = $this->db->prepare('SELECT * FROM posts WHERE id = :id');
        
        $parameters = [
        'id' => $id
        ];
        
        $query->execute($parameters);
        
        $post = $query->fetch(PDO::FETCH_ASSOC);
        
        $newPost= new Post($post['title'], $post['content'], $post['date'], $post['users_id']);
        
        $newPost->setId($post['id']);
        
        return $newPost;
    }
    
    public function insertPost(Post $post) : Post
    {
        $query = $this->db->prepare('INSERT INTO posts VALUES(:id, :title, :content, :date, :author_id)');
        
        $parameters = [
        'id' => null,
        'title' => $post->getTitle(),
        'content' => $post->getContent(),
        'date' => $post->getDate(),
        'author_id' =>$post->getAuthorId()
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $post->setId($id);

        $newPost = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getPostById($id);
        
    }
    
    public function updatePost(Post $post) : void
    {
        $query = $this->db->prepare('UPDATE posts SET title = :newTitle, content = :newContent, date = :newDate WHERE id = :id');
        
        $parameters = [
        'id' => $post->getId(),
        'newTitle' => $post->getTitle(),
        'newContent' => $post->getContent(),
        'newDate' => $post->getDate(),
        ];
        
        $query->execute($parameters);
    }

    public function deletePost(Post $post) : void
    {
        $query = $this->db->prepare('DELETE FROM posts WHERE id = :post_id');

        $parameters = [
            'post_id' => $post->getId()
        ];

        $query->execute($parameters);
    }
}