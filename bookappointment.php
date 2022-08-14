<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: customersignin.php");
    exit;
}


?>


<!DOCTYPE html>
<html>
<style>
    .one {
        background-color: white;
        border-style: solid;
        border-color: black;
        font-size: 300%;
        font-family: "Comfortaa", "Courier New", monospace;
        
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
    .divcss{
        background-color: white;
        width: 800px;
        border: 800px; 
        border-color: black;
        padding: 20px;
        margin: 15px;
        font-family: "Comfortaa", "Courier New", monospace;
        
    }

    p.smallRight{
        text-align: right;
        font-size: 40%;
        font-family: "Comfortaa", "Courier New", monospace;
    }

    form{
        width: 40%;
        border: 3px solid black;
        background-color: lightgray;
    }

    input{
        width: 30%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

</style>

<center>
    <body style = "background-color: rgb(133, 180, 205)"> 
        <h1 class = "one" > BusinessCard 
        <p class = "smallRight" ><b>Hi, <a href="customeraccountpage.php"> <?php echo htmlspecialchars($_SESSION["email_c"]); ?></a> </p>
        <p class = "smallRight"><a href="logout.php">Logout</a></p> </h1>
        

    <div class = "divcss">Please fill in the information below to confirm you appointment with your business of choice</div>

    <form action="bookappointment.php" method="post">
        
        <div class="form-group">
            <label for = "business_name"> <b>Please enter the business name you would like to schedule an appointment with:</b></label><br>
            <input type="text" placeholder="Business Name" name = "business_name" id = "business_name" required>
        </div>

        <div class="form-group">
            <label for = "date"> <b>Enter the Date you would like to Request:</b></label><br>
            <input type="text" placeholder="Date" name = "date" id = "date" required>
        </div>

        <div class="form-group">
            <label for = "time"> <b>Enter the Time you would like to Request:</b></label><br>
            <input type="text" placeholder="Time" name = "time" id = "time" required>
        </div>

        <div class="form-group">
            <label for = "description"> <b>Enter a quick job description:</b></label><br>
            <input type="text" placeholder="Description" name = "description" id = "description" required>
        </div>

        <input type='submit' value='Confirm Appointment'>
    </form>


    <?php 
        require_once "config.php";

        $email = $_SESSION['email_c'];
        
        
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $business_name = $_POST['business_name'];   
            $date = $_POST['date'];
            $time = $_POST['time'];
            $description = $_POST['description'];
        
            $sql1 = "INSERT INTO appointments (date, time, description) VALUES ('".$date."', '".$time."', '".$description."')";
                 
            $results1 = mysqli_query($conn, $sql1);
        
            $sql2 = "UPDATE appointments 
            SET customer_info_id = (SELECT customer_info_id FROM customer_info WHERE email_c = '".$email."')
            WHERE date = '".$date."' AND time = '".$time."'";
        
            $results2 = mysqli_query($conn, $sql2);

            $sql3 = "UPDATE appointments 
            SET business_info_id = (SELECT business_info_id FROM business_info WHERE business_name LIKE '".$business_name."')
            WHERE customer_info_id = (SELECT customer_info_id FROM customer_info WHERE email_c = '".$email."') AND 
            date = '".$date."' AND time = '".$time."' ";

            $results3 = mysqli_query($conn, $sql3);
        
            $sql4 = "SELECT * FROM appointments WHERE date = '".$date."'";
        
            $results4 = mysqli_query($conn, $sql4);
        
            
            if (mysqli_num_rows($results4) > 0){
                while ($row = mysqli_fetch_array($results4)){
                    echo "<br>";
                    echo "<p class = 'echo'>
                    Your appointment with " .$business_name. " was booked for: ".$row[3]." at ". $row[4].".<br></p>";
                    echo "<br>";
                    
                    
                }
            }else{
                echo "<p class = 'echo'>Sorry there was an error. </p>";
            }

            $sql5 = "DELETE FROM appointments WHERE business_info_id = 0 ";

            $results5 = mysqli_query($conn, $sql5);
        
            mysqli_close($conn);
        
        }
        ?>

        

    

    <p> How can we help you today?</p>

    <p><a href = "customerhomepage.php">Go back to the homepage</a></p>
    <p><a href = "findbusiness.php">Find a New Business</a><p>
    

    </body>
</center>
</html>