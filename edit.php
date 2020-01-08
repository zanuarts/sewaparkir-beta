<?php
// include database connection file
include_once("config.php");

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{   
    $id = $_POST['id'];
    $nama=$_POST['nama'];
    $harga=$_POST['harga'];
    $desk=$_POST['desk'];

    // update user data
    $result = mysqli_query($mysqli, "UPDATE tempatparkir SET nama='$nama',harga='$harga',desk='$desk' WHERE id=$id");

    // Redirect to homepage to display updated user in list
    header("Location: admin.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM tempatparkir WHERE id=$id");

while($user_data = mysqli_fetch_array($result))
{
    $nama = $user_data['nama'];
    $harga = $user_data['harga'];
    $desk = $user_data['desk'];
}
?>
<html>
<head>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit User Data</title>
</head>

<body>
    <div class="container">
        <button type="button" class="btn btn-outline-primary" style="margin-top:10px;"><a href="admin.php">Go to Home</a></button>
        
        <br/><br/>

        <form name="update_user" method="post" action="edit.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" name="nama" class="form-control" value=<?php echo $nama;?>>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Harga</label>
                <input type="number" name="harga" class="form-control" value=<?php echo $harga;?>>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Deskripsi</label>
                <textarea class="form-control" input type="text" name="desk" rows="3" value=<?php echo $desk;?>></textarea>
            </div>
            <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
            <button type="submit" class="btn btn-primary" name="update" value="Update">Update</button>
            
        </form>

    </div>
</body>
</html>