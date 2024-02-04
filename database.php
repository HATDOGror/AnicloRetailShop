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

if (isset($_POST['regbtn']) != '') {
    $username = mysqli_real_escape_string($conn, $_POST['regusername']);
    $email = mysqli_real_escape_string($conn, $_POST['regemail']);
    $password = mysqli_real_escape_string($conn, $_POST['regpassword']);

    $checkEmailQuery = "SELECT * FROM ani_register WHERE reg_email = '$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) != 0) {
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
                <p>This email is used, Try another one please!</p>
            </div> <br>

            <a href='javascript:self.history.back()'><button class='goback-btn'>Go Back</button></a>
        </div>";
    } else {
        $sql = "INSERT INTO ani_register (`reg_username`, `reg_email`, `reg_password`) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
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
            font-size: 6ex;
            text-align: center;
            width: calc(100%/12 * 4);
            padding: 15px 0;
            margin: 15% auto 0;
            color: #EE82EE;

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
                <p>Registration Completed!</p>
            </div> <br>

            <a href='account.html'><button class='goback-btn'>Go Back</button></a>
        </div>";
		
		
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

$conn->close();


?>