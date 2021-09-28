<?php
    session_start();
    require_once "../config/connection.php";
  if(isset($_SESSION["user"])){
    header("Location: ../index.php");
  }

  if(isset($_POST["btnRegister"])){
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $email = $_POST["email"];
    $pass = md5($_POST["pass"]);
    $passConfirm = md5($_POST["passConfirm"]);

    $errors = [];

    $regexNamelName = "/^[A-Z][a-z]{2,}(\s[A-Z][a-z]{2,})*$/";
    $regexPass = "/^[A-Za-z0-9\.\-\_]{5,}$/";
    
    if(!preg_match($regexNamelName, $fName)){
      $errors[] = "First name is not in good format";
    }
    if(!preg_match($regexNamelName, $lName)){
      $errors[] = "Last name is not in good format";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email not in good format";
    }
    if(!preg_match($regexPass, $pass)){
        $errors[] = "Password not in good format";
    }
    if($passConfirm != $pass){
      $errors[] = "Password and confirm password are not the same";
    }

    if(count($errors) > 0){
        http_response_code(404);   
        header("Location: ../index.php?page=register");
    }else{
        $query = "INSERT INTO user VALUES (NULL, :fname, :lname, :email, :password, :date, :id_role)";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":fname", $fName);
        $prepare->bindParam(":lname", $lName);
        $prepare->bindParam(":email", $email);
        $prepare->bindParam(":password", $pass);

        $date = date("Y-m-d H:i:s");
        $prepare->bindParam(":date", $date);

        define("USER_ROLE", 2);
        $roleId = USER_ROLE;
        $prepare->bindParam(":id_role", $roleId);

        try{
          $isInDatabase = $prepare->execute();
          $_SESSION['successRegister'] = "You have successfully registered. You can log in now.";
          header("Location: ../index.php?page=login");
        }
        catch(PDOException $ex){
          $_SESSION['errorRegister'] = "There is already a user with that email account";
          header("Location: ../index.php?page=register");
        }

    }
}
?>