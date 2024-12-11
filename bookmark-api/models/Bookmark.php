<?php

class Bookmark{
    private $id;
    private $Link;
    private $title;
    private $dateAdded;
    private $dbConnection;
    private $dbTable ='bookmarks';

    public function __construct($dbConnection){
        $this->dbConnection = $dbConnection;
    }

    public function getId(){
        return $this->id;
    }

    public function getLink(){
        return $this->Link;
    }
    
    public function getTitle(){
        return $this->title;
    }

    public function getDateAdded(){
        return $this->dateAdded;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setLink($link){
        $this->Link = $link;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setDateAdded($dateAdded){
        $this->dateAdded = $dateAdded;
    }


    public function create(){
        $query = "INSERT INTO ".$this->dbTable."(link, title, dateAdded) VALUES(:linkName, :titleName, NOW());";
        $stmt = $this->dbConnection->prepare($query);
        $stmt ->bindParam(":linkName", $this->Link);
        $stmt ->bindParam(":titleName", $this->title);

        if($stmt->execute()){
            return true;
        }
        printf("ERROR: %s", stmt->error);
        return false;
    }

    public function readOne(){
        $query = "SELECT * FROM " .$this->dbTable." WHERE id=:id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute() && $stmt->rowCount() == 1){
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $this->id = $result->id;
            $this->Link = $result->Link;
            $this->title = $result->title;
            $this->dateAdded = $result->dateAdded;
            return true;
        }
        return false;
    }
    public function readALL(){
        $query = "SELECT * FROM " .$this->dbTable;
        $stmt = $this->dbConnection->prepare($query);
        if($stmt->execute() && $stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->dbTable . " WHERE id=:id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute() && $stmt->rowCount() ==1) {
            return true;
        }
        return false;
    }

}