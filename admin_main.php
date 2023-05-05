<?php
$cnx = mysqli_connect("localhost", "root", "", "school");
if (!$cnx) {
    "error" . mysqli_connect_errno();
}
session_start();
// select admin
$command = "SELECT * FROM admins";
$resulta = mysqli_query($cnx, $command);
$admins = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// seclect matiere
$command = "SELECT * FROM matiere";
$resulta = mysqli_query($cnx, $command);
$matieres = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// seclect teachers
$command = "SELECT * FROM teachers";
$resulta = mysqli_query($cnx, $command);
$teachers = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// seclect infoRoom
$command = "SELECT * FROM infoRoom";
$result = mysqli_query($cnx, $command);
$infoRoom = mysqli_fetch_all($result, MYSQLI_ASSOC);
// seclect filiere
$command = "SELECT * FROM filieres";
$result = mysqli_query($cnx, $command);
$rows  = mysqli_fetch_all($result, MYSQLI_ASSOC);
// select reservation
$command = "SELECT * FROM reservation";
$resulta = mysqli_query($cnx, $command);
$reservation = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// submit
$errors = [
    "emailError" => "",
    "passwordError" => "",
    "nameError" => "",
    // "Error" => ""
];
$adminId = $_GET["adminId"];
$_SESSION["id"] = $adminId;
$ItemExist = false;
// save teacher
if (isset($_POST["submit"])) {
    $matiere = $_POST["matiere"];
    $email = mysqli_real_escape_string($cnx, $_POST["email"]);
    $name = mysqli_real_escape_string($cnx, $_POST["name"]);
    $password = mysqli_real_escape_string($cnx, $_POST["password"]);
    $adminId = $_GET["adminId"];
    foreach ($teachers as $teacher) {
        if ($teacher["email"] == $email) {
            $ItemExist = true;
            break;
        }
    }
    if (!$ItemExist) {
        if (empty($email)) {
            echo '<script> alert("please enter your email ")</script>';
            header('Location:' . $_SERVER["PHP_SELF"] . '?adminId=' .  $adminId);
        } elseif (empty($name)) {
            echo '<script>alert("please enter your name ")</script>';
            header('Location:' . $_SERVER["PHP_SELF"] . '?adminId=' .  $adminId);
        } elseif (empty($password)) {
            echo '<script>alert("please enter your password ")</script>';
            header('Location:' . $_SERVER["PHP_SELF"] . '?adminId=' .  $adminId);
        } else {
            $sql = "INSERT INTO teachers(email , password , name , idmatiere) 
                    VALUES ('$email' , '$password' , '$name' , $matiere)";
            mysqli_query($cnx, $sql);
            header('Location:' . $_SERVER["PHP_SELF"] . '?adminId=' . $adminId);
            echo '<script>alert("teacher add with succes")</script>';
        }
    } else {
        echo '<script>alert("this teacher already exist")</script>';
        header('Location:' . $_SERVER["PHP_SELF"] . '?adminId=' .  $adminId);
    }
}
// submit
if (isset($_POST["insert"])) {  
    $name_filiere = $_POST['name_filiere'];
    $typeRoom = mysqli_real_escape_string($cnx, $_POST['typeRoom']);
    $date = mysqli_real_escape_string($cnx, $_POST["date"]);
    $start = mysqli_real_escape_string($cnx, $_POST["start"]);
    $end = mysqli_real_escape_string($cnx, $_POST["end"]);
    $adminId = $_GET["adminId"];
    // use for
    for ($i = 0; $i < count($reservation); $i++) {
        if ($reservation[$i]["numRoom"] == $typeRoom && $reservation[$i]["date"] == $date &&  ($start >= $reservation[$i]["start"] && $start <= $reservation[$i]["end"] || $end >= $reservation[$i]["start"] && $end <= $reservation[$i]["end"])) {
            $ItemExist = true;
            break;
        }
    }
    if ($ItemExist == false) {
        $sql = "INSERT INTO inforoom(nameFiliere , nameSalle  , date,start , end , idTeacher)
            VALUES ('$name_filiere' , '$typeRoom', '$date'  , '$start' , '$end','$adminId')";
        if (mysqli_query($cnx, $sql)) {
            $idInfo = $cnx->insert_id;
            header('Location:' . $_SERVER["PHP_SELF"] . '?adminId=' . $adminId);
            $insert = "INSERT INTO reservation(numRoom ,date, start , end , idInfoRoom) VALUES('$typeRoom' ,'$date', '$start' , '$end', '$idInfo')";
            if (mysqli_query($cnx, $insert)) {
                echo "ok";
            } else {
                echo 'error' . mysqli_error($cnx);
            }
        }
    } else {
        echo '<script>alert("this room already reserved")</script>';
    }
}
// delete 
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $adminId = $_GET["adminId"];
    $command = "DELETE FROM inforoom WHERE id='$id'";
    mysqli_query($cnx, $command);
    header('Location:' . $_SERVER["PHP_SELF"] . "?adminId=" . $_SESSION["id"]);
}
// update

if (isset($_POST["Update"])) {
    $id = mysqli_real_escape_string($cnx, $_POST['id']);
    $typeRoom = mysqli_real_escape_string($cnx, $_POST['typeRoom']);
    $name_filiere = $_POST['name_filiere'];
    $date = mysqli_real_escape_string($cnx, $_POST["date"]);
    $start = mysqli_real_escape_string($cnx, $_POST["start"]);
    $end = mysqli_real_escape_string($cnx, $_POST["end"]);
    $adminId = $_GET["adminId"];
    $idInfo = $info['id'];
    $sql_command = "UPDATE inforoom SET nameFiliere='$name_filiere' 
    , start = '$start' , date='$date',end='$end' WHERE id='$id'";
    $query_run = mysqli_query($cnx, $sql_command);
    if ($query_run) {
        header('Location:' . $_SERVER["PHP_SELF"] . "?adminId=" . $_SESSION["id"]);
    } else {
        echo "<script>alert('data not update')</script>";
    }
    $command_update = "UPDATE reservation SET numRoom='$typeRoom' 
    , start = '$start' , date='$date',end='$end' WHERE idInfoRoom='$id'";
    $query_run = mysqli_query($cnx, $command_update);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <!-- link css -->
    <link rel="stylesheet" href="./css/admin_main.css">
    <!-- normailze link -->
    <link rel="stylesheet" href="./css/normalize.css">
</head>

<body>
    <!-- start header -->
    <header>
        <div class="container">
            <div class="img">
                <a href="">
                    <img src="./images/logo.png" alt="logo">
                    <span>inpt</span>
                </a>

            </div>
            <div class="links">
                <ul>
                    <li class="newClass"><a></a></li>
                    <li class="new"><a>New Teacher</a></li>
                    <li class="new"><a href="#Schedule">Schedule</a></li>
                    <li><a href="#reserve-room">Reserve Room</a></li>
                    <li class="infoLog">
                        <?php foreach ($admins as $admin) : ?>
                            <?php if ($admin["idAdmin"] == $_SESSION["idAdmin"]) : ?>
                                <a href="#" class="last"><?php echo substr($admin["name"], 0, 1);  ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </li>
                </ul>
                <div class="info-log">
                    <?php foreach ($admins as $admin) : ?>
                        <?php if ($admin["idAdmin"] == $_SESSION["idAdmin"]) : ?>
                            <div class="img"><?php echo substr($admin["name"], 0, 1);  ?></div>
                            <div class="name"><?php echo $admin["name"];  ?></div>
                            <div class="email"><?php echo $admin["email"];  ?></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <button class="log-out">
                        <a href="http://localhost:8080/project_stage/admin.php">log out</a>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <form action="admin_main.php" id="form1" method="POSt">
        <div id="modaal" class="modaal">

            <div id="test"></div>
            <div class="modaalcontent">
                <H1 id="main-titlle">New Teacher </H1>
                <div>
                    <label for="">matiere</label>
                    <br>
                    <select name="matiere" id="matiere">
                        <?php foreach ($matieres as $matiere) { ?>
                            <option value="<?= $matiere['idMatiere'] ?>"> <?= $matiere['nameMatiere'] ?> </option>;
                        <?php } ?>
                    </select>


                </div>
                <div>
                    <label for="">email</label>
                    <br>
                    <input type="email" name="email" id="email" placeholder="enter your email">
                    <div><?php echo $errors["emailError"]; ?></div>
                </div>
                <div>
                    <label for="">name</label>
                    <br>
                    <input type="text" name="name" id="name" placeholder="enter your name">
                    <div><?php echo $errors["nameError"]; ?></div>
                </div>
                <div>
                    <label for="">password</label>
                    <br>
                    <input type="password" name="password" id="password" placeholder="enter your password">
                    <div><?php echo $errors["passwordError"]; ?></div>
                </div>
                <div class="save">
                    <input type="submit" class="update first" value="save" name="submit" id="save">
                </div>
                <div class="modal-footer">
                    <a href="">&times;</a>
                    <!-- <input type="submit" value="&times;" class=""> -->
                </div>
            </div>
        </div>
    </form>
    <!-- end header -->
    <!-- start Schedule -->
    <div class="table" id="Schedule">
        <h1 class="main-title">Schedule</h1>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th class="hiddden">id</th>
                        <th>Filiére</th>
                        <th>Room</th>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($infoRoom as $info) : ?>
                        <tr class="info">
                            <td class="id hiddden" value="<?php echo $info["id"]; ?>"><?php echo $info["id"]; ?></td>
                            <td class="nameFiliere" value="<?php echo $info["nameFiliere"]; ?>"><?php echo $info["nameFiliere"]; ?></td>
                            <td class="nameSalle" value="<?php echo $info["nameSalle"]; ?>"><?php echo $info["nameSalle"]; ?></td>
                            <td class="date" value="<?php echo $info["date"]; ?>"><?php echo $info["date"]; ?></td>
                            <td class="start" value="<?php echo $info["start"]; ?>"><?php echo $info["start"]; ?></td>
                            <td class="end" value="<?php echo $info["end"]; ?>"><?php echo $info["end"]; ?></td>
                            <td>
                                <div><a class="edit" href="admin_main.php?edit=<?php echo $info["id"]; ?>">update</a> </div>
                                <!-- <div><a class="edit" href="teacher_main.php?teacherId=<?php echo $_SESSION["id"]; ?>&edit=<?php echo $info["id"]; ?>">update</a> </div> -->

                                <div><a href="admin_main.php?adminId=<?php echo $_SESSION["id"] ?>&delete=<?php echo $info["id"]; ?>" class="delete" onclick="return chekdelete()">delete</a> </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end Schedule -->
    <!-- start Reserve Room -->
    <!-- ok -->
    <div class="create">
        <h1 class="main-title" id="reserve-room">reserve room </h1>
        <div class="container">
            <form action="<?php $_SERVER["PHP_SELF"] ?>" id="form1" method="POST">
                <h2 for="">Tp Room :</h2>
                <div class="tp">
                    <input type="submit" value="TP1" id="tp" name="tp1" class="btnRoom ok">
                    <input type="submit" value="TP2" id="tp" name="tp2" class="btnRoom">
                    <input type="submit" value="TP3" id="tp" name="tp2" class="btnRoom">
                    <input type="submit" value="TP4" id="tp" name="tp4" class="btnRoom">
                    <input type="submit" value="TP5" id="tp" name="tp5" class="btnRoom">
                    <input type="submit" value="TP6" id="tp" name="tp6" class="btnRoom">
                </div>
                <h2 for="">Cour Room:</h2>
                <div class="cour">
                    <input type="submit" value="S1" id="S" name="S1" class="btnRoom">
                    <input type="submit" value="S2" id="S" name="S2" class="btnRoom">
                    <input type="submit" value="S3" id="S" name="S2" class="btnRoom">
                    <input type="submit" value="S4" id="S" name="s4" class="btnRoom">
                </div>
                <h2 for="">Reunion Room:</h2>
                <div class="reunion">
                    <input type="submit" value="B1" id="B" name="B1" class="btnRoom">
                    <input type="submit" value="B2" id="B" name="B2" class="btnRoom">
                    <input type="submit" value="B3" id="B" name="B2" class="btnRoom">
                    <input type="submit" value="B4" id="B" name="B4" class="btnRoom">
                    <input type="submit" value="B5" id="B" name="B5" class="btnRoom">
                    <input type="submit" value="B6" id="B" name="B6" class="btnRoom">
                </div>
                <!-- <div class="verify"><?php echo $error["Error"]; ?></div> -->
                <!-- ok -->
                <div id="modal" class="modal">
                    <div id="test"></div>
                    <div class="modalcontent">
                        <H1 id="main-title">reserve Room </H1>
                        <div>
                            <input type="hidden" name="id" id="id">
                            <label for="">Filiére</label>
                            <br>
                            <select name="name_filiere" id="Filiere">
                                <?php foreach ($rows as $row) { ?>
                                    <option value="<?= $row['nameFiliere'] ?>"> <?= $row['nameFiliere'] ?> </option>;
                                <?php } ?>
                            </select>


                        </div>
                        <div>
                            <input type="hidden" id="typeRoom" class="typeRoom" name="typeRoom" value="<?php //echo $nameSalle;
                                                                                                        ?>" id="empty">
                        </div>
                        <div>
                            <label for="">Date</label>
                            <br>
                            <input type="Date" name="date" id="date">
                        </div>
                        <div>
                            <label for="">start</label>
                            <br>
                            <input type="time" name="start" value="08:00" id="start">
                        </div>
                        <div>
                            <label for="">end</label>
                            <br>
                            <input type="time" name="end" value="08:00" id="end">
                        </div>
                        <div class="save">
                            <input type="submit" class="updatee first" value="insert" name="insert" id="submit">
                        </div>
                        <div class="modal-footer">
                            <a href="">&times;</a>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- end Reserve Room -->
    <script src="./js/admin_main.js"></script>
</body>

</html>