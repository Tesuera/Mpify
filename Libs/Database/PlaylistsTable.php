<?php

namespace Libs\Database;

use PDOException;

class PlaylistsTable {
    private $db;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function createPlaylists ($data) {
        try {
            $statement = $this->db->prepare("INSERT INTO playlists (playlist_name, playlist_cover, user_id) VALUES (:playlist_name , :playlist_cover, :user_id)");
            $statement->execute($data);
            $result = $this->db->lastInsertId();
            return $result;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function getPlaylists () {
        try {
            $result = $this->db->query("SELECT * FROM playlists WHERE user_id = {$_SESSION['auth']['id']} ORDER BY created_at DESC");
            $rows = $result->fetchAll();
            return $rows;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function getPlaylistInfo ($playlist_id) {
        try {
            $statement = $this->db->prepare("SELECT * FROM playlists WHERE id = $playlist_id AND user_id ={$_SESSION['auth']['id']}");
            $statement->execute();
            $row = $statement->fetch();
            return $row;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function getPlaylistFromMusicId ($music_id) {
        try {
            $statement = $this->db->prepare("SELECT playlist_id FROM add_playlist WHERE music_id = $music_id");
            $statement->execute();
            $rows = $statement->fetchAll();
            return $rows;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }
}