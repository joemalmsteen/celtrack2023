<?php

session_start(); 
include "dbconn.php";
if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);

    if (empty($email)) {
        header("Location: index.php?error=User Name is required");
        exit();
    }else if(empty($pass)){
        header("Location: index.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM participant WHERE email='$email' AND nric='$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['nric'] === $pass) {
                //echo "Logged in!";
                $_SESSION['email'] = $row['email'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['pid'] = $row['pid'];
                header("location: dashboard.php?pid=".$row['pid']);
                exit();
            }else{
                header("Location: index.php?error=Incorect User name or password");
                exit();
            }
        }else{
            header("Location: index.php?error=Incorect User name or password");
            exit();
        }
    }
}else{
    header("Location: index.php?=wadaheck");
    exit();
}
?>