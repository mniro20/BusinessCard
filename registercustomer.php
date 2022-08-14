<?php

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $pass = $fname = $lname = $address_line = $city = $state = $zip_code = $phone_number = "";
$fname_err = $lname_err = $email_err = $pass_err = $address_line_err = $city_err = $state_err = $zip_code_err = $phone_number_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim(isset($_POST["email_c"])))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT customer_info_id FROM customer_info WHERE email_c = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email_c"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email_c"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim(isset($_POST["pass_c"])))){
        $pass_err = "Please enter a password.";     
    }else{
        $pass = trim($_POST["pass_c"]);
    }

    // Validate first name
    if(empty(trim(isset($_POST["first_name_c"])))){
        $fname_err = "Please enter a password.";     
    }else{
        $fname = trim($_POST["first_name_c"]);
    }

    // Validate last name
    if(empty(trim(isset($_POST["last_name_c"])))){
        $lname_err = "Please enter a last name.";     
    }else{
        $lname = trim($_POST["last_name_c"]);
    }

    // Validate address line
    if(empty(trim(isset($_POST["address_line_c"])))){
        $address_line_err = "Please enter a address line.";     
    }else{
        $address_line = trim($_POST["address_line_c"]);
    }

    // Validate city
    if(empty(trim(isset($_POST["city_c"])))){
        $city_err = "Please enter a city.";     
    }else{
        $city = trim($_POST["city_c"]);
    }

    // Validate state
    if(empty(trim(isset($_POST["state_c"])))){
        $state_err = "Please enter a state Initials.";     
    }else{
        $state = trim($_POST["state_c"]);
    }

    // Validate zip_code
    if(empty(trim(isset($_POST["zip_code_c"])))){
        $zip_code_err = "Please enter a zipecode.";     
    }else{
        $zip_code = trim($_POST["zip_code_c"]);
    }

    // Validate phone number
    if(empty(trim(isset($_POST["phone_number_c"])))){
        $phone_number_err = "Please enter a phone number.";     
    }else{
        $phone_number = trim($_POST["phone_number_c"]);
    }

    
    
    // Check input errors before inserting in database
    if(empty($fname_err) && empty($lname_err) && empty($pass_err) && empty($email_err)
    && empty($address_line_err) && empty($city_err)  && empty($state_err) && empty($zip_code_err)
    && empty($phone_number_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO customer_info 
        (first_name_c, last_name_c, email_c, pass_c, address_line_c, city_c, state_c, zip_code_c, phone_number_c)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_fname, $param_lname, $param_email, $param_pass,
             $param_address_line, $param_city, $param_state, $param_zip_code, $param_phone_number);
            
            // Set parameters
            $param_fname = $fname;
            $param_lname = $lname;
            $param_email = $email;
            $param_pass = $pass;
            $param_address_line = $address_line;
            $param_city = $city;
            $param_state =$state;
            $param_zip_code = $zip_code;
            $param_phone_number = $phone_number;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page

                session_start();

                header("location: customersignin.php");
                
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
        <meta charset = "UTF-8">
        <title>Register Page</title>
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
        

        <p>Get Started</p>
    
        <h1>Customer Register Form</h1>
        <P> Please fill in the form to create your Customer account</P>  

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        
        <div class="form-group">
            <label for = "first_name_c"> <b>First Name</b></label><br>
            <input type="text" placeholder="First Name" name = "first_name_c" id = "first_name_c" class = "form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>">
                <span class = "invalid-feedback"><?php echo $fname_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "last_name_c"> <b>Last Name</b></label><br>
            <input type="text" placeholder="Last Name" name = "last_name_c" id = "last_name_c" class = "form-control <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>">
                <span class = "invalid-feedback"><?php echo $lname_err; ?></span>
        </div>

        <div class="form-group">
            <label for ="email_c" ><b>Email</b></label><br>
            <input type="text" placeholder="Email" name = "email_c" id="email_c" class = "form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class = "invalid-feedback"><?php echo $email_err; ?></span>
        </div>

        <div class="form-group">
            <label for="pass_c" ><b>Password</b></label><br>
            <input type="text" placeholder="Password" name = "pass_c" id="pass_c" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pass; ?>">
            <span class="invalid-feedback"><?php echo $pass_err; ?></span>
        </div>

        
        <div class="form-group">
            <label for = "address_line_c"> <b>Address Line: </b></label><br>
            <input type="text" placeholder="Address Line" name = "address_line_c" id = "address_line_c" class = "form-control <?php echo (!empty($address_line_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address_line; ?>">
                <span class = "invalid-feedback"><?php echo $address_line_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "city_c"> <b>City: </b></label><br>
            <input type="text" placeholder="City" name = "city_c" id = "city_c" class = "form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>">
                <span class = "invalid-feedback"><?php echo $city_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "state_c"> <b>State Initials: </b></label><br>
            <input type="text" placeholder="State" name = "state_c" id = "state_c" class = "form-control <?php echo (!empty($state_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $state; ?>">
                <span class = "invalid-feedback"><?php echo $state_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "zip_code_c"> <b>Zip Code: </b></label><br>
            <input type="text" placeholder="Zip Code" name = "zip_code_c" id = "zip_code_c" class = "form-control <?php echo (!empty($zip_code_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $zip_code; ?>">
                <span class = "invalid-feedback"><?php echo $zip_code_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "phone_number_c"><b>Phone Number: </b></label><br>
            <input type="text" placeholder="Phone Number" name = "phone_number_c" id = "phone_number_c" class = "form-control <?php echo (!empty($phone_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone_number; ?>">
                <span class = "invalid-feedback"><?php echo $phone_number_err; ?></span>
        </div>
        
        
    
        

        <div class = "form-group">
        <input type="submit" name="Submit" id = "Submit" value = "Register"><br>
        </div>
    </form>
    <p><a href="customersignin.php">Already Have an Account?</a></p>

    

    </center>


    </body>
    
</html>