<?php
// Create database connection using config file
include_once("config.php");

// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM tempatparkir ORDER BY id DESC");
?>

<html>
<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sewa Parkir</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
        <a class="navbar-brand" href="#">Sewa Parkir</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Admin
                <span class="sr-only">(current)</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>

    <div class="container">

        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Admin Page</h1>
                <div class="list-group">
                <a href="#" class="list-group-item">Tempat Parkir</a>
                
                </div>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">
                
                <a href="add.php"><input class="btn btn-outline-primary" type="button" value="Tambah Tempat Parkir" style="margin-top:10px;" ></a>
                <br/>
                <br/>

                <table class="table">

                <tr>
                    <th>Name</th> <th>harga</th> <th>deskription</th> <th>Update</th>
                </tr>
                <?php  
                while($user_data = mysqli_fetch_array($result)) {         
                    echo "<tr>";
                    echo "<td>".$user_data['nama']."</td>";
                    echo "<td>".$user_data['harga']."</td>";
                    echo "<td>".$user_data['desk']."</td>";    
                    echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]'>Delete</a></td></tr>";        
                }
                ?>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>