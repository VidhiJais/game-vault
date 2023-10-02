<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Page</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(bg.png);
            background-size: cover ;
        }


        .title-bar {
            background-color: darkred;
            padding: 10px;
            text-align: left;
        }

        .title-bar .logo {
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .title-bar .logo img {
        display: block;
        width: 100%;
        height: auto;
        border-radius: 50%;
        background-color: transparent;
        transform:scale(2.5);
}

        .title-bar h1 {
            color: white;
            margin: 0;
            display: inline;
            vertical-align: left;
        }

        .container {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color:rgba(50, 50, 50, 0.8);
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
            border: 1px solid #6F2232;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
            background-color: #1A1A1D;
            color: #fff;
        }

        input[type="submit"] {
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: #6F2232;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #950740;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #950740;
        }

        nav ul li {
            float: left;
        }

        nav ul li a {
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav ul li a:hover {
            background-color: #C3073F;
        }
    </style>
</head>
<body>
<div class="title-bar">
    <div class="logo">
        <img src="tlogo1.png" alt="Logo">
    </div>
        <h1>Game Vault</h1>
    </div>

    <div class="container">
        <h1>Sign Up</h1>
        <form action="signup.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="submit" value="Sign Up">
        </form>

        <?php
if (isset($_POST['submit'])) {
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "gaming_library");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user data into signup table
    $sql = "INSERT INTO signup (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "Signup successful.";
        header("Location: http://localhost/abhishek/index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
    
?>

    </div>
   
</body>
</html>
