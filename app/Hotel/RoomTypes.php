<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;
use DateTime;

class RoomTypes extends BaseService{

    public function getRoomTypes(){

        //Get all Room Types
        return $this->fetchAll('SELECT * FROM room_type');

    }

}