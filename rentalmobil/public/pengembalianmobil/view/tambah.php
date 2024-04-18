<?php 
    include_once("../../../config/koneksi.php");
    include_once("../Controller/pengembalian_mobil.php");

    $pengembalianMobilController = new TambahDataController($kon);

    $dataPengembalian = "SELECT penyewaan.id_penyewaan,
                            CASE
                                WHEN customer.nama IS NOT NULL THEN customer.nama
                            END AS namapenyewa
                            FROM penyewaan
                            LEFT JOIN customer ON penyewaan.customer_idcustomer = customer.idcustomer
                            WHERE penyewaan.id_penyewaan NOT IN (SELECT DISTINCT id_pengembalian FROM pengembalian_mobil)";
    
    $hasilPengembalian = mysqli_query($kon, $dataPengembalian);

    if (isset($_POST['penyewaan_id_penyewaan'])) {
        $penyewaan_id = $_POST['penyewaan_id_penyewaan'];
        $dataMobil = "SELECT garasi.idgarasi, garasi.kendaraan_idmobil
                     FROM penyewaan_mobil
                     INNER JOIN garasi ON penyewaan_mobil.garasi_idgarasi = garasi.idgarasi
                     WHERE penyewaan_mobil.penyewaan_id_penyewaan = $penyewaan_id";
        $hasilMobil = mysqli_query($kon, $dataMobil);
    } else {
        // Default: Tampilkan semua Mobil
        $dataMobil = "SELECT idgarasi, kendaraan_idmobil FROM garasi";
        $hasilMobil = mysqli_query($kon, $dataMobil);
    }

    if (isset($_POST['submit'])) {
        $data = [
            'penyewaan_id_penyewaan' => (isset($_POST['penyewaan_id_penyewaan'])) ? $_POST['penyewaan_id_penyewaan'] : '',
            'stok_mobil' => $_POST['stok_mobil'],
            'tanggal_pengembalian' => $_POST['tanggal_pengembalian'],
            'garasi_idgarasi' => $_POST['garasi_idgarasi'],
        ];
        $message = $pengembalianMobilController->TambahDataPengembalianMobil($data);
        header("Location: tambah.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    <title>Halaman Pengembalian Mobil</title>
</head>
<body>
<h1>Tambah Data Pengembalian Mobil</h1>
    <a href="../../dashboard/data/dspengembalianmobil.php">Home</a>
    <form action="tambah.php" method="post" name="formTambahPengembalianMobil" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
        <div class="table-container">
            <table>
                <tr>
                    <th>ID Penyewaan</th>
                    <th>Tanggal Pengembalian</th>
                </tr>
                <tr>
                    <td>
                        <select id="penyewaan_id_penyewaan" name="penyewaan_id_penyewaan" style="width: 100%;" onchange="fillTwoInputs()">
                            <?php if (mysqli_num_rows($hasilPengembalian) > 0) : ?>
                                <option value="" disabled selected> Pilih ID Penyewaan </option>
                                    <?php while ($row = mysqli_fetch_assoc($hasilPengembalian)) : ?>
                                        <option value="<?php echo $row['id_penyewaan']; ?>">
                                            <?php echo $row['id_penyewaan'] . ' - ' . $row['namapenyewa']; ?>
                                        </option>
                                    <?php endwhile; ?>
                            <?php else : ?>
                                <option value="" disabled selected> Tambahkan data penyewaan terlebih dahulu</option>
                            <?php endif; ?>
                        </select>
                    </td>
                    <td><input type="date" name="tanggal_pengembalian" style="width: 100%;"></td>
                </tr>
                <tr>
                        <th>ID Mobil</th>
                        <th>Jumlah</th>
                    </tr>
                <tr>
                    <td>
                        <select id="garasi_idgarasi" name="garasi_idgarasi[]" style="width: 100%;">
                            <?php if (mysqli_num_rows($hasilMobil) > 0) : ?>
                                <option value="" disabled selected>Pilih Mobil</option>
                                <?php while ($row = mysqli_fetch_assoc($hasilMobil)) : ?>
                                    <option value="<?php echo $row['idgarasi']; ?>">
                                        <?php echo $row['idgarasi'] . ' - ' . $row['kendaraan_idmobil']; ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <option value="" disabled selected> Tambahkan data mobil terlebih dahulu.</option>
                            <?php endif; ?>
                        </select>
                    </td>
                    <td><input type="number" name="stok_mobil[]" style="width: 100%;"></td>
                </tr>
            </table>
        </div>
        <button type="button" class="add-row-button" onclick="addRow()">Tambah Mobil</button>
        <input type="submit" name="submit" value="Tambah Data">
    </form>
    <?php if (isset($message) && strpos($message, 'Stok Mobil tidak mencukupi') !== false): ?>
        <div id="error-message" style="color: red;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <script>
        function fillTwoInputs() {
            var selectedValue = document.getElementById("penyewaan_id_penyewaan").value;
            document.getElementById("id_pengembalian").value = selectedValue;
        }

        function addRow() {
            var table = document.querySelector('table');
            var lastRow = table.rows[table.rows.length - 1].cloneNode(true);
            var selects = lastRow.getElementsByTagName('select');
            var inputs = lastRow.getElementsByTagName('input');

            // Atur ulang properti name untuk input agar unik
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = '';
                inputs[i].name = inputs[i].name.replace(/\[(\d+)\]/g, function(match, p1) {
                    var index = parseInt(p1) + 1;
                    return '[' + index + ']';
                });
            }

            // Hapus nilai dari select
            for (var i = 0; i < selects.length; i++) {
                selects[i].selectedIndex = 0;
            }

            // Hapus tombol hapus jika sudah ada
            var existingDeleteButton = lastRow.querySelector('button');
            if (existingDeleteButton) {
                lastRow.removeChild(existingDeleteButton);
            }

            // Tambahkan tombol Hapus
            var deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.textContent = 'X';
            deleteButton.onclick = function() {
                table.removeChild(lastRow);
            };
            lastRow.appendChild(deleteButton);
            table.appendChild(lastRow);

            // Menghapus pesan kesalahan jika ada
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