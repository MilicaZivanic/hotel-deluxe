<?php
    if(isset($_GET['delete_room'])){
        $id = $_GET['delete_room'];
        $query = "DELETE FROM room WHERE id = :id";
        $query1 = "DELETE FROM price WHERE id_room = :id";
        $prepare1 = $conn->prepare($query1);
        $prepare1->bindParam(":id", $id);
        $prepare1->execute();
        $query2 = "DELETE FROM room_images WHERE id_room = :id";
        $prepare2 = $conn->prepare($query2);
        $prepare2->bindParam(":id", $id);
        $prepare2->execute();
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id", $id);
        try{
        $result = $prepare->execute();
        echo "<script>alert('Room has been deleted sucessfully')</script>";
        echo "<script>window.open('index.php?view_rooms','_self')</script>";
        }catch(PDOException $ex){
            //
        }

    }
?>