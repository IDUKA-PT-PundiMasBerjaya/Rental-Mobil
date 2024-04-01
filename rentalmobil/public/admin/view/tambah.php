<?php 
include_once("../../../config/koneksi.php");
include_once("../Controller/admintambah.php");

$adminController = new AdminController($kon);

$message = "";

if (isset($_POST['submit'])) {
    $id = $adminController->tambahAdmin();

    $data = [
        'id' => $id,
        'username' => $_POST['username'],
        'password' => $_POST['password'],
    ];

    $message = $adminController->tambahDataAdmin($data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun Baru</title>
    <link rel="stylesheet" href="../../../public/css/output.css"> <!-- Sesuaikan dengan path CSS Anda -->
    <style>
        body {
            background-color: #f7fafc;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        table {
            margin: auto;
        }
        table td {
            padding: 8px;
        }
        input[type="text"], input[type="password"] {
            width: calc(100% - 16px);
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        p {
            text-align: center;
            margin-top: 10px;
        }
        p span a {
            color: #4f46e5;
        }
        .success-message {
            margin-top: 10px;
            background-color: #d1fae5;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register Akun</h1>
        <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data">
            <table>
                <tr>
                    <td> ID Admin </td>
                    <td>:</td>
                    <td><input type="text" name="id" value="<?php echo $adminController->tambahAdmin(); ?>" readonly></td>
                </tr>
                <tr>
                    <td> Username </td>
                    <td>:</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td> Password </td>
                    <td>:</td>
                    <td><input type="password" name="password"></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Tambah Data">
            <p>Sudah Memiliki Akun? <span><a href="../../../login.php">Login</a></span></p>
            <?php if (!empty($message)): ?>
                <div class="success-message">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
