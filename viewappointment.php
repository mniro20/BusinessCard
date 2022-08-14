<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: businesssignin.php");
    exit;
}

require_once "config.php";

?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .header {
        padding: 20px;
        text-align: center;
        background: white;
        color: black;
        font-size: 10px;
    }

    .one {
        background-color: white;
        border-style: solid;
        border-color: black;
        font-size: 300%;
        font-family: "Comfortaa", "Courier New", monospace;
        text-align: center;
    }
    body{
        font-family: "Comfortaa", "Courier New", monospace;
        font-size: 100%;
        background-color: rgb(133, 180, 205);
        border: 1px solid ;
        box-sizing: border-box;

    }
    .echo{
            background-color: white;
            border-style: solid;
            width: 600px;
            border: 800px; 
            border-color: black;
            padding: 20px;
            margin: 15px;
            font-family: "Comfortaa", "Courier New", monospace;
            text-align: left; 
        }

    input[type=text], input[text=password]{
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
<body>
    <h1 class = "one"> BusinessCard 
    <p class = "smallRight"><b>Hi, <a href="businessaccountpage.php"> <?php echo htmlspecialchars($_SESSION["email"]);?> </p>
    <p class = "smallRight"><a href="logout.php">Logout</a></p>
    <p> View Appointments</p></h1>
    <P>Here are your current appointments.<P>
    

    <?php
    
    // fetch data from database
    $email = $_SESSION['email'];
    
    $sql = "SELECT *
    FROM customer_info 
    NATURAL JOIN appointments
    NATURAL JOIN business_info
    WHERE appointments.business_info_id = business_info.business_info_id 
            AND customer_info.customer_info_id = appointments.customer_info_id
            AND email = '".$email."'";

    $results = mysqli_query($conn, $sql);

    if (mysqli_num_rows($results) > 0){
        while ($row = mysqli_fetch_array($results)){
            $apt_id = $row['appointment_id'];
            $fname = $row['first_name_c'];
            $lname = $row['last_name_c'];
            $customerEmail = $row['email_c'];
            $address_line = $row['address_line_c'];
            $city = $row['city_c'];
            $state = $row['state_c'];
            $zip_code = $row['zip_code_c'];
            $phone_numebr = $row['phone_number_c'];
            $date = $row['date'];
            $time = $row['time'];
            $description = $row['description'];

            // echo appointmet infomation
            echo "<p class = 'echo'>
            Appointment ID: ".$apt_id.
            "<br> Name: ".$fname." ".$lname.
            ".<br> Email: ".$customerEmail.
            ".<br> Address: ".$address_line.", ".$city.", ".$state.", ".$zip_code.
            ".<br> Phone Number: ".$phone_numebr.
            ".<br> Date: ".$date.
            ".<br> Time: ".$time.
            ".<br> Job Description: ".$description.'.</p>';
            echo "<br>";
        }
    }else{
        echo "<p class = 'echo'>No appointments. </p>";
    }

    $sql2 = "DELETE FROM appointments WHERE business_info_id = 0 ";

    $results2 = mysqli_query($conn, $sql2);

    
    mysqli_close($conn);
    
    ?>

    


    <p><a href="businesshomepage.php">Go back to the homepage.</a></p>
    <p><a href="logout.php">Logout</a></p>





</body>





</html>
