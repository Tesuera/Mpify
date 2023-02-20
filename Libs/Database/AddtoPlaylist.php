<?php

namespace Libs\Database;

use PDOException;

class AddtoPlaylist {
    private $db;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function insertToPlaylist ($datastring) {
        try {
            $statement= $this->db->prepare("INSERT INTO add_playlist (music_id, playlist_id) VALUES $datastring");
            $statement->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $err){
            echo $err->getMessage();
            exit();
        }
    }

    public function songsCount ($playlist_id) {
        try {
            $statement = $this->db->prepare("SELECT COUNT(id) AS songs FROM add_playlist WHERE playlist_id = $playlist_id");
            $statement->execute();
            $result = $statement->fetch();
            return $result->songs;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function getSongsbyPlaylistId ($playlist_id) {
        try {
            $statement = $this->db->prepare("SELECT * FROM musics WHERE id IN (SELECT music_id FROM add_playlist WHERE playlist_id = $playlist_id)");
            $statement->execute();
            $rows = $statement->fetchAll();
            return $rows;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function getSongsIdByplaylist ($playlist_id) {
        try {
            $statement = $this->db->prepare("SELECT id FROM musics WHERE id IN (SELECT music_id FROM add_playlist WHERE playlist_id = $playlist_id)");
            $statement->execute();
            $rows = $statement->fetchAll();
            return $rows;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function deleteAllSongsFromSpecificPlaylist ($playlist_id) {
        try {
            $statement = $this->db->prepare("DELETE FROM add_playlist WHERE playlist_id = $playlist_id");
            $statement->execute();
            return 1;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }

    public function deletePlaylistDatabyMusicId ($music_id) {
        try {
            $statement = $this->db->prepare("DELETE FROM add_playlist WHERE music_id = $music_id");
            $statement->execute();
            $rows = $statement->rowCount();
            return $rows;
        } catch (PDOException $err) {
            echo $err->getMessage();
            exit();
        }
    }
}