<?php 
ob_start();
session_start();
require_once "connect_db.php";
// include "functions.php";
if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["f_name"]) && !empty($_POST["s_name"]) && !empty($_POST["email"]) && !empty($_POST["phone"])){
    $first_name = filter_var($_POST["f_name"],FILTER_SANITIZE_STRING);
    $second_name = filter_var($_POST["s_name"],FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST["phone"],FILTER_SANITIZE_NUMBER_INT);
    

    $image = $_FILES["image"]["name"];
    $size = $_FILES["image"]["size"];
    $tmp_name = $_FILES["image"]["tmp_name"];
    $type = $_FILES["image"]["type"];



    $extention_allowed = array("png","jpg","jpeg");
    
    
    @$extention = strtolower(end(explode(".",$image)));
    if(in_array($extention,$extention_allowed)){
        $avatar = rand(0,1000000) . "_" . $image ;
        $destination = "img/" . $avatar ;
        move_uploaded_file($tmp_name,$destination);
    }else{
        echo "<div class=\"container\"><div class=\"alert alert-danger\" role=\"alert\">
                Sorry Extention Not Allowed
                </div></div>";
    }
    
    
    $_SESSION["f_name"] = $first_name;
    $_SESSION["l_name"] = $second_name;
    $_SESSION["email"] = $email;
    $_SESSION["phone"] = $phone;
    $_SESSION["image"] = $avatar;

    global $con;
    $stmt = $con->prepare("INSERT INTO `department` ( `first_name`, `last_name`, `email`, `phone`, `img_name`) VALUES ('$first_name', '$second_name', '$email', '$phone', '$avatar')");
    $stmt->execute(array(
        ":user_f_name" => $first_name,
        ":user_l_name" => $second_name,
        ":user_email" => $email,
        ":user_phone" => $phone,
        ":user_img" => $avatar
    ));

    echo "ALL DONE";
    header("Refresh:2;url=profile.php");

    // header("Location:profile.php");


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <!-- start frist-form -->
    <div class="frist-form">
        <div class="container pt-5 pb-5">
            <form action="login.php" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-12 ">
                        <label>First Name</label>
                        <input type="text" placeholder="First Name" class="form-control" name="f_name" />
                    </div>
                    <div class="form-group col-12 ">
                        <label>Second Name</label>
                        <input type="text" placeholder="Second Name" class="form-control" name="s_name" />
                    </div>
                    <div class="form-group col-12 ">
                        <label>Email</label>
                        <input type="email" placeholder="Email" class="form-control" name="email" />
                    </div>
                    <div class="form-group col-12">
                        <label>Phone</label>
                        <input type="number" placeholder="Phone" class="form-control" name="phone" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 ">
                        <label>Import Image</label><br />
                        <input type="file" name="image" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <!-- end frist-form -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
</body>

</html>


<?php 

ob_end_flush();