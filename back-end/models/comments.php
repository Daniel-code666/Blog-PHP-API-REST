<?php

class comments
{
    private $conn;

    public $comm_id;
    public $comm_text;
    public $comm_user_id;
    public $comm_art_id;
    public $comm_estate;
    public $comm_created_at;
    public $comm_user_email;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
    }

    function getAllComms()
    {
        $stmt = $this->conn->prepare("SELECT * FROM comments 
            JOIN users ON user_id = comm_user_id
            JOIN articles ON art_id = comm_art_id");

        $stmt->execute();

        return $stmt;
    }

    function getSingleComm(){
        $stmt = $this->conn->prepare("SELECT * FROM comments
            JOIN users ON user_id = comm_user_id
            WHERE comm_id = :comm_id");

        $stmt->bindParam(":comm_id", $this->comm_id);

        if($stmt->execute()){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->comm_id = $result['comm_id'];
            $this->comm_user_id = $result['comm_user_id'];
            $this->comm_user_email = $result['user_email'];
            $this->comm_text = $result['comm_text'];
            $this->comm_estate = $result['comm_estate'];
        }else{
            return false;
        }
    }

    function createComm(){
        $comm_estate = 0;

        $stmt = $this->conn->prepare("INSERT INTO comments(comm_text, comm_art_id, comm_user_id, comm_estate)
            VALUE(:comm_text, :comm_art_id, :comm_user_id, :comm_estate)");

        $stmt->bindParam(":comm_text", $this->comm_text);
        $stmt->bindParam(":comm_art_id", $this->comm_art_id);
        $stmt->bindParam(":comm_user_id", $this->comm_user_id);
        $stmt->bindParam(":comm_estate", $comm_estate);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function updtComm(){
        $stmt = $this->conn->prepare("UPDATE comments SET comm_estate = :comm_estate
            WHERE comm_id = :comm_id");

        $stmt->bindParam(":comm_id", $this->comm_id);
        $stmt->bindParam(":comm_estate", $this->comm_estate);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function deleteComm(){
        $stmt = $this->conn->prepare("DELETE FROM comments WHERE comm_id = :comm_id");

        $stmt->bindParam(":comm_id", $this->comm_id);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function getCommByArt(){
        $stmt = $this->conn->prepare("SELECT * FROM comments JOIN users ON user_id = comm_user_id 
        WHERE comm_art_id = :comm_art_id 
        AND comm_estate = 1");

        $stmt->bindParam(":comm_art_id", $this->comm_art_id);

        $stmt->execute();

        return $stmt;
    }
}
