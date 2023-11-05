<!DOCTYPE html>
<html>

<head>
  <title>Registration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="shortcut icon" href="./readme-images/eci.png" type="image/svg+xml">

  <style type="text/css">
    .container {
      margin-top: 8%;
      width: 400px;
      border: ridge 1.5px white;
      padding: 20px;
    }

    body {
      color: antiquewhite;
      background: url("./assets/images/hero-bg.jpg");
      /* fallback for old browsers */
      /* background: -webkit-linear-gradient(to right, #CFDEF3, #E0EAFC);  /* Chrome 10-25, Safari 5.1-6 */
      /* background: linear-gradient(to right, #CFDEF3, #E0EAFC); W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <div class="container">
    <h2 allign="center">Registration Form</h2>
    <form action="" method="post">
      <div class="form-group">
        <label for="firstname">Full Name</label>
        <input type="text" class="form-control" id="exampleInputfirstname" name="name" required>
      </div>
      <div class="form-group">
        <label for="aadhaar">AADHAR Number</label>
        <input type="number" class="form-control" id="exampleInputlastname" name="aadhar" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="exampleInputPassword" name="email" required>
      </div>
      <div class="form-group">
        <label for="phoneno">Phone Number</label>
        <input type="number" class="form-control" id="exampleInputphoneno" name="phoneno" required>
      </div>
      <div class="form-group">
        <label for="age">Age</label>
        <input type="number" class="form-control" id="exampleInputphoneno" name="age" min="1" max="150" required>
      </div>
      <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword" name="password" required>
      </div>
      <div class="form-group">Gender<br><br>

        <input type="radio" name="gender" id="male" value="male" required>

        <label for="male">Male</label>
        <input type="radio" name="gender" id="female" value="female" required>
        <label for="female">Female</label>
        <input type="radio" name="gender" id="others" value="others" required>

        <label for="others">Others</label>


        <span name="gender" class="text-danger font-weight-regular">
        </span>
      </div>
      <div class="form-group">
        <label for="state">State</label>
        <input type="text" class="form-control" id="exampleInputPassword" name="state" value="Andhra Pradesh" readonly>
      </div>

      <div><label for="city">City</label>

        <select name="city" id="city" class="form-control" required>
          <option value="" selected disabled>Select City</option>
          <option value="Vijayawada">Vijayawada</option>
          <option value="Visakhapatnam">Visakhapatnam</option>
          <option value="Kurnool">Kurnool</option>
          <option value="Nellore">Nellore</option>
        </select>
      </div><br>
      <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" class="form-control" id="exampleInputPassword" name="photo" required>
        <label for="sign">Signature</label>
        <input type="file" class="form-control" id="exampleInputPassword" name="sign" required>

      </div>


      <button type="submit" class="btn btn-primary" name="create">Sign
        up</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="signin.php"><button type="button" class="btn btn-secondary" name="">Log in</button></a>

    </form>
  </div>
</body>
<?php
include("./db.php");
if(isset($_POST["create"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $aadhar = $_POST["aadhar"];
  $age = $_POST["age"];
  $mobile = $_POST["phoneno"];
  $gender = $_POST["gender"];
  $state = $_POST["state"];
  $city  = $_POST["city"];
  $photo = $_POST["photo"];
  $sign = $_POST["sign"];

  $sel = mysqli_query($conn, "select * from voters where aadhar='$aadhar'");
  if (mysqli_num_rows($sel) == 0) {
    if($age > 17){

    $sql = mysqli_query($conn, "insert into voters (full_name,aadhar,email,phone,password,gender,state,city,photo,sign) values ('$name','$aadhar','$email','$mobile','$password','$gender','$state','$city','$photo','$sign')");
    if ($sql) {
?>
      <script>
        Swal.fire(
          'Success!',
          'You successfully registered!',
          'success'
        )
      </script>
    <?php
    } else {
    ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!'
        })
      </script>
    <?php
    }
    } else {
      ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "You are not eligible"
      })
    </script>
<?php
    }
  } else {
    ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Account exists!',
        text: "You've already registered with this Aadhar number",
        footer: 'Try logging in.'
      })
    </script>
<?php
  }
}

?>

</html>