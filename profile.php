<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body class="profile">
    <div class="container">
        <?php
ob_start(); 
session_start();
if(!empty($_SESSION['f_name'])){
echo "Your Profile:" . "<br>". "<br>";
?>
        <img style="width: 30%;
                border-radius: 50% ;" src="img/<?php echo  $_SESSION['image']?>" alt="image"><br><br>
        <?php
echo$_SESSION['f_name']." " ;
echo $_SESSION['l_name'] . " <br>";
    echo $_SESSION['email'] . "<br>";
    echo $_SESSION['phone'] . "<br>";
    }else{
    header("Location:login.php");
    }
    ?>
        <br>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>


<?php


ob_end_flush();
?>