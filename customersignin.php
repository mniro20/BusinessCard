<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: customerhomepage.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $pass = "";
$email_err = $pass_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim(isset($_POST["email_c"])))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email_c"]);
    }
    
    // Check if password is empty
    if(empty(trim(isset($_POST["pass_c"])))){
        $pass_err = "Please enter your password.";
    } else{
        $pass = trim($_POST["pass_c"]);
    }

    
    // Validate credentials
    if(empty($pass_err) && empty($email_err)){
        // Prepare a select statement
        $sql = "SELECT customer_info_id, email_c, pass_c FROM customer_info WHERE email_c = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $pass);
                    if(mysqli_stmt_fetch($stmt)){
                        
                        // Password is correct, so start a new session
                        session_start();
                            
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["user_id"] = $id;
                        $_SESSION["email_c"] = $email;
                        
                        // Redirect user to welcome page
                        header("location: customerhomepage.php");
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid email or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            .header {
                padding: 20px;
                text-align: center;
                background: white;
                color: black;
                font-size: 10px;
            }
            body.one{
                font-family: "Comfortaa", "Courier New", monospace;
                font-size: 100%;
                background-color: rgb(133, 180, 205);
                border: 1px solid ;
                box-sizing: border-box;

            }

            form{
                width: 40%;
                border: 3px solid black;
                background-color: lightgray;
            }

            input[type=text], input[text=password]{
                width: 30%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            
            
        </style>
    </head>
    

    <body> 
        <div class="header">
        <h1>Welcome to BusinessCard</h1>
        </div>
    </body>

    <body class="one">          

        <center>
        
    
        <h1>Customer Sign In Page</h1>
        <P> Please Enter Your  Email and Password</P>  

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <!--  form to insert data -->

        <div class="form-group">
            <label for = "email_c"> <b>Email</b></label><br>
            <input type="text" placeholder="Email Address" name = "email_c" id = "email_c" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "password_c"> <b>Password</b></label><br>
            <input type="text" placeholder="Password" name = "pass_c" id = "pass_c" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $pass_err; ?></span>
        </div>

        
        
        <input type="submit" name="Submit" id = "Submit" value = "Sign In"><br>
        
        

    </form>
    <p><a href="registercustomer.php">Sign up?</a></p>
    </center>


    </body>
    
</html>