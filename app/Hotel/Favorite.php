<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;

class Favorite extends BaseService{

    public function getListByUser($userId){

        $parameters = [
            ':user_id' => $userId,
        ];

        return $this->fetchAll('SELECT favorite.*, room.name FROM favorite 
        INNER JOIN room ON favorite.room_id = room.room_id
        WHERE user_id = :user_id', $parameters);
        
    }

    public function isFavorite($roomId, $userId){
        $parameters = [
            ':room_id' => $roomId,
            ':user_id' => $userId,
        ];

        $favorite = $this->fetch('SELECT * FROM favorite WHERE room_id = :room_id AND user_id = :user_id', $parameters);
        
        return !empty($favorite);
    }

    public function addFavorite($userId, $roomId){

        $parameters = [
            ':user_id' => $userId,
            ':room_id' => $roomId,
        ];

        return $this->execute('INSERT IGNORE INTO favorite (user_id, room_id) VALUES (:user_id, :room_id)', $parameters);
        
    }

    public function removeFavorite($userId, $roomId){

        $parameters = [
            ':room_id' => $roomId,
            ':user_id' => $userId,
        ];

        $rows = $this->execute('DELETE FROM favorite WHERE room_id = :room_id AND user_id = :user_id', $parameters);
        
        return $rows == 1;
        
    }

}