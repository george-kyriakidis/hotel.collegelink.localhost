<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;
use DateTime;

class Room extends BaseService{

    public function getRoom($roomId) {
        
        $parameters = [
            ':room_id' => $roomId,
        ];

        return $this->fetch('SELECT room.*,  room_type.title as room_type
                            FROM room 
                            INNER JOIN room_type ON room.type_id = room_type.type_id
                            WHERE room_id = :room_id', $parameters);
    }

    public function getCities(){

        //Get all cities
        $cities = [];
        $rows = $this->fetchAll('SELECT DISTINCT city FROM room');
        foreach ($rows as $row) {
            $cities[] = $row['city'];
        }

        return $cities;
    }

    public function getCountOfguests(){

        //Get all cities
        $guests = [];
        $rows = $this->fetchAll('SELECT DISTINCT count_of_guests FROM room');
        foreach ($rows as $row) {
            $guests[] = $row['count_of_guests'];
        }

        return $guests;
    }

    public function searchRoom($checkInDate, $checkOutDate, $city='', $typeId='', $countOfGuests='', $minAmount='', $maxAmount=''){

        //Setup parameters
        $parameters = [
            ':check_in_date' => $checkInDate->format(DateTime::ATOM),
            ':check_out_date' => $checkOutDate->format(DateTime::ATOM),
        ];

        if (!empty($city)) {
            $parameters[':city'] = $city;
        }

        if (!empty($typeId)) {
            $parameters[':type_id'] = $typeId;
        }

        if (!empty($countOfGuests)) {
            $parameters[':guests'] = $countOfGuests;
        }

        if (!empty($minAmount)) {
            $parameters[':minAmount'] = $minAmount;
        }

        if (!empty($maxAmount)) {
            $parameters[':maxAmount'] = $maxAmount;
        }

        $sql = 'SELECT room.*, room_type.title as room_type FROM room INNER JOIN room_type ON room.type_id = room_type.type_id WHERE  ';
        if (!empty($city)) {
            $sql .= 'city = :city AND ';
        }
        if (!empty($typeId)) {
            $sql .= 'room.type_id = :type_id AND ';
        }

        if (!empty($countOfGuests)) {
            $sql .= 'count_of_guests = :guests AND ';
        }

        if (!empty($minAmount)) {
            $sql .= 'price >= :minAmount AND ';
        }

        if (!empty($maxAmount)) {
            $sql .= 'price <= :maxAmount AND ';
        }

        $sql .= 'room_id NOT IN (
            SELECT room_id FROM booking
            WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date)'; 
        
        //Get results
        return $this->fetchAll($sql, $parameters);

    }

}