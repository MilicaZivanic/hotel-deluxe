<?php
    if(isset($_GET['delete_price'])){
        $id = $_GET['delete_price'];
        $query = "DELETE FROM price WHERE id = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id", $id);
            try{
            $result = $prepare->execute();
            echo "<script>alert('Price has been deleted sucessfully')</script>";
            echo "<script>window.open('index.php?view_prices','_self')</script>";
            }catch(PDOException $ex){
                echo "<script>alert('If you want to delete this type you first need to delete the rooms that corespond to this type')</script>";
            }
    }
?>