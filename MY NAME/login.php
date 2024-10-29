<?php 
session_start();
session_unset();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css"> 
    <link rel="stylesheet" href="assets/css/all.min.css">   

    <title>National Election System Login</title>
</head>

<body>
    <div class="login-container">
        <form action="index.php"  method="post" onsubmit="return false" id="form">  
            <h1>LOGIN</h1>
            
            <div class="id-details-div">
                <input type="text" class="input-border-bottom" name="national-id-number" id="national-id" required autofocus>
                <label for="national-id">National ID number</label>
                <!-- <span class="i">🪪</span> -->
                <span class="i"><i class="fa fa-id-card"></i></span>
                

            </div>
            <div class="password-div">
                <input type="password" class="input-border-bottom" name="password" id="password" required>
                <label for="password">Password</label>
                <!-- <span class="i">🔐</span> -->
                <span class="i"><i class="fa fa-lock"></i></span>
                <!-- <i class="fa fa-eye"></i> -->
            </div>
            <div class="buttons">
                <input type="submit" class="submit-btn" value="SIGN IN">
                <button class="reset-btn" type="reset"><img src="img/refresh.png"></button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('form');
        form.addEventListener("submit", function(e){
            validateInput();
        });

        function validateInput(){
            let national_id = document.getElementById('national-id');
            let password = document.getElementById('password');

            if(national_id.value.trim() === '' || national_id.value.trim() === null){
                alert("PLEASE ENTER A VALID NATIONAL ID NUMBER.\n Example: 1A2B3C4D"); 
                document.getElementById('national_id').focus();           
            }                
            else if (password.value.length < 8){
                alert("PASSWORD SHOULD BE 8 CHARACTERS OR MORE");
                document.getElementById('password').focus();     
            }
            else{               
                form.submit();                
            }           
        } 

        /* Preventing form resubmission on page refresh*/
        if ( window.history.replaceState ) { // if the history api is available in the browser
            // replaces the previously submitted data with null data as specified in the method 
            window.history.replaceState( null, null, window.location.href );
        } 
    </script>
</body>

</html>

<?php
    //Connection to database
    $hostname = 'localhost';
    $user = 'root';
    $user_password = '';
    $database = 'syad_project_db';
    $conn = new mysqli($hostname, $user, $user_password, $database);
    
    if(!$conn){
        echo "Connection failed: ".$conn->connect_error;
    }else{       
        
        //Checking if the input data is present in the database
        if(isset($_POST['national-id-number']) && isset($_POST['password'])){
            $national_id = $_POST['national-id-number'];
            $password = $_POST['password'];

            $query = "SELECT * FROM login_credentials WHERE national_id = '$national_id' AND password = '$password'";
            $results = mysqli_query($conn, $query);

            if(mysqli_num_rows($results)==1){                               
                $_SESSION['login'] = true; // creating a login session to allow user to access the protected page
                $_SESSION['national_id'] = $national_id;
                header('location: Presidents.php'); // redirecting to the protected page                
            }
            else {
                echo "<script>
                        alert('⚠️ LOGIN FAILED.');                        
                    </script>";
            }
        }else{
            exit;
        }  
        
        // This is to log out the user when they click the log out button
        if(isset($_POST['logout'])){
            session_destroy();
            header('location: index.php');
        }
    }    
?>