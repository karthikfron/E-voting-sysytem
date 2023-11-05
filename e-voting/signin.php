<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./readme-images/eci.png" type="image/svg+xml">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background: url("assets/images/hero-bg.jpg");
}

.container {
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    padding: 20px;
    text-align: center;
    max-width: 400px;
}

.login-box {
    margin: 0 auto;
    padding: 20px;
}

h2 {
    color: #333;
    font-size: 24px;
}

.input-container {
    margin: 20px 0;
}

label {
    display: block;
    text-align: left;
    margin-bottom: 5px;
    color: #333;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.btn {
    background-color: #0074D9;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.btn:hover {
    background-color: #0056a1;
}

    </style>
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <form id="login-form" method="post" action="">
                <div class="input-container">
                    <label for="username">Aadhar Number</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="submit" class="btn">Login</button>
                <a href="create.php"><button type="button" class="btn">Signup</button></a><br><br>
                <a href="index.html">Back to home</a>
            </form>
        </div>
    </div>
</body>
<?php 
if(isset($_POST["submit"])){
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $stat = mysqli_query($conn,"SELECT * FROM voters WHERE aadhar = '$user'");
    if(mysqli_num_rows($stat) > 0){
        $row = mysqli_fetch_array($stat);
        if($row["password"] === $pass){
            $_SESSION['username'] = $row['aadhar'];
            $_SESSION['name'] = $row['full_name'];
            $_SESSION['city'] = $row['city'];
            header("location: dashboard.php");
    }else{
        ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Password incorrect!'
        })
      </script>
    <?php
    }
}else{
    ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Not found any account! Try creating one.'
        })
      </script>
    <?php
}
}
?>
</html>
