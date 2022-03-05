<?php

$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "mynotes";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("sorry we faild to connect" . mysqli_connect_error());
}
if(isset($_GET['del'])){
    $sno=$_GET['del'];
    $sql="DELETE FROM `notes` WHERE `sid`=$sno";
    $result=mysqli_query($conn,$sql);
    if ($result) {
        $delete = true;
    } else {
        echo "unsucceefull delete";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["snoedit"])) {
        $sno = $_POST["snoedit"];
        $title = $_POST["titleedit"];
        $desc = $_POST["descedit"];
        $sql = "UPDATE `notes` SET `title`='$title', `description`='$desc' WHERE `notes`.`sid` =$sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "unsucceefull update";
        }
    } else {
        $title = $_POST["title"];
        $desc = $_POST["desc"];
        $sql = "INSERT INTO `notes`(`title`,`description`) values('$title','$desc')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $insert = true;
        } else {
            echo "unsucceefull insert";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <title>iNotes project</title>
</head>

<body>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
        Edit Modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit This Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/notes/index.php" method="post">
                        <input type="hidden" name="snoedit" id="snoedit">
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="titleedit" class="form-control" id="titleedit">
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="descedit" id="descedit" style="height: 100px"></textarea>
                            <label for="desc">Descrption</label>

                        </div><br>
                        <button type="submit" class="btn btn-primary">Update Notes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>




    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">iNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">about</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">contact us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <?php
    if ($insert == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your record has been inserted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if ($update == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your record has been updated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if ($delete == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your record has been deleated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    ?>


    <div class="container my-3">
        <h3>Add a note</h3>
        <form action="/notes/index.php" method="post">
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>
            <div class="form-floating">
                <textarea class="form-control" name="desc" id="desc" style="height: 100px"></textarea>
                <label for="desc">Descrption</label>

            </div><br>
            <button type="submit" class="btn btn-primary">Add Notes</button>
        </form>
    </div>



    <div class="container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S no.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Descrption</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "<tr>
                <th scope='row'>" . $sno . "</th>
                <td>" . $row["title"] . "</td>
                <td>" . $row["description"] . "</td>
                <td> <button class='edit btn btn-sm btn-primary' id=" . $row['sid'] . ">Edit</button>  <button class='del btn btn-sm btn-primary' id=d" . $row['sid'] . ">Delete</button>
            </tr>";
                }
                ?>

            </tbody>

        </table>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener('click', (e) => {
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName('td')[0].innerText;
                desc = tr.getElementsByTagName('td')[1].innerText;
                titleedit.value = title;
                descedit.value = desc;
                snoedit.value = e.target.id;
                $('#editmodal').modal('toggle');
            })
        })

        deletes = document.getElementsByClassName('del');
        Array.from(deletes).forEach((element) => {
            element.addEventListener('click', (e) => {
                sno = e.target.id.substr(1, );
                if (confirm("Are you sure you want to delete the notes")) {
                    window.location = `/notes/index.php?del=${sno}`;
                } else {
                    console.log("no");
                }
            })
        })
    </script>
</body>

</html>