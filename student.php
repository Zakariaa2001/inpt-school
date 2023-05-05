<?php
$email = "";
$password = "";
//for open connection
$cnx = mysqli_connect("localhost", "root", "", "school");
if (!$cnx) {
    echo "error" . mysqli_connect_errno();
}
$errors = [
    "emailError" => "",
    "passwordError" => "",
    "invalid" => ""
];
// for log in 
if (isset($_POST["log-in"])) {
    $email = mysqli_real_escape_string($cnx, $_POST["email"]);
    $password = mysqli_real_escape_string($cnx, $_POST["password"]);
    // $_SESSION["time_logIn"] = time();
    // for command 
    $command = "SELECT * FROM students";
    $resulta = mysqli_query($cnx, $command);
    $students = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
    foreach ($students as $student) {
        if (empty($email)) {
            $errors["emailError"] = "please enter your email";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["emailError"] = "email invalid";
        }
        if (empty($password)) {
            $errors["passwordError"] = "please enter your password";
        }
        // if (!array_filter($errors)) {
        if ($email == $student["email"] && $password == $student["password"]) {
            $studentId = $student["idStudent"];
            header('location:http://localhost:8080/project_stage/student_main.php?studentId=' . $studentId);
        } else if ($email != $student["email"] || $password != $student["password"]) {
            $errors["invalid"] = "your password or email incorrect";
        }
        // }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student</title>
    <link rel="stylesheet" href="css/teacher.css">
    <style>
        .form .img img {
            box-shadow: -3px 3px 6px 0px #777;
        }

        .form form input {
            width: 250px;
        }

        .form {
            padding: 0px;
        }
    </style>
</head>

<body>
    <div class="form">
        <div class="img">
            <h1>student</h1>
            <img src="./images/images-2.png" alt="logo">
        </div>
        <div class="verify"><?php echo $errors["invalid"]; ?></div>
        <div>
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                <div>
                    <label for="email">email</label>
                    <br>
                    <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                    <div class="verify"><?php echo $errors["emailError"]; ?></div>

                </div>
                <div>
                    <label for="password">password</label>
                    <br>
                    <input type="password" id="password" name="password">
                    <div class="verify"><?php echo $errors["passwordError"]; ?></div>

                </div>
                <input type="submit" value="log in" name="log-in">
                <!-- <p>forget password?</p> -->
            </form>
        </div>
    </div>
</body>

</html>