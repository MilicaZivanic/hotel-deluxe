<?php
    if(isset($_GET['delete_image'])){
        $id = $_GET['delete_image'];
        $query = "DELETE FROM room_images WHERE id = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id", $id);
        try{
        $result = $prepare->execute();
        echo "<script>alert('Image has been deleted sucessfully')</script>";
        echo "<script>window.open('index.php?view_images','_self')</script>";
        }catch(PDOException $ex){
            //
        }

    }
?>