<?php

class Post {
    // Database Jaguns
    private $connection;
    private $table = 'posts';

    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with Database
    public function __construct($database) {
        $this->connection = $database;
    }

    //Get Posts
    public function read() {
        
        $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.author, p.created_at
                FROM' . $this->$table . 'p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                ORDER BY
                    p.created_at DESC';

        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement;

    }

    // Get Single Post
    public function read_single() {
        $query= 'SELECT c.name as category_name, p.id, p.name, p.category_id, p.title, p.author, p.created_at
                FROM' .$this->$table. 'p
                LEFT JOIN
                    categories c ON p.dategory_id = c.id
                WHERE
                    p.id = ?
                LIMIT 0,1';

        $statement = $this->connection->prepare($query)

        $statement->bindParam(1, $this->id);

        $statement->execute();

        // Set properties
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }

    // Create Post
    public function create() {
        $query = 'INSERT INTO ' .$this->$table.
                'SET
                title= :title,
                body= :body,
                author = :author,
                category_id = :category_id';

        $statement = $this->connection->prepare($query);


        //Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind Data
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':body', $this->body);
        $statement->bindParam(':author', $this->author);
        $statement->bindParam(':category_id', $this->category_id);
        $statement->bindParam(':id', $this->id);

        //
        if($statement->execute()) {
            return True;
        }

        //error
        printf("Error: %s. \n", $statement->error)

        return False;
    }

    //Update Post
    public function update(){
        //
        $query = 'UPDATE '. $this->table . '
                            SET
                            title= :title,
                            body= :body,
                            author = :author,
                            category_id = :category_id
                            WHERE
                            id = :id';
                    
        $statement = $this->connection->prepare(query);

        // Clean Data
        $this->title = 
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        //Bind Data
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':body', $this->body);
        $statement->bindParam(':author', $this->author);
        $statement->bindParam(':category_id', $this->category_id);
        $statement->bindParam(':id', $this->id);

        if($statement->execute()) {
            return True;
        }

        // Error

        printf("Error: %s.\n", $statement->error);

        return False;
        
    }

    // Delete Post
    public function delete(){
        $query = 'DELETE FROM'. $this->table. 'WHERE id = :id';

        $statement = $this->connection->prepare($query);

        $this->id = htmlspecialcchars(strip_tags($this->id));

        $statement->bindParam(':id', $this->id);

        if($statement->execute()) {
            return True;
        }

        printf("Error: %s. \n", $statement->error)

        return False;
    }
        
}