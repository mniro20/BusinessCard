<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Signin.php");
    exit;
}

require_once "config.php";




?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    
    .one {
        background-color: white;
        border-style: solid;
        border-color: black;
        font-size: 300%;
        font-family: "Comfortaa", "Courier New", monospace;
        
    }
    
    body{
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
    

    input[type=text]{
        width: 30%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    p.smallRight{
        text-align: right;
        font-size: 40%;
        font-family: "Comfortaa", "Courier New", monospace;
    }

</style>
<center>
<body>
    <h1 class = "one"> BusinessCard 
    <p class = "smallRight"><b>Hi, <a href="customeraccountpage.php"><?php echo htmlspecialchars($_SESSION["email_c"]);?></a> </p>
    <p class = "smallRight"><a href="logout.php">Logout</a></p></h1>
    <P>Here, you may update your information.<P>

    <?php 
    $email = $_SESSION['email_c'];

    if(isset($_POST['update'])){
        
        $fname = $_POST['first_name_c'];
        $lname = $_POST['last_name_c'];
        $pass = $_POST['pass_c'];
        $address_line = $_POST['address_line_c'];
        $city = $_POST['city_c'];
        $state = $_POST['state_c'];
        $zip_code = $_POST['zip_code_c'];
        $phone_number = $_POST['phone_number_c'];
    
        $sql = "UPDATE customer_info SET first_name_c = '".$fname."', last_name_c = '".$lname."', pass_c = '".$pass."',
         address_line_c = '".$address_line."', city_c = '".$city."', state_c = '".$state."', zip_code_c = '".$zip_code."',
          phone_number_c= '".$phone_number."' WHERE email_c = '".$email."'";
    
        $result = mysqli_query($conn, $sql);
    
        if($result){
            echo 'Information Updated';
        }else{
            echo 'Data Not Updated';
        }
        
        mysqli_close($conn);
    
    
    
    }

    ?>
    
    <form action = "customerupdateinfo.php" method = "post">
        

        <div class="form-group">
            <label for = "first_name_c"> <b>First Name: </b></label>
            <input type="text" placeholder="First Name" name = "first_name_c" id = "first_name_c" required>
        </div>

        <div class="form-group">
            <label for = "last_name_c"> <b>Last Name: </b></label>
            <input type="text" placeholder="Last Name" name = "last_name_c" id = "last_name_c" required>
        </div>

        
        <div class="form-group">
            <label for="pass_c" ><b>Password: </b></label>
            <input type="text" placeholder="Password" name = "pass_c" id="pass_c" required>
        </div>

        
        <div class="form-group">
            <label for = "address_line_c"> <b>Address Line: </b></label>
            <input type="text" placeholder="Address Line" name = "address_line_c" id = "address_line_c" required>
        </div>

        <div class="form-group">
            <label for = "city_c"> <b>City: </b></label>
            <input type="text" placeholder="City" name = "city_c" id = "city_c" required>
        </div>

        <div class="form-group">
            <label for = "state_c"> <b>State Initials: </b></label>
            <input type="text" placeholder="State" name = "state_c" id = "state_c" required>
        </div>

        <div class="form-group">
            <label for = "zip_code_c"> <b>Zip Code: </b></label>
            <input type="text" placeholder="Zip Code" name = "zip_code_c" id = "zip_code_c" required>
        </div>

        <div class="form-group">
            <label for = "phone_number_c"><b>Phone Number: </b></label>
            <input type="text" placeholder="Phone Number" name = "phone_number_c" id = "phone_number_c" required>
        </div>
        
        <div class="form-group">
            <input type="submit" name = "update" value="Update Information"/><br>
        </div>

    </form>


    <p><a href="customerhomepage.php">Go back to the homepage.</a></p>





</body>
</center>





</html>
