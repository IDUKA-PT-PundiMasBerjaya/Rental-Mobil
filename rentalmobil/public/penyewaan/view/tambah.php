<?php  
	include_once("../../../config/koneksi.php");
	include_once("../controller/penyewaantambah.php");

	$penyewaanController = new PenyewaanController($kon);

	if (isset($_POST['submit'])) {
		$idpenyewaan = $penyewaanController->tambahPenyewaan();

		$data = [
			'id_penyewaan' => $idpenyewaan,
      		'tanggal_sewa' => $_POST['tanggal_sewa'],
            'tanggal_kembali' => $_POST['tanggal_kembali'],
            'customer_idcustomer' => $_POST['customer_idcustomer'],
		];

		$message = $penyewaanController->tambahDataPenyewaan($data);
        
	}
    //Inner Join Customer
    $dataCustomer = mysqli_query($kon, "SELECT idcustomer, nama FROM customer");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penyewaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        .home-link {
        display: inline-block;
        margin: 20px;
        padding: 10px 20px;
        background-color: #e2e8f0; /* Warna latar belakang */
        color: #fff; /* Warna teks */
        text-decoration: none;
        border: 2px solid #4299e1; /* Warna border */
        border-radius: 4px; /* Bentuk sudut */
        font-weight: bold;
        }

        .home-link:hover {
            background-color: #4299e1; /* Warna latar belakang saat hover */
            color: #fff; /* Warna teks saat hover */
        }


        form {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        input[type=text] {
            width: 100%;
            padding: 4px; /* Padding sedikit diperkecil */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 2px; /* Margin atas dan bawah sedikit diperkecil */
            margin-bottom: 8px; /* Margin atas dan bawah sedikit diperkecil */
            font-size: 14px; /* Ukuran teks sedikit diperkecil */
        }

        input[type=submit] {
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type=submit]:hover {
            background-color: #3367d6;
        }

        .success-message {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        #guruOptions, #siswaOptions {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Tambah Data Penyewaan</h1>
    <a href="../../dashboard/data/dashboardpenyewaan.php" class="home-link">Home</a>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td style="background-color: #0284c7; color: #000; font-weight: bold;">ID Penyewaan</td>
                <td><input type="text" name="idpenyewaan" value="<?php echo($penyewaanController->tambahPenyewaan())?>" readonly></td>
            </tr>
            <tr>
                <td style="background-color: #0284c7; color: #000; font-weight: bold;">Tanggal Sewa</td>
                <td><input type="date" name="tanggal_sewa" required></td>
            </tr>
            <tr>
                <td style="background-color: #0284c7; color: #000; font-weight: bold;">Tanggal Kembali</td>
                <td><input type="date" name="tanggal_kembali" required></td>
            </tr>
            <tr>
                <td style="background-color: #0284c7; color: #000; font-weight: bold;">Data Customer</td>
                <td>
                    <select id="customer_idcustomer" name="customer_idcustomer">
                        <?php while($row = mysqli_fetch_assoc($dataCustomer)) : ?>
                            <option value="<?php echo $row['idcustomer']; ?>">
                                <?php echo $row['idcustomer'] . ' - ' . $row['nama']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Tambah Data">
        <?php  if (isset($message)) : ?>
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>