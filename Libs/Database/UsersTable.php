<?php

namespace Libs\Database;

use PDOException;

class UsersTable {
    private $db;

    public function __construct (MySQL $db) {
        $this->db = $db->connect();
    }

    public function register ($data) {
        try {
            $statement = $this->db->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
            $statement->execute($data);
            
            $result = $this->db->lastInsertId();
            return $result;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function registerWithGoogle ($data) {
        try {
            $statement = $this->db->prepare('INSERT INTO users (name, email, google_id, role) VALUES (:name, :email, :google_id, :role)');   
            $statement->execute($data);
            $row = $this->db->lastInsertId();

            return $row;
        } catch(PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function checkEmailExists ($email) {
        try {
            $statement = $this->db->prepare("SELECT * FROM users WHERE email = '$email'");
            $statement->execute();
            $user = $statement->rowCount();
            if($user) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function login ($username_or_email, $password) {
        try {
            $statement = $this->db->prepare("SELECT * FROM users WHERE email = '$username_or_email' OR name= '$username_or_email'");
            $statement->execute();
            $user = $statement->fetch();
            if(isset($user->name)) {
                if(password_verify($password, $user->password)) {
                    return $user;
                } else {
                    return [];
                }
            } else {
                return [];
            }
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function loginWithGoogle ($email, $google_id) {
        try {
            $statement = $this->db->prepare("SELECT * FROM users WHERE email = '$email'");
            $statement->execute();
            $user = $statement->fetch();
            if(isset($user->name)) {
                if($user->google_id === $google_id) {
                    return $user;
                } else {
                    return [];
                }
            } else {
                return [];
            }

        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function validateEmail ($email) {
        try {
           session_start();
           if($email !== $_SESSION['auth']['email']) {
                $statement = $this->db->prepare("SELECT * FROM users WHERE email = '$email'");
                $statement->execute();
                $user = $statement->rowCount();
            if($user) {
                return true;
            } else {
                return false;
            }
           } else {
               false;
           }
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function changeProfile ($data) {
        try {
           if($data['name'] === $_SESSION['auth']['name'] && $data['email'] === $_SESSION['auth']['email']){
            return 1;
           } else {
            $statement = $this->db->prepare("UPDATE users SET name = :name, email= :email WHERE id = {$_SESSION['auth']['id']}");
            $statement->execute($data);
            $result = $statement->rowCount();
            return $result;
           }
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }
}