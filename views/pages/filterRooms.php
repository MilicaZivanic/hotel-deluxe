<?php
    session_start();
    require_once "connection.php";
    
        $roomType = $_GET['roomType'];
        $numPeople = $_GET['numPeople'];
        $checkinString = $_GET['checkinString'];
        $checkoutString = $_GET['checkoutString'];

        $date = date("Y-m-d h-i-s");
        $checkIn = date("Y-m-d h-i-s",strtotime($checkinString));
        $checkOut = date("Y-m-d h-i-s",strtotime($checkoutString));
        

        $errors = [];

        if($checkIn < $date){
            $errors[] = "Date can't be in the past";
        }
        if($checkOut < $checkIn){
            $errors[] = "Leaving can't be before arrival!";
        }
        if(empty($checkIn)){
            $errors[] = "Date not selected";
        }
        if(empty($checkOut)){
            $errors[] = "Date not selected";
        }
        if(count($errors) > 0){
            http_response_code(500);
            echo json_encode($errors);
        }else{
            $query = "SELECT DISTINCT r.id AS idRoom, r.number, v.name AS view, r.size, r.num_people, r.num_beds, r.coverImage, p.price, rt.name, rt.id from room_type rt 
           		    INNER JOIN room r ON rt.id=r.id_room_type INNER JOIN view v ON v.id=r.id_view INNER JOIN price p ON r.id=p.id_room
            		LEFT OUTER JOIN booking b ON b.id_room=r.id 
            		WHERE rt.id = :roomType AND r.num_people >= :numPeople AND p.price = (SELECT MAX(price) FROM price WHERE id_room = r.id)
			        AND NOT EXISTS( SELECT 1 FROM booking b WHERE b.id_room=r.id AND
                    (      (:checkIn >= b.check_in AND :checkIn  <= b.check_out)
                         OR (:checkIn <= b.check_in AND :checkOut >= b.check_in) 
                    ))";
            $prepare = $conn->prepare($query);
            $prepare->bindParam(":roomType", $roomType);
            $prepare->bindParam(":numPeople", $numPeople);
            $prepare->bindParam(":checkIn", $checkIn);
            $prepare->bindParam(":checkOut", $checkOut);
            $result = $prepare->execute();

            if($result){
                $rooms = $prepare->fetchAll();
                echo json_encode($rooms);
                $_SESSION['checkIn'] = $checkinString;
                $_SESSION['checkOut'] = $checkoutString;
                $_SESSION['numPeople'] = $numPeople;
            }

        }

