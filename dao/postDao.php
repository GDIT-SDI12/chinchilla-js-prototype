<?php

class PostDao
{
    private $table = "posts";
    private $postTypesTable = "post_types";
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function list($post)
    {
        $list = array();
        $sql = "select * from " . $this->table
            . " where 1 = 1";

        if (isset($post)) {
            if (null !== $post->getId()) {
                $sql .= " and id = " . $post->getId();
            }

            if (null !== $post->getType()) {
                $sql .= " and type = '" . $post->getType() . "'";
            }

            if (null !== $post->getAuthor()) {
                $sql .= " and author = '" . $post->getAuthor() . "'";
            } else {
                // default display only approved posts
                $sql .= " and approved_at is not null";
            }

            if (null !== $post->getApprovedAt()) {
                if ($post->getApprovedAt() !== "ALL") {
                    // don't know what to do yet
                }
            }

            if (null !== $post->getOrderBy()) {
                $sql .= " order by created_at " . $post->getOrderBy();
            } else {
                $sql .= " order by created_at desc ";
            }
        }

        $con = $this->db->getConnection();

        if ($result = $con->query($sql)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
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

    public function create($post)
    {
        $flag = false;

        $sql = "insert into " . $this->table . " (author, body, title, type)"
            . " values (?, ?, ?, (select id from " . $this->postTypesTable . " where type = ?))";

        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss",
            $p_author,
            $p_body,
            $p_title,
            $p_type
//                $p_createdAt
//                $p_expiryDate
        );

        $p_author = $post->getAuthor()->getUsername();
        $p_body = $post->getBody();
        $p_title = $post->getTitle();
        $p_type = $post->getType();
//            $p_createdAt = $date = date('Y-m-d H:i:s');
//            $p_expiryDate = $post->getEmail();

        if ($stmt->execute()) {
            $flag = true;
        } else {
            echo "postDao create(post): couldn't execute sql: " . $sql . " error: " . $con->error;
            exit();
        }
        $stmt->close();
        $con->close();
        return $flag;
    }

    public function getTypes()
    {
        $types = array();
        $sql = "SELECT type FROM " . $this->postTypesTable;

        $con = $this->db->getConnection();

        if ($result = $con->query($sql)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                    $types[] = $row['type'];
                }
            }
        } else {
            echo "postDao getTypes(): couldn't execute sql: " . $sql . " error: " . $con->error;
        }
        $con->close();
        return $types;
    }
}

?>
