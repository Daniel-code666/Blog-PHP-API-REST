<?php

class articles
{
    private $conn;

    public $art_id;
    public $art_name;
    public $art_desc;
    public $art_img;
    public $created_at;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
    }

    public function getAllArticles()
    {
        $stmt = $this->conn->prepare("SELECT * FROM articles");

        $stmt->execute();

        return $stmt;
    }

    public function getSingleArticle()
    {
        $stmt = $this->conn->prepare("SELECT * FROM articles WHERE art_id = :art_id");

        $stmt->bindParam(":art_id", $this->art_id);

        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->art_id = $data['art_id'];
            $this->art_name = $data['art_name'];
            $this->art_desc = $data['art_desc'];
            $this->art_img = $data['art_img'];
        } else {
            return false;
        }
    }

    public function createArticle()
    {
        $stmt = $this->conn->prepare("INSERT INTO articles(art_name, art_desc, art_img) VALUES(:art_name, :art_desc,
            :art_img)");

        $stmt->bindParam(":art_name", $this->art_name);
        $stmt->bindParam(":art_desc", $this->art_desc);
        $stmt->bindParam(":art_img", $this->art_img);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updtArticle()
    {
        // $imgFolder = 'C:\xampp\htdocs\Cosas\blog_api\front-end\img\articulos\\';

        $stmt = $this->conn->prepare("SELECT * FROM articles WHERE art_id = :art_id");

        $stmt->bindParam(":art_id", $this->art_id);

        $stmt->execute();

        $currData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (
            $currData['art_name'] != $this->art_name || $currData['art_desc'] != $this->art_desc ||
            $currData['art_img'] != $this->art_img
        ) {
            // if ($this->art_img != "") {
            //     $imgFolder = $imgFolder . $this->art_img;

            //     unlink($imgFolder);
            // }

            $stmt = $this->conn->prepare("UPDATE articles SET art_name = :art_name,  art_desc = :art_desc, 
            art_img = :art_img WHERE art_id = :art_id");

            $stmt->bindParam(":art_name", $this->art_name);
            $stmt->bindParam(":art_desc", $this->art_desc);
            $stmt->bindParam(":art_img", $this->art_img);
            $stmt->bindParam(":art_id", $this->art_id);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteArticle()
    {
        $imgFolder = 'C:\xampp\htdocs\Cosas\blog_api\front-end\img\articulos\\';

        $stmt = $this->conn->prepare("SELECT art_img FROM articles WHERE art_id = :art_id");
        $stmt->bindParam(":art_id", $this->art_id);

        $stmt->execute();

        $img = $stmt->fetch(PDO::FETCH_ASSOC);

        $imgFolder = $imgFolder . $img["art_img"];

        unlink($imgFolder);

        $stmt = $this->conn->prepare("DELETE FROM articles WHERE art_id = :art_id");

        $stmt->bindParam(":art_id", $this->art_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
