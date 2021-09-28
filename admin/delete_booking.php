<?php
    if(isset($_GET['delete_booking'])){
        $id = $_GET['delete_booking'];
        $query = "DELETE FROM booking WHERE id = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id", $id);
            try{
            $result = $prepare->execute();
            echo "<script>alert('Booking has been deleted sucessfully')</script>";
            echo "<script>window.open('index.php?view_bookings','_self')</script>";
            }catch(PDOException $ex){
            echo "<script>alert('Booking has not been deleted sucessfully')</script>";
            }
    }
?>