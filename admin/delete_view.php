<?php
    if(isset($_GET['delete_view'])){
        $id = $_GET['delete_view'];
        $queryCheck = "SELECT COUNT(*) AS num FROM room r INNER JOIN view v ON r.id_view=v.id
                        WHERE v.id= :id";
        $prepareCheck = $conn->prepare($queryCheck);
        $prepareCheck->bindParam(":id", $id);
        $prepareCheck->execute();
        $number = $prepareCheck->fetch();
        if( $number->num == 0 ){
            $query = "DELETE FROM view WHERE id = :id";
            $prepare = $conn->prepare($query);
            $prepare->bindParam(":id", $id);
                try{
                $result = $prepare->execute();
                echo "<script>alert('Room view has been deleted sucessfully')</script>";
                echo "<script>window.open('index.php?view_views','_self')</script>";
                }catch(PDOException $ex){
                    echo "<script>alert('If you want to delete this type you first need to delete the rooms that corespond to this type')</script>";
                }
        }else{
            echo "<script>alert('If you want to delete this type you first need to delete the rooms that corespond to this type')</script>";
            echo "<script>window.open('index.php?view_rooms','_self')</script>";
        }
    }
?>