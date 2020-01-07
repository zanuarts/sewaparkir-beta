<html>
<head>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Users</title>
</head>

<body>
    <div class="container">
        <a href="index.php">Go to Home</a>
        <br/><br/>

        <form action="add.php" method="post" name="form1">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" name="nama" class="form-control" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Harga</label>
                <input type="number" name="harga" class="form-control" >
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Deskripsi</label>
                <textarea class="form-control" input type="text" name="desk" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="Submit" value="Add">Submit</button>
            
        </form>

        
        <?php

        // Check If form submitted, insert form data into users table.
        if(isset($_POST['Submit'])) {
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $desk = $_POST['desk'];

            // include database connection file
            include_once("config.php");

            // Insert user data into table
            $result = mysqli_query($mysqli, "INSERT INTO tempatparkir(nama,harga,desk) VALUES('$nama','$harga','$desk')");

            // Show message when user added
            echo "User added successfully. <a href='index.php'>View Users</a>";
        }
        ?>

    </div>
    
</body>
</html>