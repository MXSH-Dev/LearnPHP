<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email=:email");
        $this->db->bind(':email', $email);

        $row = $this->db->fetchSingleResult();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM users WHERE id=:id");
        $this->db->bind(':id', $id);

        $row = $this->db->fetchSingleResult();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function register($userData)
    {
        $this->db->query('INSERT INTO users (name,email,password) VALUES (:name,:email,:password)');
        $this->db->bind(':name', $userData['name']);
        $this->db->bind(':email',  $userData['email']);
        $this->db->bind(':password',  $userData['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email',  $email);

        $row = $this->db->fetchSingleResult();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }
}
