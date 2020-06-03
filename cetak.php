<!DOCTYPE html>
<html>
<head>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>

<script>
	window.print();
</script>

<div class="container">
    <br>
    <h4>Data Penilaian Siswa</h4>
<?php

    include "koneksi.php";

    //Cek apakah ada nilai dari method GET dengan nama id_siswa
    if (isset($_GET['id_siswa'])) {
        $id_siswa=htmlspecialchars($_GET["id_siswa"]);

        $sql="delete from nilai where id_siswa='$id_siswa' ";
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");

            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
?>


    <table class="table table-bordered table-hover">
        <br>
        <thead>
        <tr>
            <th>No</th>
            <th>Nomor Induk Siswa</th>
            <th>Nama Siswa</th>
            <th>Kode Pelajaran</th>
            <th>Nama Pelajaran</th>
            <th>Nilai Tugas</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>

        </tr>
        </thead>
        <?php
        include "koneksi.php";
        //$sql="select * from nilai order by id_siswa desc"; (query jika hanya mau menampilkan nilai saja)
        $sql="SELECT * FROM nilai AS u INNER JOIN siswa AS i ON u.id_siswa = i.id_siswa INNER JOIN pelajaran AS a ON u.kode_pelajaran = a.kode_pelajaran";

        $hasil=mysqli_query($kon,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["id_siswa"]; ?></td>
                <td><?php echo $data["nama_siswa"]; ?></td>
				<td><?php echo $data["kode_pelajaran"]; ?></td>
                <td><?php echo $data["nama_pelajaran"]; ?></td>
                <td><?php echo $data["nilai_tugas"];   ?></td>
                <td><?php echo $data["nilai_uts"];   ?></td>
                <td><?php echo $data["nilai_uas"];   ?></td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    
</div>
</body>
</html>