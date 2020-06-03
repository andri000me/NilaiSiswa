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

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_siswa
    if (isset($_GET['id_siswa'])) {
        $id_siswa=input($_GET["id_siswa"]);

        $sql="select * from nilai where id_siswa=$id_siswa";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_siswa=input($_POST["id_siswa"]);
        $kode_pelajaran=input($_POST["kode_pelajaran"]);
        $nilai_tugas=input($_POST["nilai_tugas"]);
        $nilai_uts=input($_POST["nilai_uts"]);
        $nilai_uas=input($_POST["nilai_uas"]);

        //Query update data pada tabel anggota
        $sql="update nilai set
			id_siswa='$id_siswa',
			kode_pelajaran='$kode_pelajaran',
			nilai_tugas='$nilai_tugas',
			nilai_uts='$nilai_uts',
			nilai_uas='$nilai_uas'
			where id_siswa=$id_siswa";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nomor Induk Siswa:</label>
            <input type="text" name="id_siswa" class="form-control" placeholder="Masukan Nomor Induk Siswa" required />

        </div>
        <div class="form-group">
            <label>Kode Mata Pelajaran:</label>
            <input type="text" name="kode_pelajaran" class="form-control" placeholder="Kode Mata Pelajaran" required />

        </div>
        <div class="form-group">
            <label>Nilai Tugas:</label>
            <input type="text" name="nilai_tugas" class="form-control" placeholder="Masukan Nilai Tugas" required/>

        </div>
        <div class="form-group">
            <label>Nilai UTS:</label>
            <input type="text" name="nilai_uts" class="form-control" placeholder="Masukan Nilai UTS" required/>

        </div>
        <div class="form-group">
            <label>Nilai UAS:</label>
            <input type="text" name="nilai_uas" class="form-control" placeholder="Masukan Nilai UAS" required/>
        </div>

        <input type="hidden" name="id_siswa" value="<?php echo $data['id_siswa']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>