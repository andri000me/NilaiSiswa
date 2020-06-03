<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <?php

	include "koneksi.php";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
	$password = $_POST["password"];

	if(!empty($username) && !empty($password)); {
		$sql = mysqli_query($kon, "select * from admin where username='$username'and password='$password'");
		$hasil = mysqli_num_rows($sql);
		
		if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Username atau Password salah</div>";

        }
	}
	}
    ?>

    <h2>Login</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" placeholder="Masukan Username" required />

        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Masukan Password" required />

        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Login</button>

    </form>
</div>
</body>
</html>