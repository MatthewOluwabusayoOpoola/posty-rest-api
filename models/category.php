<?php

class Category {
    //Database Jaguns
    private $connection
    private $table  = 'categories';

    // Properties
    public $id;
    public $name;
    public $created_at;

    // Constructor with Database
    public function __construct($database) {
        $this->$connection = $database;
    }

    // Get categories
    public function red(){
        $query = 'SELECT 
                    id,
                    name,
                    created_at
                  FROM
                    ' . $this->table .
                  'ORDER BY
                    created_at DESC';

    $statement = $this->connection->prepare($query);

    $statement->excute();

    return $statement;
    }

    // Get Single Category
    public function read_single(){
        $query = 'SELECT
                    id,
                    name,
                    created_at
                   FROM
                     ' . $this->table .
                   'WHERE id = ?
                    LIMIT = O,1';

        $statement= $this->connection->prepare($query);

        $statement->bindParam(1, $this->id);
        
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->id = row['id'];
        $this->name = $row['name'];
    }

    // Create Category
    public function create() {
        $query = 'INSERT INTO'
                    .$this->table .
                'SET
                    name = :name';
        
        $statement = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));

        $statement->bindParam(':name', $this->name);

        if($statement->execute()) {
            return True;
        }
        printf("Error: %s.\n", $statement->error);

        return False;
    }

    public function update() {
        $query =    'UPDATE'
                        .$this->table.
                    'SET
                        name = :name
                    WHERE
                        id = :id';
        
        $statement = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':id', $this->id);

        if ($statement->execute()){
            return True;
        }

        printf("Error: %s. \n", $stmt->error);

        return False;
                
    }

    public function delete(){
        $query = 'DELET FROM' . $this->table. 'WHERE id = :id';

        $statement = $this->connection->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam(':id', $this->id);

        if($statement->execute()){
            return True;
        }

        printf("Error: %s. \n", $statement->error);

        return False;
    }
}