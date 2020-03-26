<?php

class User
{
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $phoneNumber;
    private $email;
    private $role;
    private $savedPosts;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function savePost($postId)
    {
        if (null == $this->savedPosts) {
            $this->savedPosts = [];
        }
        $this->savedPosts[$postId];
    }

    public function removeSavedPost($postId)
    {
        if (($key = array_search($postId, $this->savedPosts)) !== false) {
            unset($this->savedPosts[$key]);
        }
    }
}