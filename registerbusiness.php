<?php

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $pass = $fname = $lname = $address_line = $city = $state = $zip_code = $phone_number = $business_name = $occupation = $hourly_rate = "";
$fname_err = $lname_err = $email_err = $pass_err = $address_line_err = $city_err = $state_err = $zip_code_err = $phone_number_err = $business_name_err = $occupation_err = $hourly_rate_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim(isset($_POST["email"])))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT business_info_id FROM business_info WHERE email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim(isset($_POST["pass"])))){
        $pass_err = "Please enter a password.";     
    }else{
        $pass = trim($_POST["pass"]);
    }

    // Validate first name
    if(empty(trim(isset($_POST["first_name"])))){
        $fname_err = "Please enter a first name.";     
    }else{
        $fname = trim($_POST["first_name"]);
    }

    // Validate last name
    if(empty(trim(isset($_POST["last_name"])))){
        $lname_err = "Please enter a last name.";     
    }else{
        $lname = trim($_POST["last_name"]);
    }

    // Validate line
    if(empty(trim(isset($_POST["address_line"])))){
        $address_line_err = "Please enter an address line.";     
    }else{
        $address_line = trim($_POST["address_line"]);
    }

    // Validate city
    if(empty(trim(isset($_POST["city"])))){
        $city_err = "Please enter a city.";     
    }else{
        $city = trim($_POST["city"]);
    }

    // Validate state
    if(empty(trim(isset($_POST["state"])))){
        $state_err = "Please enter state Initials.";     
    }else{
        $state = trim($_POST["state"]);
    }

    // Validate zipe_code
    if(empty(trim(isset($_POST["zip_code"])))){
        $zip_code_err = "Please enter a zip code.";     
    }else{
        $zip_code = trim($_POST["zip_code"]);
    }

    // Validate phone number
    if(empty(trim(isset($_POST["phone_number"])))){
        $phone_number_err = "Please enter a phone number.";     
    }else{
        $phone_number = trim($_POST["phone_number"]);
    }

    // Validate business_name
    if(empty(trim(isset($_POST["business_name"])))){
        $business_name_err = "Please enter a name for your Business.";
    } else{
        // Prepare a select statement
        $sql = "SELECT business_name FROM business_info WHERE business_name = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_business_name);
            
            // Set parameters
            $param_business_name = trim($_POST["business_name"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $business_name_err = "This business name is already taken.";
                } else{
                    $business_name = trim($_POST["business_name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate occupation
    if(empty(trim(isset($_POST["occupation"])))){
        $occupation_err = "Please enter a occupation.";     
    }else{
        $occupation = trim($_POST["occupation"]);
    }

    // Validate hourly rate
    if(empty(trim(isset($_POST["hourly_rate"])))){
        $hourly_rate_err = "Please enter an hourly rate.";     
    }else{
        $hourly_rate = trim($_POST["hourly_rate"]);
    }

    
    
    // Check input errors before inserting in database
    if(empty($fname_err) && empty($lname_err) && empty($pass_err) && empty($email_err)
    && empty($address_line_err) && empty($city_err)  && empty($state_err) && empty($zip_code_err)
    && empty($phone_number_err) && empty($business_name_err) && empty($occupation_err) && empty($hourly_rate_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO business_info (first_name, last_name, email, pass, address_line, city, state, zip_code, phone_number, business_name, occupation, hourly_rate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_fname, $param_lname, $param_email, $param_pass, 
            $param_address_line, $param_city, $param_state, $param_zip_code, $param_phone_number, 
            $param_business_name, $param_occupation, $param_hourly_rate);
            
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
            $param_business_name = $business_name;
            $param_occupation = $occupation;
            $param_hourly_rate = $hourly_rate;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page

                session_start();

                header("location: businesssignin.php");
                
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
    
        <h1>Business Register Form</h1>
        <P> Please fill in the form to create your Business account</P>  

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        
        <div class="form-group">
            <label for = "first_name"> <b>First Name: </b></label><br>
            <input type="text" placeholder="First Name" name = "first_name" id = "first_name" class = "form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>">
                <span class = "invalid-feedback"><?php echo $fname_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "last_name"> <b>Last Name: </b></label><br>
            <input type="text" placeholder="Last Name" name = "last_name" id = "last_name" class = "form-control <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>">
                <span class = "invalid-feedback"><?php echo $lname_err; ?></span>
        </div>

        <div class="form-group">
            <label for ="email" ><b>Email: </b></label><br>
            <input type="text" placeholder="Email" name = "email" id="email" class = "form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class = "invalid-feedback"><?php echo $email_err; ?></span>
        </div>

        <div class="form-group">
            <label for="pass" ><b>Password: </b></label><br>
            <input type="text" placeholder="Password" name = "pass" id="pass" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pass; ?>">
            <span class="invalid-feedback"><?php echo $pass_err; ?></span>
        </div>

        
        <div class="form-group">
            <label for = "address_line"> <b>Address Line: </b></label><br>
            <input type="text" placeholder="Address Line" name = "address_line" id = "address_line" class = "form-control <?php echo (!empty($address_line_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address_line; ?>">
                <span class = "invalid-feedback"><?php echo $address_line_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "city"> <b>City: </b></label><br>
            <input type="text" placeholder="City" name = "city" id = "city" class = "form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>">
                <span class = "invalid-feedback"><?php echo $city_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "state"> <b>State Initials: </b></label><br>
            <input type="text" placeholder="State" name = "state" id = "state" class = "form-control <?php echo (!empty($state_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $state; ?>">
                <span class = "invalid-feedback"><?php echo $state_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "zip_code"> <b>Zip Code: </b></label><br>
            <input type="text" placeholder="Zip Code" name = "zip_code" id = "zip_code" class = "form-control <?php echo (!empty($zip_code_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $zip_code; ?>">
                <span class = "invalid-feedback"><?php echo $zip_code_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "phone_number"><b>Phone Number: </b></label><br>
            <input type="text" placeholder="Phone Number" name = "phone_number" id = "phone_number" class = "form-control <?php echo (!empty($phone_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone_number; ?>">
                <span class = "invalid-feedback"><?php echo $phone_number_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "business_name"> <b>Business Name: </b></label><br>
            <input type="text" placeholder="Business Name" name = "business_name" id = "business_name" class = "form-control <?php echo (!empty($business_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $business_name; ?>">
                <span class = "invalid-feedback"><?php echo $zip_code_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "occupation"><b>Occupation: </b></label><br>
            <input type="text" placeholder="Occupation" name = "occupation" id = "occupation" class = "form-control <?php echo (!empty($occupation_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $occupation; ?>">
                <span class = "invalid-feedback"><?php echo $occupation_err; ?></span>
        </div>

        <div class="form-group">
            <label for = "hourly_rate"><b>Hourly Rate: </b></label><br>
            <input type="text" placeholder="Hourly Rate" name = "hourly_rate" id = "hourly_rate" class = "form-control <?php echo (!empty($hourly_rate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $hourly_rate; ?>">
                <span class = "invalid-feedback"><?php echo $hourly_rate_err; ?></span>
        </div>

        <div class = "form-group">
            <input type="submit" name="Submit" id = "Submit" value = "Register"><br>
        </div>

         <p><a href="businesssignin.php">Already have and account?</a></p>
    </form>

    </center>


    </body>
    
</html>