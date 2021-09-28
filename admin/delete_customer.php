<?php
    if(isset($_GET['delete_customer'])){
        $id = $_GET['delete_customer'];
        $query = "DELETE FROM user WHERE id = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id", $id);
            try{
            $result = $prepare->execute();
            echo "<script>alert('Customer has been deleted sucessfully')</script>";
            echo "<script>window.open('index.php?view_customers','_self')</script>";
            }catch(PDOException $ex){
            echo "<script>alert('Customer has not been deleted sucessfully')</script>";
            }
    }
?>