<?php 
    session_start();
    include_once("config/koneksi.php");

    if($kon->connect_error) {
        die("Connection failed: " . $kon->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT id, username, password FROM Admin WHERE username = '$username' AND password = '$password'";
        $result = $kon->query($sql);

        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            header("Location: public/dashboard/dashboard.php");
        } else {
            $error_message = "Failed Login, invalid username or password";
        }
    }

    $kon->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./public/css/output.css">
    <title>Login</title>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded shadow-md max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Login</h1>
        <div class="mb-4"><!-- Tambahkan div ini untuk menambah jarak -->
            <?php if(isset($error_message)): ?>
                <div class="text-sm text-red-500"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </div>
        <form method="post" action="" class="space-y-6">
            <div>
                <label for="username" class="block">Username:</label>
                <input type="text" name="username" required class="w-full border border-gray-300 rounded-md p-2">
            </div>
            <div>
                <label for="password" class="block">Password:</label>
                <input type="password" name="password" required class="w-full border border-gray-300 rounded-md p-2">
            </div>
            <div>
                <label>Tidak Punya Akun? <span class="text-red-500"><a href="public/admin/view/tambah.php">Register</a></span></label>
            </div>
            <div>
          <input type="submit" value="Login" class="w-full bg-indigo-500 text-white rounded-md p-2 hover:bg-indigo-600 mt-2">
      </div>

        </form>
        <?php if(isset($error_message)): ?>
            <div class="text-sm text-red-500 mt-1"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
