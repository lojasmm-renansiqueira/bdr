<?php

class Task
{
 
    private $conn;
    private $database_name = "test_db";
    private $table_name = "task";
 
    public $id;
    public $title;
    public $description;
    public $priority;
 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
     
        $query = "SELECT * 
                    FROM " . $this->database_name . "." . $this->table_name . "
                  ORDER BY priority ASC";
     
        $stmt = $this->conn->prepare($query);
     
        $stmt->execute();
     
        return $stmt;
    }

    function create(){
     
        $query = "INSERT INTO " . $this->database_name . "." . $this->table_name . "
                    SET title=:title, description=:description, priority=:priority";
     
        $stmt = $this->conn->prepare($query);
     
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->priority=htmlspecialchars(strip_tags($this->priority));
     
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":priority", $this->priority);
     
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

    function update(){
     
        $query = "UPDATE " . $this->database_name . "." . $this->table_name . "
                  SET title = :title,
                      description = :description,
                      priority = :priority
                WHERE idtask = :idtask";
     
        $stmt = $this->conn->prepare($query);
     
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->priority=htmlspecialchars(strip_tags($this->priority));
        $this->idtask=htmlspecialchars(strip_tags($this->idtask));
     
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':priority', $this->priority);
        $stmt->bindParam(':idtask', $this->idtask);
     
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

    function updatePriority(){
     
        $query = "UPDATE " . $this->database_name . "." . $this->table_name . "
                  SET priority = :priority
                WHERE idtask = :idtask";
     
        $stmt = $this->conn->prepare($query);
     
        $this->priority     = htmlspecialchars(strip_tags($this->priority));
        $this->idtask       = htmlspecialchars(strip_tags($this->idtask));
     
        $stmt->bindParam(':priority', $this->priority);
        $stmt->bindParam(':idtask', $this->idtask);
     
        if($stmt->execute()){
            return $this->reOrder($this->idtask, $this->priority);
        }
     
        return false;
    }

    function reOrder($idtask, $priority){

        $query = "SET @rownumber = :priority;    
                  UPDATE " . $this->database_name . "." . $this->table_name . " 
                  SET priority = (@rownumber:=@rownumber+1) 
                  WHERE priority >= :priority and idtask <> :idtask
                  ORDER BY priority asc;

                  SET @rownumber = :priority;   
                  UPDATE " . $this->database_name . "." . $this->table_name . " 
                  SET priority = (@rownumber:=@rownumber-1) 
                  WHERE priority <= :priority and idtask <> :idtask
                  ORDER BY priority desc;";
     
        $stmt = $this->conn->prepare($query);
     
        $this->priority     = htmlspecialchars(strip_tags($this->priority));
        $this->idtask       = htmlspecialchars(strip_tags($this->idtask));
     
        $stmt->bindParam(':priority', $this->priority);
        $stmt->bindParam(':idtask', $this->idtask);
     
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    function delete(){
     
        $query = "DELETE FROM " . $this->database_name . "." . $this->table_name . " WHERE idtask = ?";
        $stmt = $this->conn->prepare($query);
     
        $this->idtask=htmlspecialchars(strip_tags($this->idtask));
     
        $stmt->bindParam(1, $this->idtask);
     
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

    function initialize(){
     
        $query = "INSERT INTO `test_db`.`task` (title, description, priority) VALUES ('Task 1', 'Description 1', 1);
                  INSERT INTO `test_db`.`task` (title, description, priority) VALUES ('Task 2', 'Description 2', 2);
                  INSERT INTO `test_db`.`task` (title, description, priority) VALUES ('Task 3', 'Description 3', 3);
                  INSERT INTO `test_db`.`task` (title, description, priority) VALUES ('Task 4', 'Description 4', 4);";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }


}