<?php
session_start();

$DBHost = "localhost"; //hostname
$DBUser = "root";      //username
$DBPass = "";          //password
$DBName = "aniclo";    //database

$conn = mysqli_connect($DBHost, $DBUser, $DBPass, $DBName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginUsername = $_POST["logusername"];
    $loginPassword = $_POST["logpassword"]; 

    $sql = "SELECT reg_username, reg_email, reg_password FROM ani_register WHERE reg_username='$loginUsername' AND reg_password='$loginPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $_SESSION['reg_username'] = $row['reg_username'];
        $_SESSION['reg_email'] = $row['reg_email'];
        $_SESSION['reg_password'] = $row['reg_password'];
       
    
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
    
        header("Location: index.html");
        exit();
    } else {
        
        echo "
        <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .background {
            width: calc(100%/ 12 * 12);
            height: 100vh;
            background: radial-gradient(#fff,#D8BFD8);
        }
        .signup-message {
            font-size: 4ex;
            text-align: center;
            width: calc(100%/12 * 4);
            padding: 15px 0;
            margin: 15% auto 0;
            color: red;

        }
        .goback-btn {
            margin-left: 47%;
            padding: 1%;
            background-color: #BA55D3;
            font-size: 2ex;
            color: white;
            border: none;
            border-radius: 10px;
        }
        </style>
        <div class='background'>
            <br>
            <div class='signup-message'>
                <p>Incorrect Username or Password. Please try again!</p>
            </div> <br>

            <a href='javascript:self.history.back()'><button class='goback-btn'>Go Back</button></a>
        </div>";
    }
 }
 $conn->close();
 ?>