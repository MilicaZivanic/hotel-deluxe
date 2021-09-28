<?php
    session_start();
    require_once "../config/connection.php";

    $idRoom = $_POST['id'];
    $user = $_SESSION["user"]->id;
    $numPeople = $_POST['numPeople'];
    $checkinString = $_POST['checkinString'];
    $checkoutString = $_POST['checkoutString'];

    $date = date("Y-m-d H:i:s");
    $checkIn = date("Y-m-d",strtotime($checkinString));
    $checkOut = date("Y-m-d",strtotime($checkoutString));

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
        $query = "SELECT DISTINCT r.* FROM room r
                  LEFT OUTER JOIN booking b ON b.id_room=r.id WHERE
                  r.id = :id
                  AND NOT EXISTS( SELECT 1 FROM booking b WHERE b.id_room=r.id AND
                    (      (:checkIn >= b.check_in AND :checkIn  <= b.check_out)
                         OR (:checkIn <= b.check_in AND :checkOut >= b.check_in) 
                    ))";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id", $idRoom);
        $prepare->bindParam(":checkIn", $checkIn);
        $prepare->bindParam(":checkOut", $checkOut);
        $prepare->execute();

        if($prepare->rowCount() == 1){
            $queryInsert = "INSERT INTO booking 
                            VALUES(null, :user, :room, :checkIn, :checkOut, :numPeople, :date)";
            $prepare = $conn->prepare($queryInsert);
            $prepare->bindParam(":user", $user);
            $prepare->bindParam(":room", $idRoom);
            $prepare->bindParam(":checkIn", $checkIn);
            $prepare->bindParam(":checkOut", $checkOut);
            $prepare->bindParam(":numPeople", $numPeople);
            $prepare->bindParam(":date", $date);
            $result = $prepare->execute();

            if($result){
                header("Content-type: application/json");
                die(json_encode(array("success" => "Uspesan insert", "error" => "Neuspesan insert" )));
            }
        }   
    }

