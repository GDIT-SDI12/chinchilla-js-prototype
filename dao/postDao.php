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
        $sql = "select *,
                (select group_concat(filename) from images where post_id = id) as images 
                from " . $this->table . " where 1 = 1";

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
                if (null !== $post->getApprovedAt()) {
                    // For moderators.
                    // By default, they see posts which are not approved
                    if ($post->getApprovedAt() == "NULL") {
                        $sql .= " and approved_at is NULL";
                    }
                } else {
                    // default display only approved posts
                    $sql .= " and approved_at is not null";
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
                    if(isset($row['images'])) {
                        $images = explode(',', $row['images']);
                        $post->setImages($images);
                    }

                    array_push($list, $post);
                }
            }
        } else {
            echo "postDao list(): couldn't execute sql: " . $sql . " error: " . $con->error;
        }
        $con->close();
        return $list;
    }

    public function find($id)
    {
        $sql = "select 
                    p.id, p.author, p.body, p.title,
                    p.created_at, p.expiry_date, p.approved_at,
                    p.is_active, (select pt.type from post_types pt where pt.id = p.type) as type,
                    (select group_concat(filename) from images where post_id = id) as images
                from posts p where p.id = ?";
        $post = new Post();
        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        // echo $con->error;
        
        $stmt->bind_param("i", $p_id);

        $p_id = $id;

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                if ($row = $result->fetch_array()) {
                    
                    $post->setId($row['id']);
                    $post->setAuthor($row['author']);
                    $post->setTitle($row['title']);
                    $post->setBody($row['body']);
                    $post->setCreatedAt($row['created_at']);
                    $post->setExpiredAt($row['expiry_date']);
                    $post->setApprovedAt($row['approved_at']);
                    $post->setActive($row['is_active']);
                    $post->setType($row['type']);
                    if(isset($row['images'])) {
                        $images = explode(',', $row['images']);
                        $post->setImages($images);
                    }
                }
            } else {
                //echo "cannot find user [" . $user->getUsername() . "]";
                $post = null;
            }
            $stmt->close();
        } else {
            //echo "couldn't execute sql: " . $sql . " error: " . $con->error;
            $post = null;
        }
        $con->close();
        return $post;
    }

    public function update($post)
    {
        $flag = false;

        $sql = "update " . $this->table .
            " set
                    body = ?,
                    title = ?,
                    expiry_date = ?,
                    approved_at = ?,
                    is_active = ?,
                    type = (select id from " . $this->postTypesTable . " where type = ?)
                where id = ?";

        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssisi",
            $p_body,
            $p_title,
            $p_expiryDate,
            $p_approvedAt,
            $p_isActive,
            $p_type,
            $p_id
        );

        $p_id = $post->getId();
//        $p_author = $post->getAuthor();
        $p_body = $post->getBody();
        $p_title = $post->getTitle();
//        $p_createdAt = $post->getCreatedAt();
        $p_expiryDate = $post->getExpiredAt();
        $p_approvedAt = $post->getApprovedAt();
        $p_isActive = $post->isActive();
        $p_type = $post->getType();

        if ($stmt->execute()) {
            $flag = true;
        } else {
            echo "postDao update(post): couldn't execute sql: " . $sql . " error: " . $con->error;
            exit();
        }
        $stmt->close();
        $con->close();
        return $flag;
    }

    public function create($post)
    {
        $insertId = 0;

        $sql = "insert into " . $this->table . " (author, body, title, type, created_at)"
            . " values (?, ?, ?, (select id from " . $this->postTypesTable . " where type = ?), ?)";

        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssss",
            $p_author,
            $p_body,
            $p_title,
            $p_type,
            $p_createdAt
//                $p_expiryDate
        );

        $p_author = $post->getAuthor();
        $p_body = $post->getBody();
        $p_title = $post->getTitle();
        $p_type = $post->getType();
        $p_createdAt = $post->getCreatedAt();
//            $p_expiryDate = $post->;

        if ($stmt->execute()) {
            $insertId = $con->insert_id;
        } else {
            echo "postDao create(post): couldn't execute sql: " . $sql . " error: " . $con->error;
            exit();
        }
        $stmt->close();
        $con->close();
        return $insertId;
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
