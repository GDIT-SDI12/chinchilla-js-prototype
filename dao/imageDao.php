<?php

class ImageDao {
    
    private $table = "images";
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function create($image) {
        $flag = false;

        $sql = "insert into " . $this->table 
            . " values (?, ?)";

        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("is",
            $p_postId,
            $p_filename
        );

        $p_postId = $image->getPost();
        $p_filename = $image->getFilename();

        if($stmt->execute()) {
            $flag = true;
        } else {
            echo "imageDao create(image): couldn't execute sql: " . $sql . " error: " . $con->error;
            exit();
        }

        $stmt->close();
        $con->close();
        return $flag;
    }

}

?>