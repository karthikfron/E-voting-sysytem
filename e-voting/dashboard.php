<?php
include("db.php");
session_start();
if (isset($_SESSION["username"])) {
    $name = $_SESSION['name'];
    $aadhar = $_SESSION['username'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./readme-images/eci.png" type="image/svg+xml">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            /* Reset some default styles */
            body,
            ul {
                margin: 0;
                padding: 0;
            }

            nav {
                background-color: #333;
                color: #fff;
            }

            .navbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                max-width: 1200px;
                margin: 0 auto;
                padding: 10px;
            }

            .logo {
                text-decoration: none;
                font-size: 1.5rem;
                color: #fff;
            }

            .nav-links {
                list-style: none;
                display: flex;
            }

            .nav-links li {
                margin-right: 20px;
            }

            .nav-links a {
                text-decoration: none;
                color: #fff;
            }

            /* Style for a responsive navigation bar (for smaller screens) */
            @media (max-width: 768px) {
                .navbar {
                    flex-direction: column;
                    text-align: center;
                }

                .nav-links {
                    margin-top: 20px;
                }

                .nav-links li {
                    margin: 10px 0;
                }
            }

            .body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }

            .container {
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                border-radius: 4px;
                padding: 20px;
                text-align: center;
                max-width: 400px;

            }

            h1 {
                color: #333;
            }

            .candidates {
                margin-top: 20px;
            }

            .candidate {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 10px 0;
                padding: 10px;
                background-color: #f0f0f0;
                border-radius: 4px;
            }

            .candidate-info {
                display: flex;
                align-items: center;
            }

            .party-logo {
                width: 50px;
                height: 50px;
                margin-right: 10px;
            }

            .btn {
                background-color: #0074D9;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: #0056a1;
            }
        </style>
        <title>Dashboard</title>
    </head>                                                    

    <body>
        <nav>
            <div class="navbar">
                <a href="#" class="logo">Welcome <?php echo $_SESSION["name"].", from ".$_SESSION['city']; ?></a>
                <ul class="nav-links">
                    <!-- <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li> -->
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="body">
            <div class="container">

                <h1>E-Voting System</h1>
                <?php
                $check = mysqli_query($conn, "select * from voted where aadhar = '$aadhar'");
                if (mysqli_num_rows($check) > 0) {
                    echo "you have already voted !";
                } else {
                ?>
                    <form action="" method="post">
                        <div class="candidates">
                            <h2>Candidates</h2>
                            <div class="candidate">

                                <label>
                                    <input type="radio" name="candidate" value="TDP">
                                    <span class="candidate-info">
                                        <img src="./assets/images/tdp.png" alt="Party 1 Logo" class="party-logo">
                                        TDP </span>
                                </label>
                            </div>
                            <div class="candidate">
                                <label>
                                    <input type="radio" name="candidate" value="YSRCP">
                                    <span class="candidate-info">
                                        <img src="./assets/images/ysrcp.png" alt="Party 2 Logo" class="party-logo">
                                        YSRCP
                                    </span>
                                </label>
                            </div>
                            <div class="candidate">
                                <label>
                                    <input type="radio" name="candidate" value="JANASENA">
                                    <span class="candidate-info">
                                        <img src="./assets/images/js.png" alt="Party 2 Logo" class="party-logo">
                                        JANASENA
                                    </span>
                                </label>

                            </div>
                        </div>
                        <button id="vote-button" class="btn" name="vote">Vote</button>
            </div>
        </div>
        </form>
        <?php
                    if (isset($_POST['vote'])) {
                        $vote = $_POST['candidate'];

                        $sel = mysqli_query($conn, "insert into voted(name,aadhar,voted) values('$name','$aadhar','$vote')");
                        if ($sel) {
        ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'You have successfully voted!',
                        footer: 'You will be logged out for security reasons.'
                    })
                    setTimeout(function() {
                        window.location.href = 'logout.php';
                    }, 3000);
                </script>
<?php
                            header("refresh:3;URL= logout.php");
                        }
                    }
                }
            } else {
                echo 'no access';
            } ?>
    </body>

    </html>