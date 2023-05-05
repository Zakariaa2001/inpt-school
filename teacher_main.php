<?php

$ItemExist = false;


// for connexion 
session_start();
$cnx = mysqli_connect("localhost", "root", "", "school");
if (!$cnx) {
    echo "error" . mysqli_connect_errno();
}
// for dropdownlist
$command = "SELECT * FROM filieres";
$resulta = mysqli_query($cnx, $command);
$rows = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// select info Room
$command = "SELECT * FROM inforoom";
$resulta = mysqli_query($cnx, $command);
$infoRoom = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// select reservation
$command = "SELECT * FROM reservation";
$resulta = mysqli_query($cnx, $command);
$reservation = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// select teachers
$command = "SELECT * FROM teachers";
$resulta = mysqli_query($cnx, $command);
$teachers = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// insert
$filiere = "";
$typeRoom = "";
$date = "";
$start = "";
$end = "";
$teacherId = $_GET["teacherId"];
$_SESSION["id"] = $teacherId;
// submit
$error = [
    "Error" => ""
];

if (isset($_POST["submit"])) {
    $name_filiere = $_POST['name_filiere'];
    $typeRoom = mysqli_real_escape_string($cnx, $_POST['typeRoom']);
    $date = mysqli_real_escape_string($cnx, $_POST["date"]);
    $start = mysqli_real_escape_string($cnx, $_POST["start"]);
    $end = mysqli_real_escape_string($cnx, $_POST["end"]);
    $teacherId = $_GET["teacherId"];
    // use for
    for ($i = 0; $i < count($reservation); $i++) {
        if ($reservation[$i]["numRoom"] == $typeRoom && $reservation[$i]["date"] == $date &&  ($start >= $reservation[$i]["start"] && $start <= $reservation[$i]["end"] || $end >= $reservation[$i]["start"] && $end <= $reservation[$i]["end"])) {
            $ItemExist = true;
            break;
        }
    }
    if ($ItemExist == false) {
        $sql = "INSERT INTO inforoom(nameFiliere , nameSalle  , date,start , end , idTeacher)
            VALUES ('$name_filiere' , '$typeRoom', '$date'  , '$start' , '$end', '$teacherId')";
        if (mysqli_query($cnx, $sql)) {
            $idInfo = $cnx->insert_id;
            header('Location:' . $_SERVER["PHP_SELF"] . '?teacherId=' . $teacherId);
            $insert = "INSERT INTO reservation(numRoom ,date, start , end , idInfoRoom) VALUES('$typeRoom' ,'$date', '$start' , '$end', '$idInfo')";
            if (mysqli_query($cnx, $insert)) {
                echo "ok";
            } else {
                echo 'error' . mysqli_error($cnx);
            }
        }
    } else {
        echo '<script>alert("this room already reserved ")</script>';
    }
}

// delete 
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $teacherEmail = $_GET["teacherEmail"];
    $command = "DELETE FROM inforoom WHERE id=$id";
    mysqli_query($cnx, $command);
    header('Location:' . $_SERVER["PHP_SELF"] . "?teacherId=" . $_SESSION["id"]);
}
$id = 0;
$nameSalle = "";
// update
if (isset($_POST["Update"])) {
    $id = $_POST["id"];
    $typeRoom = mysqli_real_escape_string($cnx, $_POST['typeRoom']);
    $name_filiere = $_POST['name_filiere'];
    $date = mysqli_real_escape_string($cnx, $_POST["date"]);
    $start = mysqli_real_escape_string($cnx, $_POST["start"]);
    $end = mysqli_real_escape_string($cnx, $_POST["end"]);
    $sql_command = "UPDATE inforoom SET nameFiliere='$name_filiere' 
    , start = '$start' , date='$date',end='$end' WHERE id='$id'";
    $query_run = mysqli_query($cnx, $sql_command);
    if ($query_run) {
        header('Location:' . $_SERVER["PHP_SELF"] . "?teacherId=" . $_SESSION["id"]);
    } else {
        echo "<script>alert('date not update')</script>";
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
    <title>teacher_main</title>
    <link rel="stylesheet" href="css/teacher_main.css">
    <!-- normalize link -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;800&family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">
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
                    <li><a href="#">Schedule</a></li>
                    <li><a href="#">Reserve Room</a></li>
                    <li>
                        <?php foreach ($teachers as $teacher) : ?>
                            <?php if ($teacher["idTeacher"] == $_GET["teacherId"]) : ?>
                                <a href="#" class="last"><?php echo substr($teacher["name"], 0, 1);  ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </li>
                </ul>
                <div class="info-log">
                    <?php foreach ($teachers as $teacher) : ?>
                        <?php if ($teacher["idTeacher"] == $_GET["teacherId"]) : ?>
                            <div class="img"><?php echo substr($teacher["name"], 0, 1);  ?></div>
                            <div class="name"><?php echo $teacher["name"];  ?></div>
                            <div class="email"><?php echo $teacher["email"];  ?></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <button class="log-out">
                        <a href="http://localhost:8080/project_stage/teacher.php">log out</a>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->
    <div class="table">
        <h1 class="main-title">planing</h1>
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
                        <?php if ($info["idTeacher"] == $_GET["teacherId"]) : ?>
                            <tr class="info">
                                <td class="id hiddden" value="<?php echo $info["id"]; ?>"><?php echo $info["id"]; ?></td>
                                <td class="nameFiliere" value="<?php echo $info["nameFiliere"]; ?>"><?php echo $info["nameFiliere"]; ?></td>
                                <td class="nameSalle" value="<?php echo $info["nameSalle"]; ?>"><?php echo $info["nameSalle"]; ?></td>
                                <td class="date" value="<?php echo $info["date"]; ?>"><?php echo $info["date"]; ?></td>
                                <td class="start" value="<?php echo $info["start"]; ?>"><?php echo $info["start"]; ?></td>
                                <td class="end" value="<?php echo $info["end"]; ?>"><?php echo $info["end"]; ?></td>
                                <td>
                                    <div><a class="edit" href="teacher_main.php?teacherId=<?php echo $_SESSION["id"]; ?>&edit=<?php echo $info["id"]; ?>">update</a> </div>
                                    <div><a href="teacher_main.php?teacherId=<?php echo $_SESSION["id"]; ?>&delete=<?php echo $info["id"]; ?>" class="delete" onclick="return chekdelete()">delete</a> </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- start create -->
    <div class="create">
        <h1 class="main-title">reserve room </h1>
        <div class="container">
            <form action="<?php $_SERVER["PHP_SELF"] ?>" id="form1" method="POST">
                <h2 for="">TP :</h2>
                <div class="tp">
                    <input type="submit" value="TP1" id="tp" name="tp1" class="btnRoom ok">
                    <input type="submit" value="TP2" id="tp" name="tp2" class="btnRoom">
                    <input type="submit" value="TP3" id="tp" name="tp2" class="btnRoom">
                    <input type="submit" value="TP4" id="tp" name="tp4" class="btnRoom">
                    <input type="submit" value="TP5" id="tp" name="tp5" class="btnRoom">
                    <input type="submit" value="TP6" id="tp" name="tp6" class="btnRoom">
                </div>
                <h2 for="">cour room:</h2>
                <div class="cour">
                    <input type="submit" value="S1" id="S" name="S1" class="btnRoom">
                    <input type="submit" value="S2" id="S" name="S2" class="btnRoom">
                    <input type="submit" value="S3" id="S" name="S2" class="btnRoom">
                    <input type="submit" value="S4" id="S" name="s4" class="btnRoom">
                </div>
                <h2 for="">reunion room:</h2>
                <div class="reunion">
                    <input type="submit" value="B1" id="B" name="B1" class="btnRoom">
                    <input type="submit" value="B2" id="B" name="B2" class="btnRoom">
                    <input type="submit" value="B3" id="B" name="B2" class="btnRoom">
                    <input type="submit" value="B4" id="B" name="B4" class="btnRoom">
                    <input type="submit" value="B5" id="B" name="B5" class="btnRoom">
                    <input type="submit" value="B6" id="B" name="B6" class="btnRoom">
                </div>
                <div class="verify"><?php echo $error["Error"]; ?></div>

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
                            <input type="hidden" id="typeRoom" name="typeRoom" value="<?php //echo $nameSalle; 
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
                            <input type="submit" class="update first" value="save" name="submit" id="submit">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" value="&times;" class="close">
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- end create -->
    <script src="./js/teacher_main.js"></script>


</body>

</html>