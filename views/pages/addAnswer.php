<?php
    session_start();
    require_once "connection.php";


    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
        $id = $user->id;
    }
    $answer = $_GET['answer'];
    $errors = [];

    if(empty($answer)){
        $errors[] = 1;
    }

    if(count($errors) > 0){
        http_response_code(404);   
    }else{
        $queryInsert = "INSERT INTO vote
                    VALUES(null, :answer, :user )";
        $prepare = $conn->prepare($queryInsert);
        $prepare->bindParam(":answer", $answer);
        $prepare->bindParam(":user", $id);
        $result = $prepare->execute();
        if($result){
            header("Content-type: application/json");
            die(json_encode(array("success" => "Uspesan insert", "error" => "Neuspesan insert" )));
        }
    }
?>
