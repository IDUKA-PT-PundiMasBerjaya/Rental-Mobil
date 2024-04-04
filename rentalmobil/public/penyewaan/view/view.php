<?php 
    include_once("../../../config/koneksi.php");
    include_once("../controller/viewdata.php");

    $penyewaanController = new PenyewaanController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Penyewaan</title>
</head>
<body>
    <a href="../../dashboard/data/dashboardpenyewaan.php">| Home |</a>
    <br><br>
    <form action="view.php" method="post" name="update_data">
        <table>
            <tr>
                <td>ID Penyewaan</td>
                <td>: </td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Nama Pengguna</td>
                <td>: </td>
                <td><?php echo $namapengguna; ?></td>
            </tr>
            <tr>
                <td>Tanggal Sewa</td>
                <td>: </td>
                <td><?php echo $tglsewa; ?></td>
            </tr>
            <tr>
                <td>Tanggal Kembali</td>
                <td>: </td>
                <td><?php echo $tglkembali; ?></td>
            </tr>
        </table>
    </form>
</body>
</html>