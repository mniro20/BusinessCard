<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: customerhomepage.php");
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
    <p class = "smallRight"><b>Hi, <a href="customeraccountpage.php"> <?php echo htmlspecialchars($_SESSION["email_c"]);?> </p>
    <p class = "smallRight"><a href="logout.php">Logout</a></p>
    <p> View Appointments</p></h1>
    <P>Here are your current appointments.<P>
    

    <?php
    
// fetch data from database
    $email = $_SESSION['email_c'];
    
    $sql = "SELECT *
    FROM customer_info 
    NATURAL JOIN appointments
    NATURAL JOIN business_info
    WHERE appointments.business_info_id = business_info.business_info_id 
            AND customer_info.customer_info_id = appointments.customer_info_id
            AND email_c = '".$email."'";

    $results = mysqli_query($conn, $sql);

    if (mysqli_num_rows($results) > 0){
        while ($row = mysqli_fetch_array($results)){
            $apt_id = $row['appointment_id'];
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $businessEmail = $row['email'];
            $businessName = $row['business_name'];
            $phone_numebr = $row['phone_number'];
            $date = $row['date'];
            $time = $row['time'];
            $description = $row['description'];

            // echo appointmet infomation
            echo "<p class = 'echo'>
            Appointment ID: ".$apt_id.
            "<br> Name: ".$fname." ".$lname.
            ".<br> Email: ".$businessEmail.
            ".<br> Business_name: ".$businessName.
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

    


    <p><a href="customerhomepage.php">Go back to the homepage.</a></p>
    <p><a href="logout.php">Logout</a></p>





</body>





</html>
