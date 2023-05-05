<?php
$cnx = mysqli_connect("localhost", "root", "", "school");
if (!$cnx) {
    echo "error" . mysqli_connect_errno();
}

// select inforoom
$command = "SELECT * FROM inforoom";
$resulta = mysqli_query($cnx, $command);
$inforoom = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// select students
$command = "SELECT * FROM students";
$resulta = mysqli_query($cnx, $command);
$students = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// select matiere
$command = "SELECT * FROM matiere";
$resulta = mysqli_query($cnx, $command);
$matiere = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
// select teachers
$command = "SELECT * FROM teachers";
$resulta = mysqli_query($cnx, $command);
$teachers = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student_main</title>
    <!--css link  -->
    <link rel="stylesheet" href="./css/student_main.css">
    <!-- nomalize file -->
    <link rel="stylesheet" href="./css/normalize.css">
    <!-- font Awesome file -->
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;800&family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">
</head>

<body>
    <!-- start header -->
    <div class="header" id="home">
        <div class="container">
            <header>
                <div class="img">

                    <a href="">
                        <img src="./images/logo.png" alt="logo">
                        <span>inpt</span>
                    </a>

                </div>
                <div class="links">
                    <ul>
                        <li><a href="#Information">Schedule</a></li>
                        <li><a href="#contact">contact us</a></li>
                        <li><a href="http://localhost:8080/project_stage/student.php">log out</a></li>
                    </ul>
                </div>
            </header>
            <div class="text">
                <h1>welcome to your school</h1>
            </div>
        </div>
    </div>
    <!-- end header -->
    <!-- start info -->
    <section class="info">
        <h2 class="title">Schedule</h2>
        <table class="table" id="Information">
            <thead>
                <tr>
                    <th>teacher</th>
                    <th>matiere</th>
                    <th>room</th>
                    <th>date</th>
                    <th>start</th>
                    <th>end</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inforoom as $room) { ?>
                    <?php foreach ($students as $student) { ?>
                        <?php foreach ($teachers as $teacher) { ?>
                            <?php foreach ($matiere as $ma) { ?>
                                <?php if ($student["idStudent"] == $_GET["studentId"] && $room["nameFiliere"] == $student["nameFiliere"] && $teacher["idTeacher"] == $room["idTeacher"] && $teacher["idMatiere"] == $ma["idMatiere"]) { ?>
                                    <tr>
                                        <td><?= $teacher["name"] ?></td>
                                        <td><?= $ma["nameMatiere"] ?></td>
                                        <td><?= $room["nameSalle"] ?></td>
                                        <td><?= $room["date"] ?></td>
                                        <td><?= $room["start"] ?></td>
                                        <td><?= $room["end"] ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php }
                ?>
            </tbody>
        </table>
    </section>
    <!-- end info -->
    <!-- start concat -->
    <div class="Contact" id="contact">
        <div class="container">
            <h2 class="title">Contact us</h2>
            <div class="Contact-content">
                <div class="links">
                    <h2>Quick Links</h2>
                    <a href="#home">home</a>
                    <a href="http://localhost:8080/project_stage/student.php">log out</a>
                </div>
                <div class="Contact-info">
                    <h2>contact info</h2>
                    <a href="https://www.facebook.com/www.inpt.ac.ma/" target="_blank">facebook
                    </a>
                    <a href="https://twitter.com/INPTRabat" target="_blank">twitter
                    </a>
                    <a href="">0696900397
                    </a>
                    <a href="">Inpt@gmail.com
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- end concat -->
</body>

</html>