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
    <p class = "smallRight"><b>Hi, <a href="businessaccountpage.php"><?php echo htmlspecialchars($_SESSION["email"]);?></a> </p>
    <p class = "smallRight"><a href="logout.php">Logout</a></p></h1>
    <P>Here, you may update your information.<P>

    <?php 
    $email = $_SESSION['email'];

    if(isset($_POST['update'])){
        
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $pass = $_POST['pass'];
        $address_line = $_POST['address_line'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip_code = $_POST['zip_code'];
        $phone_number = $_POST['phone_number'];
        $business_name = $_POST['business_name'];
        $occupation = $_POST['occupation'];
        $hourly_rate = $_POST['hourly_rate'];
    
        $sql = "UPDATE business_info SET first_name = '".$fname."', last_name = '".$lname."', pass = '".$pass."',
         address_line = '".$address_line."', city = '".$city."', state = '".$state."', zip_code = '".$zip_code."',
          phone_number = '".$phone_number."', business_name = '".$business_name."', occupation = '".$occupation."',
          hourly_rate = '".$hourly_rate."' WHERE email = '".$email."'";
    
        $result = mysqli_query($conn, $sql);
    
        if($result){
            echo 'Information Updated';
        }else{
            echo 'Data Not Updated';
        }
        
        mysqli_close($conn);
    
    
    
    }
    ?>



    
    <form action = "businessupdateinfo.php" method = "post">
        

        <div class="form-group">
            <label for = "first_name"> <b>First Name: </b></label>
            <input type="text" placeholder="First Name" name = "first_name" id = "first_name" required>
        </div>

        <div class="form-group">
            <label for = "last_name"> <b>Last Name: </b></label>
            <input type="text" placeholder="Last Name" name = "last_name" id = "last_name" required>
        </div>

        
        <div class="form-group">
            <label for="pass" ><b>Password: </b></label>
            <input type="text" placeholder="Password" name = "pass" id="pass" required>
        </div>

        
        <div class="form-group">
            <label for = "address_line"> <b>Address Line: </b></label>
            <input type="text" placeholder="Address Line" name = "address_line" id = "address_line" required>
        </div>

        <div class="form-group">
            <label for = "city"> <b>City: </b></label>
            <input type="text" placeholder="City" name = "city" id = "city" required>
        </div>

        <div class="form-group">
            <label for = "state"> <b>State Initials: </b></label>
            <input type="text" placeholder="State" name = "state" id = "state" required>
        </div>

        <div class="form-group">
            <label for = "zip_code"> <b>Zip Code: </b></label>
            <input type="text" placeholder="Zip Code" name = "zip_code" id = "zip_code" required>
        </div>

        <div class="form-group">
            <label for = "phone_number"><b>Phone Number: </b></label>
            <input type="text" placeholder="Phone Number" name = "phone_number" id = "phone_number" required>
        </div>

        <div class="form-group">
            <label for = "business_name"> <b>Business Name: </b></label>
            <input type="text" placeholder="Business Name" name = "business_name" id = "business_name" required>
        </div>

        <div class="form-group">
            <label for = "occupation"> <b>Occupation: </b></label>
            <input type="text" placeholder="Occupation" name = "occupation" id = "occupation" required>
        </div>

        <div class="form-group">
            <label for = "hourly_rate"><b>Hourly Rate: </b></label>
            <input type="text" placeholder="Hourly Rate" name = "hourly_rate" id = "hourly_rate" required>
        </div>
        
        <div class="form-group">
            <input type="submit" name = "update" value="Update Information"/><br>
        </div>

    </form>


    <p><a href="businesshomepage.php">Go back to the homepage.</a></p>





</body>
</center>





</html>
