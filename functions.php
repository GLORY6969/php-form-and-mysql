<?php   
function add_member($first_name,$second_name,$email,$phone,$avatar){
    global $con;
    $stmt = $con->prepare("INSERT INTO department(first_name,last_name,email,phone,img_name) Value(:user_f_name,:user_l_name,:user_email,:user_phone,:user_img)");
    $stmt->execute(array(
        ":user_f_name" => $first_name,
        ":user_l_name" => $second_name,
        ":user_email" => $email,
        ":user_phone" => $phone,
        ":user_img" => $avatar
    ));

    echo "ALL DONE";
    header("Refresh:.1;url=profile.php");
}

// function all_members($id){
//     global $con;
//     $stmt = $con->prepare("SELECT * FROM members WHERE id=?");
//     $stmt->execute(array($id));
//     $rows = $stmt->fetchAll();
//     return $rows;
// }