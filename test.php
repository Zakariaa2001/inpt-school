<?php

$cnx = mysqli_connect("localhost", "root", "", "school");
if (!$cnx) {
    echo "error" . mysqli_connect_errno();
}
session_start();
$command = "SELECT * FROM filieres";
$resulta = mysqli_query($cnx, $command);
$filiereRes = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// // insert
$filiere = "";
$typeRoom = "";
$date = "";
$start = "";
$end = "";
//$_SESSION["teacherEmail"] = $_GET["teacherEmail"];
// echo $_SESSION["teacherEmail"];
// session_start();
// log out
/*
if (time() - $_SESSION["time_logIn"] > 20) {
    header("location:http://localhost:8080/project_stage/teacher.php");
}
*/
if (isset($_POST["submit"])) {
    $name_filiere = $_POST['name_filiere'];
    $typeRoom = mysqli_real_escape_string($cnx, $_POST['typeRoom']);
    $date = mysqli_real_escape_string($cnx, $_POST["date"]);
    $start = mysqli_real_escape_string($cnx, $_POST["start"]);
    $end = mysqli_real_escape_string($cnx, $_POST["end"]);
    $teacherId = $_GET["teacherId"];
    $sql = "INSERT INTO inforoom(nameFiliere , nameSalle  , date,start , end , idTeacher)
         VALUES ('$name_filiere' , '$typeRoom', '$date'  , '$start' , '$end', '$teacherId')";
    if (mysqli_query($cnx, $sql)) {

        header('Location:' . $_SERVER["PHP_SELF"]);
    } else {
        echo 'error' . mysqli_error($cnx);
    }
}
// select info Room
$command = "SELECT * FROM inforoom";
$resulta = mysqli_query($cnx, $command);
$infoRoom = mysqli_fetch_all($resulta, MYSQLI_ASSOC);

// delte 
// if (isset($_GET["delete"])) {
//     $id = $_GET["delete"];
//     $teacherEmail = $_GET["teacherEmail"];
//     $command = "DELETE FROM inforoom WHERE id=$id";
//     mysqli_query($cnx, $command);
//     header('Location:' . $_SERVER["PHP_SELF"]);
// }
// update 
$id = 0;
$nameSalle = "";
if (isset($_GET["edit"])) {
    //$id = $_GET["edit"];
    echo "ok";
    // $id = $_POST["id"];
    // echo $id;
    // $command = "SELECT * FROM inforoom WHERE id=$id";
    // $resulta = mysqli_query($cnx, $command);
    // $infoRoom = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
    // foreach ($infoRoom as $Room) {
    //     $group = $Room["nameFiliere"];
    //     $nameSalle = $Room["nameSalle"];
    //     $date = $Room["date"];
    //     $start = $Room["start"];
    //     $end = $Room["end"];
    // }
}
if (isset($_POST["Update"])) {
    // $name_filiere = $_POST['name_filiere'];
    // $date = mysqli_real_escape_string($cnx, $_POST["date"]);
    // $start = mysqli_real_escape_string($cnx, $_POST["start"]);
    // $end = mysqli_real_escape_string($cnx, $_POST["end"]);
    // $sql_command = "UPDATE inforoom SET nameFiliere='$name_filiere' 
    // , start = '$start' , end='$end' WHERE id='$id'";
    // $_SERVER["message"] = "update";
    // header('Location:http://localhost:8080/project_stage/main-teacher.php?teacherId=' . $teacherId);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/teacher_main.css">
    <!-- normalize link -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;800&family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="table">
        <h1 class="main-title">Information Table</h1>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>Group</th>
                        <th>Room</th>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($infoRoom as $info) : ?>
                        <tr>
                            <td><?php echo $info["nameFiliere"]; ?></td>
                            <td><?php echo $info["nameSalle"]; ?></td>
                            <td><?php echo $info["date"]; ?></td>
                            <td><?php echo $info["start"]; ?></td>
                            <td><?php echo $info["end"]; ?></td>
                            <td>
                                <div><a class="edit" href="main-teacher.php<?php $_SESSION["idEdit"] = $info["id"]; ?>">edit</a> </div>
                                <div><a href="main-teacher.php?delete=<?php echo $info["id"]; ?>" class="delete" onclick="return chekdelete()">delete</a> </div>
                            </td>
                        </tr>
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
                <!-- <input type="text" class="nameTeacher" name="nameTeacher"> -->
                <h2 for="">TP :</h2>
                <div class="tp">

                    <input type="submit" value="TP1" id="tp" name="tp1" class="btnRoom">
                    <input type="submit" value="TP2" id="tp" name="tp2" class="btnRoom">
                    <input type="submit" value="TP3" id="tp" name="tp2" class="btnRoom">
                    <input type="submit" value="TP4" id="tp" name="tp4" class="btnRoom">
                    <input type="submit" value="TP5" id="tp" name="tp5" class="btnRoom">
                    <input type="submit" value="TP6" id="tp" name="tp6" class="btnRoom">
                </div>
                <h2 for="">cour room:</h2>
                <div class="cour">

                    <input type="submit" value="s1" id="s" name="s1" class="btnRoom">
                    <input type="submit" value="s2" id="s" name="s2" class="btnRoom">
                    <input type="submit" value="s3" id="s" name="s2" class="btnRoom">
                    <input type="submit" value="s4" id="s" name="s4" class="btnRoom">
                </div>
                <h2 for="">reunion room:</h2>

                <div class="tp">
                    <input type="submit" value="b1" id="b" name="b1" class="btnRoom">
                    <input type="submit" value="b2" id="b" name="b2" class="btnRoom">
                    <input type="submit" value="b3" id="b" name="b2" class="btnRoom">
                    <input type="submit" value="b4" id="b" name="b4" class="btnRoom">
                    <input type="submit" value="b5" id="b" name="b5" class="btnRoom">
                    <input type="submit" value="b6" id="b" name="b6" class="btnRoom">
                </div>

                <div id="modal" class="modal">
                    <H1>reserve Room </H1>
                    <div class="modal-body">
                        <div>
                            <label for="">group</label>
                            <br>
                            <select name="name_filiere" id="">
                                <option value="TDI201">TDI201</option>
                                <option value="TDI202">TDI202</option>
                                <option value="TDI203">TDI203</option>
                            </select>
                            <!-- <select name="" id="" name="Filiere">
                    <?php //foreach ($filiereRes as $f) :
                    ?>
                        <option value='<?php $f["nameFiliere"] ?>'><?php //echo htmlspecialchars($f["nameFiliere"]); 
                                                                    ?></option>
                    <?php //endforeach;
                    ?>
                </select> -->
                        </div>
                        <div>
                            <input type="text" id="typeRoom" name="typeRoom" value="<?php echo $nameSalle; ?>" id="empty">
                        </div>
                        <div>
                            <label for="">Date</label>
                            <br>
                            <input type="Date" name="date">
                        </div>
                        <div>
                            <label for="">start</label>
                            <br>
                            <input type="time" name="start" value="8:00">
                        </div>
                        <div>
                            <label for="">end</label>
                            <br>
                            <input type="time" name="end" value="8:00">
                        </div>
                        <input type="text" name="id" value="<?php echo $id; ?>">
                        <input type="submit" class="update" value="save" name="submit" id="submit">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="close" class="close">
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- end create -->
    <script src="./js/teacher_main.js"></script>
    <script>
        // function chekdelete() {
        //     return confirm("Are you sure you want to delete this record");
        // }
    </script>
</body>

</html>