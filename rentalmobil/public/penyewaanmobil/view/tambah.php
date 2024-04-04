<?php 
include_once("../../../config/koneksi.php");
include_once("../Controller/penyewaan_mobil.php");
$penyewaanMobilController = new TambahMobilController($kon);
//Mengambil data penyewaan
$dataPenyewaan = "SELECT penyewaan.id_penyewaan,
                        CASE
                            WHEN customer.nama IS NOT NULL THEN customer.nama
                        END AS namapenyewa
                        FROM
                        penyewaan
                        LEFT JOIN 
                        customer ON penyewaan.customer_idcustomer = customer.idcustomer
                      WHERE penyewaan.id_penyewaan NOT IN (SELECT DISTINCT id_penyewaan FROM penyewaan_mobil)"; // Menghilangkan ID jika sudah tersimpan
$hasilPenyewaan = mysqli_query($kon, $dataPenyewaan);
//Mengambil data mobil untuk opsi dropdown
$dataMobil = "SELECT idmobil, nama_mobil FROM kendaraan";
$hasilMobil = mysqli_query($kon, $dataMobil);
//Hasil cek isisan data agar sama dengan Controller
    if (isset($_POST['submit'])) {
        //Menggunakan satu ID Penyewaan untuk semua mobil yang ditambahkan
    $data = [
        'id_penyewaan' => (isset($_POST['id_penyewaan'])) ? $_POST['id_penyewaan'] : null,
        'jumlah_mobil' => $_POST['jumlah_mobil'], // Ini adalah sebuah ARRAY
        'kendaraan_idmobil' => $_POST['kendaraan_idmobil'],
    ];
        //Menambahkan data penyewaan barang
        $message = $penyewaanMobilController->TambahDataPenyewaanMobil($data);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Tambah Penyewaan Mobil</title>
    <link rel="stylesheet" href="../../css/output.css">
    <style>
        /* Style untuk judul tabel */
        h1 {
            text-align: center;
            color: #020617;
            font-weight: bold;
            margin-bottom: 20px; /* Margin bawah sedikit diperkecil */
            font-size: 30px; /* Ukuran judul lebih kecil */
        }

        a {
            padding: 10px 20px;
            margin-right: 15px;
            color: #f8fafc; /* Warna biru tua */
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            background-color: #e2e8f0; /* Warna latar belakang */
            border: 2px solid #4299e1; /* Warna border */
            border-radius: 4px; /* Bentuk sudut */
            float: right; /* Menggeser ke kanan */
        }

        /* Hover effect */
        a:hover {
            background-color: #4299e1; /* Warna latar belakang saat hover */
            color: #fff; /* Warna teks saat hover */
        }

        /* Style untuk form */
        form {
            margin-top: 10px; /* Margin atas sedikit diperkecil */
            text-align: center; /* Pusatkan teks */
            flex-wrap: wrap; /* Mengatur wrap agar tombol submit turun ke bawah pada layar kecil */
        }

        table {
            width: 50%; /* Lebar tabel lebih diperkecil */
            margin: 0 auto; /* Menengahkan tabel */
            border-collapse: collapse;
            margin-bottom: 10px; /* Margin bawah sedikit diperkecil */
        }

        table, th, td {
            border: 1px solid #020617;
            padding: 4px; /* Padding sedikit diperkecil */
        }

        input[type=number] {
            width: 100%;
            padding: 4px; /* Padding sedikit diperkecil */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 2px; /* Margin atas dan bawah sedikit diperkecil */
            margin-bottom: 8px; /* Margin atas dan bawah sedikit diperkecil */
            font-size: 14px; /* Ukuran teks sedikit diperkecil */
        }

        .add-row-button, .add-data-button {
            background-color: #4299e1;
            color: white;
            padding: 6px 12px; /* Padding sedikit diperkecil */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px; /* Ukuran teks sedikit diperkecil */
            margin-bottom: 10px;
            margin-right: 10px; /* Margin kanan ditambahkan */
        }

        .add-row-button:hover, .add-data-button:hover {
            background-color: #3182ce;
        }

        .error-message {
            color: red;
            margin-top: 6px; /* Margin atas sedikit diperkecil */
            font-size: 14px; /* Ukuran teks sedikit diperkecil */
        }

        th {
            background-color: #4299e1; /* Warna latar belakang biru muda */
            color: #fff; /* Warna teks putih */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-4"> <!-- Padding atas dan bawah sedikit diperkecil -->
        <h1>Tambah Data Penyewaan Mobil</h1>
        <a href="../../dashboard/data/dspenyewaanmobil.php">Home </a>
        <form action="tambah.php" method="post" name="tambahpenyewaanmobil" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
            <div class="table-container">
                <table>
                    <tr> <th colspan="2">ID Penyewa</th></tr>
                    <tr>
                    <td>
                        <select id="id_penyewaan" name="id_penyewaan" style="width: 100%;">
                            <?php if (mysqli_num_rows($hasilPenyewaan) > 0) : ?>
                                <option value="" disabled selected> Pilih ID Penyewaan </option>
                                    <?php while ($row = mysqli_fetch_assoc($hasilPenyewaan)) : ?>
                                        <option value="<?php echo $row['id_penyewaan']; ?>">
                                            <?php echo $row['id_penyewaan'] . ' - ' . $row['namapenyewa']; ?>
                                        </option>
                                    <?php endwhile; ?>
                            <?php else : ?>
                                <option value="" disabled selected> Tambahkan data Penyewaan terlebih dahulu</option>
                            <?php endif; ?>
                        </select>
                    </td>
                    </tr>
                    <tr>
                        <th>ID Mobil</th>
                        <th>Jumlah</th>
                    </tr>
                <tr>
                    <td>
                        <select id="kendaraan_idmobil" name="kendaraan_idmobil[]" style="width: 100%;">
                            <?php if (mysqli_num_rows($hasilMobil) > 0) : ?>
                                <option value="" disabled selected>Pilih Mobil</option>
                                <?php while ($row = mysqli_fetch_assoc($hasilMobil)) : ?>
                                    <option value="<?php echo $row['idmobil']; ?>">
                                        <?php echo $row['idmobil'] . ' - ' . $row['nama_mobil']; ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <option value="" disabled selected> Tambahkan data Mobil terlebih dahulu.</option>
                            <?php endif; ?>
                        </select>
                    </td>
                    <td><input type="number" name="jumlah_mobil[]" style="width: 100%;"></td>
                </tr>
            </table>
        </div>
        <button type="button" class="add-row-button" onclick="addRow()">Tambah Mobil</button>
        <input type="submit" name="submit" value="Tambah Data">
    </form>

    <!-- Tambahkan bagian ini setelah form -->
    <?php if (isset($message) && strpos($message, 'Stok barang tidak mencukupi') !== false): ?>
        <div class="error-message" style="color: red;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <script>
        function addRow() {
            var table = document.querySelector('table');
            var lastRow = table.rows[table.rows.length - 1].cloneNode(true);
            var selects = lastRow.getElementsByTagName('select');
            var inputs = lastRow.getElementsByTagName('input');

            for (var i = 0; i < selects.length; i++) {
                selects[i].selectedIndex = 0;
            }
            //Membuat baris baru
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type === 'number') {
                    console.log('Jumlah:', inputs[i].value);
                    inputs[i].value = 0;
                } else {
                    inputs[i].value = '';
                }
            }
            //Hapus tombol hapus jika sudah ada 
            var existingDeleteButton = lastRow.querySelector('button');
            if (existingDeleteButton) {
                lastRow.removeChild(existingDeleteButton);
            }
            //Tambahkan tombol Hapus
            var deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.textContent = 'X';
            deleteButton.onclick = function() {
                table.removeChild(lastRow);
            };
            lastRow.appendChild(deleteButton);
            table.appendChild(lastRow);
            //Menghapus pesan kesalahan jika ada
            var existingErrorMessage = document.querySelector('.error-message');
            if (existingErrorMessage) {
                existingErrorMessage.remove();
            }
        }
        //Fungsi menampilkan pesan kesalahan
        function showError(message) {
            var errorMessage = document.createElement('div');
            errorMessage.classList.add('error-message');
            errorMessage.textContent = message;
            errorMessage.style.color = 'red';
            document.body.appendChild(errorMessage);
        }

        function confirmSubmit() {
            var confirmation = confirm('Data yang sudah di simpan tidak bisa di Edit');
            if (confirmation) {
                return true; //Submit Formulir jika menekan OK
            } else {
                return false; // Batalkan jika menekan Cancel
            }
        }
    </script>
</body>
</html>