<?php
    session_start();
    require_once "../config/connection.php";
    if(isset($_POST["btnLogin"])){
        $email = $_POST["email"];
        $pass = md5($_POST["pass"]);

        $errors = [];

        $regexPass = "/^[A-Za-z0-9\.\-\_]{5,}$/";
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Email not in good format";
        }
        if(!preg_match($regexPass, $pass)){
            $errors[] = "Password not in good format";
        }

        if(count($errors) > 0){
            http_response_code(404);   
                header("Location: ../index.php?page=login");
        }else{
            $query = "SELECT * FROM user WHERE email = :email AND password = :password";

            $prepare = $conn->prepare($query);
            $prepare->bindParam(":email", $email);
            $prepare->bindParam(":password", $pass);
            $prepare->execute();

            if($prepare->rowCount() == 1){
                $user = $prepare->fetch();
                $_SESSION["user"] = $user;
                if(isset($_SESSION['redirecturl'])){
                    header("Location: ../". $_SESSION['redirecturl']);
                unset($_SESSION['redirecturl']);
                }else{
                    header("Location: ../index.php");
                }
            }else{
                $_SESSION["errorLogin"] = "We couldn't find a user with that email and password.";
                header("Location: ../index.php?page=login");
            }

        }
    }

?>
