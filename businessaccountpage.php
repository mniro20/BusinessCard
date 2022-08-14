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
    p.centertext{
        display: inline-block;
        
    }

</style>
<body>
    <h1 class = "one"> BusinessCard 
    <p class = "smallRight"><b>Hi, <?php echo htmlspecialchars($_SESSION["email"]);?> </p>
    <p class = "smallRight"><a href="logout.php">Logout</a></p>
    <p> View Profile</p></h1>
    <P>Here is your information saved.<P>
    

    <?php
    $conn = mysqli_connect("localhost", "root", "", "businesscarddb");

    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }
    
    $email = $_SESSION["email"];
    
    $sql = "SELECT * FROM business_info WHERE email = '".$email."'";
    
    $results = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($results) > 0){
        while ($row = mysqli_fetch_array($results)){
            echo "<br>";
            echo "<p class = 'echo'>Name: ".$row[1]." ".$row[2].
            ".<br> Email: ".$row[3].
            ".<br> Address: ".$row[5].", ".$row[6].", ".$row[7].", ".$row[8].
            ".<br> Phone Number: ".$row[9].
            ".<br> Business Name: ".$row[10].
            ".<br> Occupation: ".$row[11].
            ".<br> Hourly Rate: $". $row[12].".".'</p>';
            echo "<br>";
        }
    }else{
        echo "<p class = 'echo'>No Results found. Try refining your search. </p>";
    }
    
    mysqli_close($conn);
    
    ?>
    <center>
    <p class="centertext"><a href="businessupdateinfo.php">Update Information.</a></p>
    <p class="centertext"><a href="viewappointment.php">View Current Appointments.</a></p>
    <p class="centertext"><a href="businesshomepage.php">Go back to the homepage.</a></p>
</center>





</body>





</html>
