<?php

namespace Libs\Database;

use PDOException;

class MusicsTable {
    private $db;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function addMusic ($data) {
        try {
            $statement = $this->db->prepare("INSERT INTO musics (title, cover, audio_url, artist, lyrics, user_id) VALUES (:title, :cover, :audio_url, :artist, :lyrics, :user_id)");
            $statement->execute($data);
            $result = $statement->rowCount();
            return $result;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function getAllSongs () {
        try {
            $statement = $this->db->prepare("SELECT * FROM musics WHERE user_id = {$_SESSION['auth']['id']} ORDER BY title");
            $statement->execute();
            $rows = $statement->fetchAll();
            return $rows;
        } catch(PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function getFavorite () {
        try {
            $statement= $this->db->prepare("SELECT * FROM musics WHERE favorite = 1 AND user_id = {$_SESSION['auth']['id']}");
            $statement->execute();
            $rows = $statement->fetchAll();
            return $rows;
        } catch(PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function removeFromFavorite ($music_id) {
        try {
            $statement = $this->db->prepare("UPDATE musics SET favorite= 0 WHERE id = $music_id AND user_id = {$_SESSION['auth']['id']}");
            $statement->execute();
            $count = $statement->rowCount();
            return $count;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function getSpecificMusic ($music_id) {
        try {
            $statement = $this->db->prepare("SELECT * FROM musics WHERE id = $music_id AND user_id = {$_SESSION['auth']['id']}");
            $statement->execute();
            $row = $statement->fetch();
            return $row;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function addToFavorites($music_id) {
        try {
            $statement = $this->db->prepare("UPDATE musics SET favorite = 1 WHERE id = $music_id AND user_id = {$_SESSION['auth']['id']}");
            $statement->execute();
            $count =$statement->rowCount();
            return $count;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function getMusicByArtistName ($artist_name) {
        try {
            $statement = $this->db->prepare("SELECT * FROM musics WHERE artist= '$artist_name' AND user_id = {$_SESSION['auth']['id']}");
            $statement->execute();
            $rows =$statement->fetchAll();
            return $rows;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function nowPlaying ($music_id) {
        try {
            // $statement = $this->db->prepare("UPDATE musics SET now_playing = 0");
            // $statement->execute();

            // $statement1 = $this->db->prepare("UPDATE musics SET now_playing = 1 WHERE id = $music_id");
            // $statement1->execute();

            $statement2 = $this->db->prepare("SELECT * FROM musics WHERE id = $music_id AND user_id = {$_SESSION['auth']['id']}");
            $statement2->execute();
            $result = $statement2->fetch();
            return $result;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        } 
    }
}