<?php

if(isset($_GET['emailChecker'])){
    $email = $_GET['emailChecker'];
    if(checkEmail($email) == 0){
        $sql = $db->query("SELECT * FROM users WHERE email = '$email' ") or die('cannot connect');
        $data = [
            "message" => "email already exist",
            "success" => FALSE,
            "data" => $sql->fetch_object()
        ];
    }
    else{
        $data = [
            "message" => "email does not exist",
            "success" => TRUE,
            ];
        }
    
    echo json_encode($data);
}




if(array_key_exists('editInfo', $_POST)) {
    $user = $_SESSION['user_id'];
    $surname = valEmpty($_POST['surname'], 'surname', 3);
    $othernames = valEmpty($_POST['othernames'], 'othernames', 3);
    $phone = valEmpty($_POST['phone'], 'phone', 11);
    $address = valEmpty($_POST['address'], '$address', 3);
    $city = valEmpty($_POST['city'], '$city', 4);


    $sql = $db->query("UPDATE users SET surname='$surname', othernames='$othernames', phone='$phone', address='$address', city='$city' WHERE sn='$user' ") or die('cannot connect');
    $report = 'profile has been updated';

}


if(array_key_exists('editPhoto', $_POST)) {
    // print_r($_POST);
    $user = $_SESSION['user_id'];
    //let us first unlink/delete the user last image

    //getting the current profile picture with the getUser function
    $photo = getUser($user, 'photo');
    //let us check if the image file is empty
    if($photo == ''){
        /**
         * if the image field is empty, it will not do anything
         * it will proceed with the process
        **/
    }
    else{
        //goes to your image folder to delete the profile picture before uploading another one
        //just specify the image url
        unlink('img/'.$photo);
        //now image has been deleted
    }


    //getting the image name coming from the form
    $img = strtolower(explode('.', $_FILES['mypicture']['name'])[1]);

    if(!$img == 'jpg' or $img == 'png' or $img == 'jpeg') {
        $report = 'you cannot upload a '. $img .' image'; $count;
    }
    else{
        //creating another name form coming from the form
        //you can see it is carrying the user id concatenated with the current time
        $newname = $user.time().'.'.$img;
        //now i am uploading the image to my image directory .... now it has a new name and has been linked to the user whi uploaded it
        move_uploaded_file($_FILES['mypicture']['tmp_name'], 'img/'.$newname);
        //now let us link the image to the current user
        $sql = $db->query("UPDATE users SET photo='$newname' WHERE sn='$user' ") or die('cannot connect');
        $report = 'image has been uploaded';
    }

}



if (array_key_exists('userLogout', $_POST)) {
    session_destroy();
    //unset($_SESSION['user_id']);
    header('location: login.php');
}


if (array_key_exists('userLogin', $_POST)){
    //print_r($_POST);
    $email = valEmpty($_POST['email'], 'email', 3 );
    $password = valEmpty($_POST['password'], 'password', 3 );

    $users = $db->query("SELECT * FROM users WHERE email='$email' ") or die('Cannot Select');
    $num = mysqli_num_rows($users);
    if($num > 0) {
        //check password
        $row = mysqli_fetch_array($users);
        if(password_verify($password, $row['pass'])){
            //create login session
            $_SESSION['user_id'] = $row['sn'];
            $report = 'YOU ARE THERE';
            header('location: index.php');
        }
        else{
            $report = 'incorrect password'; $count = 1;
        }
    }
    else{
        $report = 'This email does not exist'; $count = 1;
    }
}



//register user from signup.php
if (array_key_exists('registerUser', $_POST)) {
    // print_r($_POST);
    $surname = valEmpty($_POST['surname'], 'Surname', 3 );
    $othernames = valEmpty($_POST['othernames'], 'othernames', 3 );
    $email = valEmpty($_POST['email'], 'email', 3 );
    $password = valEmpty($_POST['password'], 'password', 3 );
    $confirm = $_POST['confirm'];
    $phone = valEmpty($_POST['phone'], 'Phone Number', 11 );
    $gender = valEmpty($_POST['gender'], 'gender', 4 );
    $address = valEmpty($_POST['address'], 'address', 2 );
    $city = valEmpty($_POST['city'], 'city', 3 );
    $state = valEmpty($_POST['State'], 'state', 3 );
    $country = valEmpty($_POST['country'], 'country', 3 );


    if(checkEmail($email) == 0){
        $report = "Email already taken"; $count = 1;
    }

    //time
    $ctime = time();


    if(!isset($count)) {
        //comparing password
        if($password == $confirm){
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $sql = $db->query("INSERT INTO users(surname, othernames, phone, email, pass, gender, city, state, country, address, ctime)
                VALUES('$surname', '$othernames', '$phone', '$email', '$pass', '$gender', '$city', '$state', '$country', '$address', '$ctime' ) ") or die('cannot connect');
            $report = 'User information has been saved';
        }
        else{
            $report = 'Password does not match';
        }
            
    }
}


?>