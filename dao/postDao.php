<?php

    class PostDao {
        
        private $table = "posts";

        private $db;

        public function __construct() {
            $this->db = new DB();
        }

        public function list($post) {
            $list = array();
            $sql = "select * from " . $this->table
                . " where 1 = 1";

            if(isset($post)) {
                if(null !== $post->getId()) {
                    $sql .= " and id = " . $post->getId();
                }

                if(null !== $post->getType()) {
                    $sql .= " and type = '" . $post->getType() . "'";
                }

                if(null !== $post->getAuthor()) {
                    $sql .= " and author = '" . $post->getAuthor() . "'";
                }

                if(null !== $post->getOrderBy()) {
                    $sql .= " order by created_at " . $post->getOrderBy();
                } else {
                    $sql .= " order by created_at desc ";
                }
            }

            $con = $this->db->getConnection();

            if($result = $con->query($sql)) {
                if($result->num_rows > 0) {
                    while($row = $result->fetch_array()) {
                        $post = new Post();
                        $post->setId($row['id']);
                        $post->setAuthor($row['author']);
                        $post->setBody($row['body']);
                        $post->setTitle($row['title']);
                        $post->setCreatedAt($row['created_at']);
                        $post->setApprovedAt($row['approved_at']);
                        $post->setExpiredAt($row['expiry_date']);
                        $post->setActive($row['is_active']);
                        $post->setType($row['type']);
                        array_push($list, $post);
                    }
                }
            } else {
                echo "postDao list(): couldn't execute sql: " . $sql . " error: " . $con->error;
            }
            $con->close();

            return $list;
        }
    }
?>