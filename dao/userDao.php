<?php

class UserDao
{
    private $table = "users";
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function find($username)
    {
        $sql = "select * from " . $this->table . " where username = ?;";
        $user = new User();
        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $p_username);

        $p_username = $username;

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                if ($row = $result->fetch_array()) {
                    $user = new User();
                    $user->setUsername($row['username']);
                    $user->setPassword($row['password']);
                    $user->setFirstName($row['firstname']);
                    $user->setLastName($row['lastname']);
                    $user->setPhoneNumber($row['phonenumber']);
                    $user->setEmail($row['email']);
                    $user->setRole($row['role']);
                }
            } else {
                //echo "cannot find user [" . $user->getUsername() . "]";
                $user = null;
            }
            $stmt->close();
        } else {
            //echo "couldn't execute sql: " . $sql . " error: " . $con->error;
            $user = null;
        }
        $con->close();
        return $user;
    }

    public function create($user)
    {
        $flag = false;

        $sql = "insert into " . $this->table . " (username, password, name, email, date_joined, role_id)"
            . " values (?, ?, ?, ?, date_format(now(), '%Y-%m-%d'), ?)";

        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssi",
            $p_username,
            $p_password,
            $p_name,
            $p_email,
            $p_role
        );

        $p_username = $user->getUsername();
        $p_password = $user->getPassword();
        $p_name = $user->getName();
        $p_email = $user->getEmail();
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

        $sql = "update " . $this->table
            . " set username = ?, name = ?, email = ?, is_enabled = ? where id = ?;";

        $con = $this->db->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssii",
            $p_username,
            $p_name,
            $p_email,
            $p_isEnabled,
            $p_id
        );

        $p_username = $user->getUsername();
        $p_name = $user->getName();
        $p_email = $user->getEmail();
        $p_isEnabled = $user->isEnabled();
        $p_id = $user->getId();

        if ($stmt->execute()) {
            $flag = true;
        }
        $stmt->close();
        $con->close();
        return $flag;
    }
}

?>