<?php
    if(isset($_GET['delete_type'])){
        $id = $_GET['delete_type'];
        $queryCheck = "SELECT COUNT(*) AS num FROM room r INNER JOIN room_type rt ON r.id_room_type=rt.id
                        WHERE rt.id= :id";
        $prepareCheck = $conn->prepare($queryCheck);
        $prepareCheck->bindParam(":id", $id);
        $prepareCheck->execute();
        $number = $prepareCheck->fetch();
        if( $number->num == 0 ){
            $query = "DELETE FROM room_type WHERE id = :id";
            $prepare = $conn->prepare($query);
            $prepare->bindParam(":id", $id);
                try{
                $result = $prepare->execute();
                echo "<script>alert('Room type has been deleted sucessfully')</script>";
                echo "<script>window.open('index.php?view_types','_self')</script>";
                }catch(PDOException $ex){
                    echo "<script>alert('If you want to delete this type you first need to delete the rooms that corespond to this type')</script>";
                }
        }else{
            echo "<script>alert('If you want to delete this type you first need to delete the rooms that corespond to this type')</script>";
            echo "<script>window.open('index.php?view_rooms','_self')</script>";
        }
    }
?>