<?php

class UserDao
{
    private $table = "users";
    private $savedPostsTable = "saved_posts";
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function find($username)
    {
        $sql = "select
                *, 
                (select group_concat(post_id) from " . $this->savedPostsTable . " where username = ?) as saved_posts
                from " . $this->table . " where username = ?";
        $user = new User();
        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $username, $username);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                if ($row = $result->fetch_array()) {
                    $user->setUsername($row['username']);
                    $user->setPassword($row['password']);
                    $user->setFirstName($row['first_name']);
                    $user->setLastName($row['last_name']);
                    $user->setPhoneNumber($row['phone_number']);
                    $user->setEmail($row['email']);
                    $user->setRole($row['role']);
                    if (isset($row['saved_posts'])) {
                        $savedPosts = explode(',', $row['saved_posts']);
                        $user->setSavedPosts($savedPosts);
                    }
                }
            } else {
                //echo "cannot find user [" . $user->getUsername() . "]";
                $user = null;
            }
            $stmt->close();
        } else {
//            echo "couldn't execute sql: " . $sql . " error: " . $con->error;
            $user = null;
        }
        $con->close();
        return $user;
    }

    public function create($user)
    {
        $flag = false;

        $sql = "insert into " . $this->table . " (username, password, first_name, last_name, email, phone_number, role)"
            . " values (?, ?, ?, ?, ?, ?, ?)";

        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssss",
            $p_username,
            $p_password,
            $p_firstName,
            $p_lastName,
            $p_email,
            $p_phoneNumber,
            $p_role
        );

        $p_username = $user->getUsername();
        $p_password = $user->getPassword();
        $p_firstName = $user->getFirstName();
        $p_lastName = $user->getLastName();
        $p_email = $user->getEmail();
        $p_phoneNumber = $user->getPhoneNumber();
        $p_role = $user->getRole();

        if ($stmt->execute()) {
            $flag = true;
        }
        $stmt->close();
        $con->close();
        return $flag;
    }

    public function update($user)
    {
        $flag = false;

        $sql = "UPDATE " . $this->table . "
                SET password = ?, first_name = ?, last_name = ?, email = ?, phone_number = ? WHERE username = ?";
        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssss",
            $p_password,
            $p_firstName,
            $p_lastName,
            $p_email,
            $p_phoneNumber,
            $p_username
        );

        $p_username = $user->getUsername();
        $p_password = $user->getPassword();
        $p_firstName = $user->getFirstName();
        $p_lastName = $user->getLastName();
        $p_email = $user->getEmail();
        $p_phoneNumber = $user->getPhoneNumber();
        $p_role = $user->getRole();

        if ($stmt->execute()) {
            $flag = true;
        }
        $stmt->close();
        $con->close();

        return $flag;
    }

    public function savePost($username, $postId)
    {
        $flag = false;

        $sql = "insert into " . $this->savedPostsTable . " (username, post_id)"
            . " values (?, ?)";

        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si",
            $username,
            $postId
        );

        if ($stmt->execute()) {
            $flag = true;
        }
        $stmt->close();
        $con->close();
        return $flag;
    }

    public function removeSavedPost($username, $postId)
    {
        $flag = false;

        $sql = "DELETE FROM " . $this->savedPostsTable . " WHERE username = ? AND post_id = ?";

        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si",
            $username,
            $postId
        );

        if ($stmt->execute()) {
            $flag = true;
        }
        $stmt->close();
        $con->close();
        return $flag;
    }
}

?>
