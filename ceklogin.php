<?php
$host="localhost"; // biasanya localhost
$username="root";
$password="";
$db="sewaparkir_beta"; 
 
 
mysqli_connect("$host", "$username", "$password")or die("koneksi gagal");
mysqli_select_db("$db")or die("database tidak bisa dipilih");
 
// mengambil data username dan password dari index.php
// bila form method nya GET maka ganti POST menjadi GET
$email=$_POST['email'];
$password=$_POST['password'];
 
// untuk keamanan
$email = stripslashes($email);
$password = stripslashes($password);
$email = mysqli_real_escape_string($email);
$password = mysqli_real_escape_string($password);
 
$sql="SELECT * FROM member WHERE username='$email' and password='$password'";
$result=mysqli_query($sql);
$count=mysqli_num_rows($result);
 
if($count==1){
echo "<script>window.location = 'admin.php';</script>";
}
else {
echo "Username atau Password yang anda masukkan salah";
}
?>