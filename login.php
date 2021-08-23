<?php
session_start(); ob_clean();
include('lib/connect.inc.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="blue">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
        <!-- <?php echo checkEmail("silasjoy22@gmail.com")?> -->
        <form id="myForm" method="post">
            <h2>Login</h2>
            <?php if(isset($report)){
                echo Alert2();}
            ?>
            <div class="form-group">
                <div class="form-group">
                    <input required type="text" name="email" id="email" placeholder="Email" class="form-control">
                    <p style="color:red;" id="email_error"></p>
                    <input required type="password" autocomplete name="password" id="password" placeholder="Password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Minimum of 8 characters, at least 1 uppercase letter, 1 lowercase letter and 1 number">
                        <p style="color:red;" id="password_error"></p>
                    <!-- <p>Please enter your valid Email Address</p> -->
                </div>
                <input type="submit" name="userLogin" class="btn btn-primary btn-block submit-btn" value="SUBMIT" id="submit">
                <div class="clear"></div>
                <p class="paragraph">Don't have an account? <a href="signup.php">Signup</a></p>

            </div> 
            <div class="errors">

            </div>  
        </form>          
    </div>
    <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script>
    var email = document.querySelector("#email");
    var password = document.querySelector("#password");
    var submit = document.querySelector("#submit");


    
    const setError = (param, message) => {
        let input = document.getElementById(param+"_error");
        input.innerHTML = message;
    }

    const clearError = (param, message) => {
        let input = document.getElementById(param+"_error");
        input.innerHTML = "";
    }



    email.addEventListener('keyup', () => {
    //Getting Input
    let val = email.value;
    var search = val.search("@")

    if(search < 3) {
        submit.setAttribute('disabled', 'disabled');
        email.className = "form-control is-invalid";
        setError(email.id, "Enter a valid email")
    }
    else{
        submit.removeAttribute('disabled');
        email.className = "form-control is-valid";
        clearError(email.id)

        $.ajax({
        url : 'test.php?emailChecker='+val,
        method: 'GET'
        }).done((res) => {
            res = JSON.parse(res);
            console.log(res);

            if(res.success){
                submit.setAttribute('disabled', 'disabled');
                email.className = "form-control is-invalid";
                setError(email.id, "Email does not exist in our database");
            }
        })
    }


});


    password.addEventListener('keyup', () => {
    //Getting Input
    let val = password.value;
    console.log(val);

    if(val.length < 6) {
        submit.setAttribute('disabled', 'disabled');
        password.className = "form-control is-invalid";
        setError(password.id, "password is too short")
    }
    else{
        submit.removeAttribute('disabled');
        password.className = "form-control is-valid";
        clearError(password.id)
    }
});



    
    </script>
    
</body>

</html>